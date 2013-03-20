<?php

namespace Sorabji\PatientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvitationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('code')
      ->add('email')
      ->add('notes', null, array('required' => false))
      ->add('sent', null, array('required' => false))
      ->add('active', null, array('required' => false))
      ->add('user', null, array('required' => false))
    ;
}

public function setDefaultOptions(OptionsResolverInterface $resolver)
{
  $resolver->setDefaults(array(
    'data_class' => 'Sorabji\PatientBundle\Entity\Invitation'
  ));
}

public function getName()
{
  return 'sorabji_patient_invitationtype';
}
}
