<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

interface ContentFormatter
{
    public function format(FormattedContent $formattedContent): string;
    public function supports($format): bool;
}
