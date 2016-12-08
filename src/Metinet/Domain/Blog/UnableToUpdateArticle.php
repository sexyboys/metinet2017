<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

class UnableToUpdateArticle extends \Exception
{
    public static function updateAreNotAllowedForPublishedArticle()
    {
        return new self('Cannot update a published article');
    }
}
