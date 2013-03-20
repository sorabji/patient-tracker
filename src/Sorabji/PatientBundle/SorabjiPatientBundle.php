<?php

namespace Sorabji\PatientBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SorabjiPatientBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
