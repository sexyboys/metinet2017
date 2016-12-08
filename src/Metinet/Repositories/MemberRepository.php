<?php

namespace Metinet\Repositories;

use Metinet\Domain\Member;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
interface MemberRepository
{
    /**
     * @param $id
     * @return Member
     */
    public function get($id);
    public function delete(Member $member);
    public function update(Member $member);
    public function add(Member $member);

    /**
     * @return Member[]
     */
    public function all();
}
