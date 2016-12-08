<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

class PlainTextFormatter implements ContentFormatter
{
    public function format(FormattedContent $formattedContent): string
    {
        if ($this->supports($formattedContent->getFormat())) {

            throw new \RuntimeException('Invalid format provided');
        }

        return $formattedContent->getContent();
    }

    public function supports($format): bool
    {
        return (FormattedContent::PLAIN_TEXT === strtolower($format));
    }
}
