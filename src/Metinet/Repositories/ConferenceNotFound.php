<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

use Metinet\Domain\Conference;

class ConferenceNotFound extends \Exception
{
    public function __construct($id)
    {
        parent::__construct(sprintf("La conference #%s n'existe pas", $id));
    }
}
