<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class ReservationAttempt
{
    private $attendee;
    private $paymentTransaction;
    private $conferenceId;

    public function __construct(Attendee $attendee, PaymentTransaction $paymentTransaction, $conferenceId)
    {
        $this->attendee           = $attendee;
        $this->paymentTransaction = $paymentTransaction;
        $this->conferenceId       = $conferenceId;
    }

    public function getAttendee()
    {
        return $this->attendee;
    }

    public function getPaymentTransaction()
    {
        return $this->paymentTransaction;
    }

    public function getConferenceId()
    {
        return $this->conferenceId;
    }
}
