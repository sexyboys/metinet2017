<?php

namespace Metinet\Domain;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class Conference
{
    private $id;
    private $title;
    private $maxAttendees;
    private $location;
    private $date;
    private $reservations = [];
    private $price;
    private $speakers = [];

    public function __construct(string $id, string $title, int $maxAttendees, Location $location,
        \DateTimeImmutable $date, Price $price, array $speakers)
    {
        $this->id           = $id;
        $this->title        = $title;
        $this->maxAttendees = $maxAttendees;
        $this->location     = $location;
        $this->date         = $date;
        $this->price        = $price;
        $this->speakers     = $speakers;
    }

    public function reserve(Reservation $reservation)
    {
        $this->ensureConferenceHasNotBeenReachedMaxAttendees();
        $this->reservations[] = $reservation;
    }

    public function cancelReservation(Attendee $attendee)
    {
        foreach ($this->reservations as $index => $reservation) {
            if ($reservation->getAttendee()->isEqual($attendee)) {
                unset($this->reservations[$index]);
                return;
            }
        }

        throw new AttendeeReservationNotFound($attendee);
    }

    public function getId()
    {
        return $this->id;
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

    public function getPrice()
    {
        return $this->price->getPrice();
    }

    public function getSpeakers()
    {
        return $this->speakers;
    }

    public function getReservations()
    {
        return $this->reservations;
    }

    private function ensureConferenceHasNotBeenReachedMaxAttendees()
    {
        if ((1 + count($this->reservations)) > $this->maxAttendees) {

            throw new MaxAttendeesReached($this->maxAttendees);
        }
    }
}
