<?php

namespace Sorabji\PatientBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class RegistrationFormType extends BaseRegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
                ->add('invitation', 'sorabji_invitation_type')
                ->add('first_name')
                ->add('last_name')
                ;
    }

    public function getName()
    {
        return 'sorabji_user_registration';
    }
}