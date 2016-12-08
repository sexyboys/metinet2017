<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class PlainTextPassworderEncoder implements PasswordEncoder
{
    public function encode($password, $salt)
    {
        return sprintf("%s{%s}", $password, $salt);
    }
}
