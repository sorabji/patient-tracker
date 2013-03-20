<?php

namespace Sorabji\PatientBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sorabji\PatientBundle\Entity\User
 *
 * @ORM\Entity(repositoryClass="Sorabji\PatientBundle\Repository\UserRepository")
 */
class User extends BaseUser {

  /**
   * @var integer $id
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\OneToOne(targetEntity="\Sorabji\PatientBundle\Entity\Invitation", inversedBy="user")
   * @Assert\NotNull(message="You do not have a valid invitation", groups={"Registration"})
   */
  protected $invitation;

  /**
   * @var string $notes
   *
   * @ORM\Column(name="notes", type="string", length=255)
   */
  private $notes = '';

  /**
   * @var string $first_name;
   *
   * @ORM\Column(name="first_name", type="string", length=50)
   */
  private $first_name = '';

  /**
   * @var string $last_name
   *
   * @ORM\Column(name="last_name", type="string", length=50)
   */
  private $last_name = '';

  /**
   * @var string $account_name
   *
   * @ORM\Column(name="account_name", type="string", length=50)
   */
  private $account_name = '';

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

    /**
     * Set invitation
     *
     * @param Sorabji\PatientBundle\Entity\Invitation $invitation
     * @return User
     */
    public function setInvitation(\Sorabji\PatientBundle\Entity\Invitation $invitation = null)
    {
        $this->invitation = $invitation;

        return $this;
    }

    /**
     * Get invitation
     *
     * @return Sorabji\PatientBundle\Entity\Invitation
     */
    public function getInvitation()
    {
        return $this->invitation;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return User
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set account_name
     *
     * @param string $accountName
     * @return User
     */
    public function setAccountName($accountName)
    {
        $this->account_name = $accountName;

        return $this;
    }

    /**
     * Get account_name
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->account_name;
    }
}