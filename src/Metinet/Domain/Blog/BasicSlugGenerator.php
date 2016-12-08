<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

class BasicSlugGenerator implements SlugGenerator
{
    public function generate($title)
    {
        return rtrim(mb_strtolower(str_replace([' ', '.', '?', '\'',], '-', $title)), '- ');
    }
}
