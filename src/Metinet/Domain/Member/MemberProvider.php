<?php

namespace Metinet\Domain\Member;

use Metinet\Domain\Email;
use Metinet\Repositories\MemberNotFound;
use Metinet\Repositories\MemberRepository;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class MemberProvider
{
    private $repository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->repository = $memberRepository;
    }

    public function findByEmail(Email $email)
    {
        foreach ($this->repository->all() as $member) {
            if ($member->getEmail()->equals($email)) {

                return $member;
            }
        }

        throw new MemberNotFound((string) $email);
    }
}
