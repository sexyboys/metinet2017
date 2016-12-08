<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

class ArticleNotFound extends \Exception
{
    public function __construct($id)
    {
        parent::__construct(sprintf('Article #%s not found', $id));
    }
}
