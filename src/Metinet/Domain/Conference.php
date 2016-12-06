<?php

namespace Metinet\Domain;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class Conference
{
    private $title;
    private $maxAttendees;
    private $location;
    private $date;
    private $attendees = [];

    public function __construct(string $title, int $maxAttendees, Location $location, \DateTimeImmutable $date)
    {
        $this->title        = $title;
        $this->maxAttendees = $maxAttendees;
        $this->location     = $location;
        $this->date         = $date;
    }

    public function registerAttendee(Attendee $attendee)
    {
        $this->ensureConferenceHasNotBeenReachedMaxAttendees();
        $this->attendees[] = $attendee;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getDate()
    {
        return $this->date;
    }

    private function ensureConferenceHasNotBeenReachedMaxAttendees()
    {
        if ((1 + count($this->attendees)) > $this->maxAttendees) {
            throw new MaxAttendeesReached($this->maxAttendees);
        }
    }
}
