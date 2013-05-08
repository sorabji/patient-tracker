<?php

namespace Sorabji\PatientBundle\Tests\Entity;

use Sorabji\PatientBundle\Entity\User;
use Sorabji\PatientBundle\Entity\Invitation;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->doc = new User();
    }

    public function tearDown()
    {
        unset($this->doc);
    }

    public function testGetSetInvitation()
    {
        $invite = new Invitation();
        $this->doc->setInvitation($invite);
        $this->assertSame($invite, $this->doc->getInvitation());
    }

    public function testGetSetNotes()
    {
        $notes = 'this and that';
        $this->doc->setNotes($notes);
        $this->assertSame($notes, $this->doc->getNotes());
    }

    public function testGetSetFirstName()
    {
        $name = "bob";
        $this->doc->setFirstName($name);
        $this->assertSame($name, $this->doc->getFirstName());
    }

    public function testGetSetLastName()
    {
        $name = "buckley";
        $this->doc->setLastName($name);
        $this->assertSame($name, $this->doc->getLastName());
    }

    public function testGetSetAccountName()
    {
        $name = "sdlfkj";
        $this->doc->setAccountName($name);
        $this->assertSame($name, $this->doc->getAccountName());
    }
}