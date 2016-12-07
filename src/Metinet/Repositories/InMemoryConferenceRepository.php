<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

use Metinet\Domain\Conference;

class InMemoryConferenceRepository implements ConferenceRepository
{
    private $conferences = [];

    public function get($id)
    {
        if (!isset($this->conferences[$id])) {

            throw new ConferenceNotFound($id);
        }

        return $this->conferences[$id];
    }

    public function delete(Conference $conference)
    {
        if (!isset($this->conferences[$conference->getId()])) {

            throw new ConferenceNotFound($conference->getId());
        }

        unset($this->conferences[$conference->getId()]);
    }

    public function update(Conference $conference)
    {
        if (!isset($this->conferences[$conference->getId()])) {

            throw new ConferenceNotFound($conference->getId());
        }

        $this->conferences[$conference->getId()] = $conference;
    }

    public function add(Conference $conference)
    {
        if (isset($this->conferences[$conference->getId()])) {

            throw new ConferenceAlreadyExists($conference);
        }

        $this->conferences[$conference->getId()] = $conference;
    }
}
