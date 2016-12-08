<?php

namespace Metinet\Domain\Blog;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class PublicationDate
{
    private $date;

    public static function fromDateTime(\DateTime $datetime)
    {
        return new self($datetime);
    }

    public function format($format)
    {
        return $this->date->format($format);
    }

    public function toDateTimeImmutable()
    {
        return \DateTimeImmutable::createFromMutable($this->date);
    }

    private function __construct(\DateTime $datetime)
    {
        if ($datetime <= new \DateTime('-2 sec')) {

            throw InvalidPublicationDate::cannotBeSetInThePast();
        }

        $this->date = $datetime;
    }
}
