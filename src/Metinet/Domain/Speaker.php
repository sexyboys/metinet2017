<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Speaker
{
    private $firstName;
    private $lastName;
    private $description;

    public function __construct(string $firstName, string $lastName, string $description)
    {
        $this->firstName   = $firstName;
        $this->lastName    = $lastName;
        $this->description = $description;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
