<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class EncodedPassword
{
    private $encodedPassword;
    private $salt;

    public function __construct($encodedPassword, $salt)
    {
        $this->encodedPassword = $encodedPassword;
        $this->salt            = $salt;
    }

    public function getEncodedPassword()
    {
        return $this->encodedPassword;
    }

    public function getSalt()
    {
        return $this->salt;
    }
}
