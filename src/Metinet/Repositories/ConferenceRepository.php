<?php

namespace Metinet\Repositories;

use Metinet\Domain\Conference;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
interface ConferenceRepository
{
    /**
     * @param $id
     * @return Conference
     */
    public function get($id);
    public function delete(Conference $conference);
    public function update(Conference $conference);
    public function add(Conference $conference);
    public function all();
}
