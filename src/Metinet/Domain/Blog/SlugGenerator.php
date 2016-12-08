<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

interface SlugGenerator
{
    public function generate($title);
}
