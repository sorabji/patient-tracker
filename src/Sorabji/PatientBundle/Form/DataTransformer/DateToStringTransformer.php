<?php

namespace Sorabji\PatientBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateToStringTransformer implements DataTransformerInterface {

    /**
     * Transforms a DateTime object to a string
     *
     * @param  DateTime $date
     * @return string
     */
    public function transform($date)
    {
        if (null === $date) {
            return "";
        }

        return $date->format("Y/m/d");
    }

    /**
     * Transforms a string to an DateTime object
     *
     * @param  string $date
     *
     * @return DateTime $date_obj
     *
     * @throws TransformationFailedException if date string cannot be parsed
     */
    public function reverseTransform($date)
    {
        if (!$date) {
            return null;
        }

        try{
            $date_obj = new \DateTime($date);
        } catch(\Exception $e){
          throw new TransformationFailedException(sprintf(
            'the date "%s" could not be parsed!',
            $date
          ));
        }
        return $date_obj;
    }
}