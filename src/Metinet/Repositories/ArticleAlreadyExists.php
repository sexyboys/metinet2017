<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

use Metinet\Domain\Blog\Article;

class ArticleAlreadyExists extends \Exception
{
    public function __construct(Article $article)
    {
        parent::__construct(sprintf('Article #%s already exists', $article->getId()));
    }
}
