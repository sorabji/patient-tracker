<?php

namespace Sorabji\PatientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
 * @ORM\Entity(repositoryClass="Sorabji\PatientBundle\Repository\InvitationRepository")
 */
class Invitation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="code", type="string", length=50)
     */
    protected $code;

    /** @ORM\Column(type="string", length=256) */
    protected $email;

    /** @ORM\Column(type="text", length=256, nullable=true) */
    protected $notes = '';

    /**
     * When sending invitation be sure to set this value to `true`
     *
     * It can prevent invitations from being sent twice
     *
     * @ORM\Column(type="boolean")
     */
    protected $sent = false;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active = false;

    /**
     * @ORM\OneToOne(targetEntity="\Sorabji\PatientBundle\Entity\User", mappedBy="invitation", cascade={"persist", "merge"})
     */
    protected $user;

    public function __construct()
    {
        // generate identifier only once, here a 6 characters length code
        $this->code = substr(md5(uniqid(rand(), true)), 0, 50);
    }

    public function __toString()
    {
      return $this->code;
    }

    public function getActiveString(){
        return true === $this->active ? "Yes" : "No" ;
    }

    public function getSentString(){
        return true === $this->active ? "Yes" : "No" ;
    }

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
     * Set code
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Set sent
     *
     * @param boolean $sent
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
    }

    /**
     * Get sent
     *
     * @return boolean
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set user
     *
     * @param Sorabji\PatientBundle\Entity\User $user
     */
    public function setUser(\Sorabji\PatientBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Sorabji\PatientBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set notes
     *
     * @param text $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * Get notes
     *
     * @return text
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set active
     *
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
}