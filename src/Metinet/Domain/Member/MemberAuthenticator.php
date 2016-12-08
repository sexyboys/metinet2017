<?php

namespace Metinet\Domain\Member;

use Metinet\Domain\Email;
use Metinet\Domain\Member;
use Metinet\Domain\PasswordEncoder;
use Metinet\Repositories\MemberNotFound;
use Metinet\Session\Session;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class MemberAuthenticator
{
    private $memberProvider;
    private $passwordEncoder;

    public function __construct(MemberProvider $memberProvider, PasswordEncoder $passwordEncoder)
    {
        $this->memberProvider  = $memberProvider;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function authenticate(Email $email, $password)
    {
        try {
            $member = $this->memberProvider->findByEmail($email);
        } catch (MemberNotFound $e) {

            throw AuthenticationFailed::memberNotFound($email);
        }

        $providedEncodedPassword = $this->passwordEncoder
            ->encode($password, $member->getEncodedPassword()->getSalt())
        ;

        if (!$member->getEncodedPassword()->getEncodedPassword() === $providedEncodedPassword) {

            throw AuthenticationFailed::invalidPassword($member);
        }

        $session = new Session();
        $session->start();
        $session->set("member", $member);
    }
}
