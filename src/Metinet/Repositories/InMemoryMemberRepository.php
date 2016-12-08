<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

use Metinet\Domain\Member;

class InMemoryMemberRepository implements MemberRepository
{
    private $members = [];

    /**
     * @param $id
     * @return Member
     * @throws MemberNotFound
     */
    public function get($id)
    {
        if (!isset($this->members[$id])) {

            throw new MemberNotFound($id);
        }

        return $this->members[$id];
    }

    public function delete(Member $member)
    {
        if (!isset($this->members[$member->getId()])) {

            throw new MemberNotFound($member->getId());
        }

        unset($this->members[$member->getId()]);
    }

    public function update(Member $member)
    {
        if (!isset($this->members[$member->getId()])) {

            throw new MemberNotFound($member->getId());
        }

        $this->members[$member->getId()] = $member;
    }

    public function add(Member $member)
    {
        if (isset($this->members[$member->getId()])) {

            throw new MemberAlreadyExists($member);
        }

        $this->members[$member->getId()] = $member;
    }

    public function all()
    {
        return $this->members;
    }
}
