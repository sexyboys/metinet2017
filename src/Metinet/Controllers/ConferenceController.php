<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Domain\Attendee;
use Metinet\Domain\AttendeeReservationNotFound;
use Metinet\Domain\MaxAttendeesReached;
use Metinet\Domain\PaymentMean;
use Metinet\Domain\PaymentTransaction;
use Metinet\Domain\PhoneNumber;
use Metinet\Domain\Conference;
use Metinet\Domain\Location;
use Metinet\Domain\PostalAddress;
use Metinet\Domain\Price;
use Metinet\Domain\Reservation;
use Metinet\Domain\Speaker;
use Metinet\Http\Request;
use Metinet\Http\Response;

class ConferenceController
{
    public function listConferences(Request $request)
    {
        $conference = new Conference(
            'La programmation orientée objet',
            1,
            new Location(
                'Salle LP Metinet',
                new PostalAddress(
                    '21, rue Peter Fink',
                    '01000',
                    'Bourg-en-Bresse',
                    'France'
                )
            ),
            new \DateTimeImmutable('2016-12-06 14:00'),
            new Price(100),
            [new Speaker('Boris', 'Guéry', 'Blablablabla')]
        );

        // service de payment

        try {
            $conference->reserve(new Reservation(
                new Attendee('Boris', 'Guéry', new PhoneNumber('+33686830312')),
                PaymentTransaction::successful(uniqid(), new Price(100), PaymentMean::CREDIT_CARD)
            ));

            $conference->reserve(new Reservation(
                new Attendee('John', 'Doe', new PhoneNumber('+33686830312')),
                PaymentTransaction::pendingApproval(new Price(100), PaymentMean::WIRE_TRANSFER)
            ));

            $conference->cancelReservation(new Attendee('Boris', 'Guéry', new PhoneNumber('+33686830312')));
            $conference->reserve(new Reservation(
                new Attendee('Boris', 'Guéry', new PhoneNumber('+33686830312')),
                PaymentTransaction::successful(uniqid(), new Price(100), PaymentMean::CREDIT_CARD)
            ));
        } catch (MaxAttendeesReached $e) {

            return new Response(400, "Le nombre d'invité maximum est atteint", []);
        } catch (AttendeeReservationNotFound $e) {

            return new Response(400, $e->getMessage(), []);
        }

        return Response::success(var_export($conference, true), []);
    }
}
