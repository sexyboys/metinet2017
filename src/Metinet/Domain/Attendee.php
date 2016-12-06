<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Attendee
{
    private $firstName;
    private $lastName;
    private $phoneNumber;

    public function __construct(string $firstName, string $lastName, PhoneNumber $phoneNumber)
    {
        $this->firstName   = $firstName;
        $this->lastName    = $lastName;
        $this->phoneNumber = $phoneNumber;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
}
