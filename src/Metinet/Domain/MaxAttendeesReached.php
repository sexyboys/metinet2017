<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class MaxAttendeesReached extends \Exception
{
    public function __construct($maxAttendees)
    {
        parent::__construct(
            sprintf("Max attendees reached (max: %d)", $maxAttendees)
        );
    }
}
