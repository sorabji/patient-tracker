<?php

namespace Sorabji\PatientBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document(repositoryClass="Sorabji\PatientBundle\Repository\PatientRepository")
 */
class Patient {

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $name;

    /**
     * @MongoDB\String
     */
    protected $indication;

    /**
     * @MongoDB\String
     */
    protected $counselor;

    /**
     * @MongoDB\Date
     */
    protected $date_created;

    /**
     * @MongoDB\String
     */
    protected $diagnostic_procedure;

    /**
     * @MongoDB\String
     */
    protected $race;

    /**
     * @MongoDB\String
     */
    protected $site;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return \Patient
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set indication
     *
     * @param string $indication
     * @return \Patient
     */
    public function setIndication($indication)
    {
        $this->indication = $indication;
        return $this;
    }

    /**
     * Get indication
     *
     * @return string $indication
     */
    public function getIndication()
    {
        return $this->indication;
    }

    /**
     * Set counselor
     *
     * @param string $counselor
     * @return \Patient
     */
    public function setCounselor($counselor)
    {
        $this->counselor = $counselor;
        return $this;
    }

    /**
     * Get counselor
     *
     * @return string $counselor
     */
    public function getCounselor()
    {
        return $this->counselor;
    }

    /**
     * Set date_created
     *
     * @param date $dateCreated
     * @return \Patient
     */
    public function setDateCreated($dateCreated)
    {
        $this->date_created = $dateCreated;
        return $this;
    }

    /**
     * Get date_created
     *
     * @return date $dateCreated
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Get date_created as string
     *
     * @return string $dateCreated
     */
    public function getDateCreatedString()
    {
        return $this->date_created->format('Y/m/d');
    }

    /**
     * Set diagnostic_procedure
     *
     * @param string $diagnosticProcedure
     * @return \Patient
     */
    public function setDiagnosticProcedure($diagnosticProcedure)
    {
        $this->diagnostic_procedure = $diagnosticProcedure;
        return $this;
    }

    /**
     * Get diagnostic_procedure
     *
     * @return string $diagnosticProcedure
     */
    public function getDiagnosticProcedure()
    {
        return $this->diagnostic_procedure;
    }

    /**
     * Set race
     *
     * @param string $race
     * @return \Patient
     */
    public function setRace($race)
    {
        $this->race = $race;
        return $this;
    }

    /**
     * Get race
     *
     * @return string $race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return \Patient
     */
    public function setSite($site)
    {
        $this->site = $site;
        return $this;
    }

    /**
     * Get site
     *
     * @return string $site
     */
    public function getSite()
    {
        return $this->site;
    }
}
