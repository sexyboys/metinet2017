<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

class MultiFormatContentFormatter implements ContentFormatter
{
    private $contentFormatters = [];

    /**
     * @param ContentFormatter[] $contentFormatters
     */
    public function __construct(array $contentFormatters)
    {
        $this->contentFormatters = $contentFormatters;
    }

    public function format(FormattedContent $formattedContent): string
    {
        foreach ($this->contentFormatters as $contentFormatter) {
            if ($contentFormatter->supports($formattedContent->getFormat())) {

                return $contentFormatter->format($formattedContent);
            }
        }

        throw new \RuntimeException(
            sprintf('Unable to find a valid content formatter for format: %s', $formattedContent->getFormat())
        );
    }

    public function supports($format): bool
    {
        $supports = false;
        foreach ($this->contentFormatters as $contentFormatter) {
            if ($contentFormatter->supports($format)) {
                $supports = true;
                break;
            }
        }

        return $supports;
    }
}
