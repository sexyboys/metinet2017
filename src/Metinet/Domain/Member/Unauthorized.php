<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Member;

class Unauthorized extends \Exception
{
    public static function memberNotLoggedIn()
    {
        return new self("Member not logged in.");
    }
}
