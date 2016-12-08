<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Email
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function equals(self $email)
    {
        return ($email->email === $this->email);
    }
}
