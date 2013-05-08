<?php

namespace Sorabji\PatientBundle\Tests\Document;

use Sorabji\PatientBundle\Document\Patient;

class PatientTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->doc = new Patient();
    }

    public function tearDown()
    {
        unset($this->doc);
    }

    public function testGetSetName()
    {
        $name = "frank";
        $this->doc->setName($name);
        $this->assertSame($name, $this->doc->getName());
    }

    public function testGetSetIndication()
    {
        $indication = "dec";
        $this->doc->setIndication($indication);
        $this->assertSame($indication, $this->doc->getIndication());
    }

    public function testGetSetCounselor()
    {
        $counselor = "MML";
        $this->doc->setCounselor($counselor);
        $this->assertSame($counselor, $this->doc->getCounselor());
    }

    public function testGetSetDateCreated()
    {
        $date = new \DateTime("now");
        $this->doc->setDateCreated($date);
        $this->assertSame($date, $this->doc->getDateCreated());
    }

    public function testGetSetDiagnosticProcedure()
    {
        $dp = "dec";
        $this->doc->setDiagnosticProcedure($dp);
        $this->assertSame($dp, $this->doc->getDiagnosticProcedure());
    }

    public function testGetSetRace()
    {
        $race = "white";
        $this->doc->setRace($race);
        $this->assertSame($race, $this->doc->getRace());
    }

    public function testGetSetSite()
    {
        $site = "here";
        $this->doc->setSite($site);
        $this->assertSame($site, $this->doc->getSite());
    }

    public function testToArray()
    {
        $res = [
            'id' => null,
            'name' => 'frank',
            'indication' => 'AMA-37',
            'counselor' => 'MML',
            'created' => (new \DateTime("now"))->format("Y/m/d"),
            'diagnostic_procedure' => 'dec',
            'race' => 'white',
            'site' => 'CHINO',
        ];

        $this->doc->setName($res['name']);
        $this->doc->setIndication($res['indication']);
        $this->doc->setCounselor($res['counselor']);
        $this->doc->setDiagnosticProcedure($res['diagnostic_procedure']);
        $this->doc->setRace($res['race']);
        $this->doc->setSite($res['site']);

        $this->assertSame($res, $this->doc->toArray());
    }
}