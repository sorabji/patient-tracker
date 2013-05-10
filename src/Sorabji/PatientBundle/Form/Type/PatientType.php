<?php

namespace Sorabji\PatientBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sorabji\PatientBundle\Form\DataTransformer\DateToStringTransformer;

class PatientType extends AbstractType
{

  public function __construct(array $choices){
    $this->choices = $choices;
  }

  public function buildForm(FormBuilderInterface $builder, array $options){
    $builder
      ->add('name')
      ->add('indication', 'choice', array(
        'choices' => $this->choices['indications'],
      ))
      ->add('counselor', 'choice', array(
        'choices' => $this->choices['counselors'],
      ))
      ->add(
        $builder->create('date_created', 'text')
        ->addModelTransformer(new DateToStringTransformer()))
      ->add('diagnostic_procedure', 'choice', array(
        'choices' => $this->choices['diagnostic_procedures'],
      ))
      ->add('race', 'choice', array(
        'choices' => $this->choices['races'],
      ))
      ->add('site', 'choice', array(
        'choices' => $this->choices['sites'],
      ))
      ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(
        [
            'data_class' => 'Sorabji\PatientBundle\Document\Patient',
            'csrf_protection' => false,
        ]
    );
  }

  public function getName()
  {
    return 'patient';
  }
}
