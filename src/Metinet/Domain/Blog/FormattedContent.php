<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Blog;

class FormattedContent
{
    const MARKDOWN   = 'markdown';
    const TEXTILE    = 'textile';
    const PLAIN_TEXT = 'plain_text';

    private $content;
    private $format;

    public function __construct($content, $format)
    {
        $this->content = $content;
        $this->format  = $format;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public static function availableFormats()
    {
        return [
            self::MARKDOWN,
            self::PLAIN_TEXT,
            self::PLAIN_TEXT,
        ];
    }
}
