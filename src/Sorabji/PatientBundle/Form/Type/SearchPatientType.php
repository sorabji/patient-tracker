<?php

namespace Sorabji\PatientBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sorabji\PatientBundle\Form\DataTransformer\DateToStringTransformer;

class SearchPatientType extends AbstractType {

  public function __construct(array $choices){
    $this->choices = $choices;
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {

    $builder
      ->add(
        $builder->create('start_date', 'text')
        ->addModelTransformer(new DateToStringTransformer()))
      ->add(
        $builder->create('end_date', 'text')
        ->addModelTransformer(new DateToStringTransformer()))
      ->add('name')
      ->add('indication', 'choice', array(
        'choices' => $this->choices['indications'],
      ))
      ->add('counselor', 'choice', array(
        'choices' => $this->choices['counselors'],
      ))
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
    $resolver->setDefaults(array(
      'data_class' => null,
    ));
  }

  public function getName()
  {
    return 'sorabji_patient_searchpatienttype';
  }
}
