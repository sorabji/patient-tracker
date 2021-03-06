<?php

namespace Sorabji\PatientBundle\Form\DataTransformer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

use Sorabji\PatientBundle\Entity\Invitation;

/**
 * Transforms an Invitation to an invitation code.
 */
class InvitationToCodeTransformer implements DataTransformerInterface
{
  protected $entityManager;

  public function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function transform($value)
  {
    if (null === $value) {
      return null;
    }

    if (!$value instanceof Invitation) {
      throw new UnexpectedTypeException($value, 'Sorabji\PatientBundle\Entity\Invitation');
    }

    return $value->getCode();
  }

  public function reverseTransform($value)
  {
    if (null === $value || '' === $value) {
      return null;
    }

    if (!is_string($value)) {
      throw new UnexpectedTypeException($value, 'string');
    }

    return $this->entityManager
      ->getRepository('Sorabji\PatientBundle\Entity\Invitation')
      ->valid($value);
  }
}
