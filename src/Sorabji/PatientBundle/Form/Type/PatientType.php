<?php

namespace Sorabji\PatientBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sorabji\PatientBundle\Form\DataTransformer\DateToStringTransformer;

class PatientType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name')
      ->add('indication', 'choice', array(
        'choices' => array(
          "AMA-35" => "AMA-35",
          "AMA-36" => "AMA-36",
          "AMA-37" => "AMA-37",
          "AMA-38" => "AMA-38",
          "AMA-39" => "AMA-39",
          "AMA-40" => "AMA-40",
          "AMA-41" => "AMA-41",
          "AMA-42" => "AMA-42",
          "AMA-43" => "AMA-43",
          "AMA-44" => "AMA-44",
          "AMA-45" => "AMA-45",
          "AMA>45" => "AMA>45",
          "ABNL US" => "ABNL US",
          "CF" => "CF",
          "HEMOGLOBINOPATHIES" => "HEMOGLOBINOPATHIES",
          "FAM HX DS" => "FAM HX DS",
          "FAM HX T13" => "FAM HX T13",
          "FAM HX T18" => "FAM HX T18",
          "FAM HX OTHER CHROM ABNL" => "FAM HX OTHER CHROM ABNL",
          "FAM HX NTD" => "FAM HX NTD",
          "FAM HX MR" => "FAM HX MR",
          "FRAG X" => "FRAG X",
          "MAT ANXIETY" => "MAT ANXIETY",
          "POSITIVE AFP" => "POSITIVE AFP",
          "SAB" => "SAB",
          "TAY SACHS" => "TAY SACHS",
          "TERATOGEN" => "TERATOGEN",
          "OTHER X-LINKED" => "OTHER X-LINKED",
          "OTHER AR/AD" => "OTHER AR/AD",
          "OTHER" => "OTHER",
        )))
      ->add('counselor', 'choice', array(
        'choices' => array(
          'FM' => 'FM',
          'GR' => 'GR',
          'TTU' => 'TTU',
        )))
      ->add(
        $builder->create('date_created', 'text')
        ->addModelTransformer(new DateToStringTransformer()))
      ->add('diagnostic_procedure', 'choice', array(
        'choices' => array(
          'CVS' => 'CVS',
          'RA' => 'RA',
          'dec' => 'dec',
          'GConly' => 'GConly',
      )))
      ->add('race', 'choice', array(
        'choices' => array(
          "CN" => "CN",
          "CH" => "CH",
          "AA" => "AA",
          "NA" => "NA",
          "ME" => "ME",
          "AI" => "AI",
          "SEA" => "SEA",
          "Cambodian" => "Cambodian",
          "Loation" => "Loation",
          "Vietnamese" => "Vietnamese",
          "Filipino" => "Filipino",
          "Chinese" => "Chinese",
          "Japanese" => "Japanese",
          "Korean" => "Korean",
        )))
      ->add('site', 'choice', array(
        'choices' => array(
          'CHULA' => 'CHULA',
          'MR' => 'MR',
          'TU' => 'TU',
          'IN' => 'IN',
      )))
      ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Sorabji\PatientBundle\Document\Patient'
    ));
  }

  public function getName()
  {
    return 'sorabji_patient_patienttype';
  }
}
