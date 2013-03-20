<?php

namespace Sorabji\PatientBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\FormError;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;

use Doctrine\ORM\EntityManager;

class RegistrationFormHandler
{
  protected $request;
  protected $userManager;
  protected $form;
  protected $mailer;
  protected $invite_code_repository;

  public function __construct(Form $form, Request $request, UserManagerInterface $userManager, MailerInterface $mailer, EntityManager $em)
  {

    $this->form = $form;
    $this->request = $request;
    $this->userManager = $userManager;
    $this->mailer = $mailer;
    $this->em = $em;

  }

  public function process($confirmation = false)
  {
    if ('POST' === $this->request->getMethod()) {

      $user = $this->userManager->createUser();
      $this->form->setData($user);

      $this->form->bindRequest($this->request);
      if ($this->form->isValid()) {

          $this->onSuccess($user, $confirmation);

          return true;
      }
    }

    return false;
  }

  protected function onSuccess(UserInterface $user, $confirmation)
  {
    // deactivate the invitatation so they can't register another user.
    $invitation = $user->getInvitation()->setActive(false);
    $this->em->flush();

    if ($confirmation) {
      $user->setEnabled(false);
      $this->mailer->sendConfirmationEmailMessage($user);
    } else {
      $user->setConfirmationToken(null);
      $user->setEnabled(true);
    }

    $this->userManager->updateUser($user);
  }
}
