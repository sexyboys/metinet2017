<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

class UnknownFormat extends \Exception
{
    public function __construct($format, array $availableFormats)
    {
        $message = sprintf(
            'Unknown format: "%s", available formats are: %s',
            $format,
            implode(", ", $availableFormats)
        );

        parent::__construct($message);
    }
}
