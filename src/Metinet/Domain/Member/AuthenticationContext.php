<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Member;

use Metinet\Domain\Member;
use Metinet\Session\Session;

class AuthenticationContext
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->session->start();
    }

    public function isMemberLoggedIn()
    {

        if ($this->session->get("member") instanceof Member) {

            return true;
        }

        return false;
    }

    public function getMember()
    {
        if (!$this->isMemberLoggedIn()) {

            throw new \RuntimeException('No member logged in.');
        }

        return $this->session->get("member");
    }
}
