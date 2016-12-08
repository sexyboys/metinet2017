<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

class MemberNotFound extends \Exception
{
    public function __construct($id)
    {
        parent::__construct(sprintf('Member #%s not found', $id));
    }
}
