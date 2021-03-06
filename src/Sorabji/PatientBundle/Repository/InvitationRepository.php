<?php

namespace Sorabji\PatientBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * InvitationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvitationRepository extends EntityRepository
{

  public function valid($code)
  {
    $invitation = $this->getEntityManager()
                       ->createQuery('select i from SorabjiPatientBundle:Invitation i left join i.user u where i.code = :code and i.active = TRUE')
                       ->setParameter('code', $code)
                       ->getResult();

    if(0 == count($invitation)){
      return null;
    }
    return $invitation[0];
  }

}
