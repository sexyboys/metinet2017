<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class UnableToReserve extends \Exception
{
    public static function conferenceNotFound()
    {
        return new self("Unable to reserve, conference not found");
    }

    public static function maxAttendeesReached()
    {
        return new self("Unable to reserve, max attendees reached");
    }
}
