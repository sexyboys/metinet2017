<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

interface PasswordEncoder
{
    public function encode($password, $salt);
}
