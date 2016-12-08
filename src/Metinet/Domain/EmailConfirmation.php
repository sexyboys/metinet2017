<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class EmailConfirmation
{
    private $token;

    public static function generate()
    {
        return new self(sha1(uniqid(), false));
    }

    public static function fromString($token)
    {
        return new self($token);
    }

    private function __construct($token)
    {
        $this->token = $token;
    }

    public function __toString()
    {
        return $this->token;
    }

    public function equals(self $emailConfirmationToken)
    {
        return ($this->token === $emailConfirmationToken->token);
    }
}
