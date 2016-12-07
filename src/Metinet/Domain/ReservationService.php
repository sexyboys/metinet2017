<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

use Metinet\Repositories\ConferenceNotFound;
use Metinet\Repositories\ConferenceRepository;
use Metinet\Repositories\InMemoryConferenceRepository;

class ReservationService
{
    private $conferenceRepository;
    private $smsSender;

    public function __construct(ConferenceRepository $conferenceRepository,
        SmsSender $smsSender)
    {
        $this->conferenceRepository = $conferenceRepository;
        $this->smsSender            = $smsSender;
    }

    public function reserve(ReservationAttempt $reservationAttempt)
    {
        try {
            $conference = $this->conferenceRepository->get($reservationAttempt->getConferenceId());
        } catch (ConferenceNotFound $e) {

            throw UnableToReserve::conferenceNotFound();
        }

        try {
            $conference->reserve(
                new Reservation(
                    $reservationAttempt->getAttendee(),
                    $reservationAttempt->getPaymentTransaction()
                )
            );
        } catch (MaxAttendeesReached $e) {

            throw UnableToReserve::maxAttendeesReached();
        }

        $phoneNumber = $reservationAttempt->getAttendee()->getPhoneNumber();
        $this->smsSender->send(
            new Sms($phoneNumber, 'Votre réservation a bien été prise en compte')
        );
    }
}
