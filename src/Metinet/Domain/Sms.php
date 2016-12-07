<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Sms
{
    private $phoneNumber;
    private $message;

    public function __construct(PhoneNumber $phoneNumber, $message)
    {
        $this->phoneNumber = $phoneNumber;
        $this->message     = $message;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber->getPhoneNumber();
    }

    public function getMessage()
    {
        return $this->message;
    }
}
