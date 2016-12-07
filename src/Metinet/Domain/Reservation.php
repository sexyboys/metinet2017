<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Reservation
{
    private $attendee;
    private $paymentTransaction;

    public function __construct(Attendee $attendee, PaymentTransaction $paymentTransaction)
    {
        $this->attendee           = $attendee;
        $this->paymentTransaction = $paymentTransaction;
    }

    public function getAttendee()
    {
        return $this->attendee;
    }

    public function getPaymentTransaction()
    {
        return $this->paymentTransaction;
    }
}
