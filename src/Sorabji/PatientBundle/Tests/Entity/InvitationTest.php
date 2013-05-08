<?php

namespace Sorabji\PatientBundle\Tests\Entity;

use Sorabji\PatientBundle\Entity\User;
use Sorabji\PatientBundle\Entity\Invitation;

class InvitationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->doc = new Invitation();
    }

    public function tearDown()
    {
        unset($this->doc);
    }

    public function testConstructSetsRandomCode()
    {
        $this->assertNotNull($this->doc->getCode());
    }

    public function testToString()
    {
        $code = $this->doc->getCode();
        $this->assertSame($code, $this->doc->__toString());
    }

    public function testGetActivestring()
    {
        $this->doc->setActive(false);
        $this->assertSame("No", $this->doc->getActiveString());

        $this->doc->setActive(true);
        $this->assertSame("Yes", $this->doc->getActiveString());
    }

    public function testGetSentString()
    {
        $this->doc->setSent(false);
        $this->assertSame("No", $this->doc->getSentString());

        $this->doc->setSent(true);
        $this->assertSame("Yes", $this->doc->getSentString());
    }

    public function testGetSetCode()
    {
        $t = "123";
        $this->doc->setCode($t);
        $this->assertSame($t, $this->doc->getCode());
    }

    public function testGetSetSent()
    {
        $t = "123";
        $this->doc->setSent($t);
        $this->assertSame($t, $this->doc->getSent());
    }

    public function testGetSetEmail()
    {
        $t = "123";
        $this->doc->setEmail($t);
        $this->assertSame($t, $this->doc->getEmail());
    }

    public function testGetSetUser()
    {
        $t = new User();
        $this->doc->setUser($t);
        $this->assertSame($t, $this->doc->getUser());
    }

    public function testGetSetNotes()
    {
        $t = "123";
        $this->doc->setNotes($t);
        $this->assertSame($t, $this->doc->getNotes());
    }

        public function testGetSetActive()
    {
        $t = "123";
        $this->doc->setActive($t);
        $this->assertSame($t, $this->doc->getActive());
    }
}