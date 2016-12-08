<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Member;

use Metinet\Domain\Email;
use Metinet\Domain\Member;

class AuthenticationFailed extends \Exception
{
    public static function invalidPassword(Member $member)
    {
        return new self(sprintf("Member #%s failed to authenticate, invalid password provided"));
    }

    public static function memberNotFound(Email $email)
    {
        return new self(sprintf('Member with email "%s" was not found.', (string) $email));
    }
}
