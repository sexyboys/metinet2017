<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

use Metinet\Domain\Member;

class MemberAlreadyExists extends \Exception
{
    public function __construct(Member $member)
    {
        parent::__construct(sprintf('Member #%s already exists', $member->getId()));
    }
}
