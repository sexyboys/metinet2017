<?php

namespace Metinet\Domain\Blog;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class InvalidPublicationDate extends \Exception
{
    public static function cannotBeSetInThePast()
    {
        return new self("A publication date cannot be set in the past");
    }
}
