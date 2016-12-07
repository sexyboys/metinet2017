<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

use Metinet\Domain\Conference;

class ConferenceAlreadyExists extends \Exception
{
    public function __construct(Conference $conference)
    {
        parent::__construct(sprintf('La conference #%s existe déjà', $conference->getId()));
    }
}
