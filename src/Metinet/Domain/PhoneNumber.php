<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class PhoneNumber
{
    private $phoneNumber;

    public function __construct($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function isEqual(PhoneNumber $phoneNumber)
    {
        return $this->phoneNumber === $phoneNumber->phoneNumber;
    }
}
