<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Domain\Attendee;
use Metinet\Domain\AttendeeReservationNotFound;
use Metinet\Domain\ConferenceFactory;
use Metinet\Domain\FakeSmsSender;
use Metinet\Domain\MaxAttendeesReached;
use Metinet\Domain\PaymentMean;
use Metinet\Domain\PaymentTransaction;
use Metinet\Domain\PhoneNumber;
use Metinet\Domain\Conference;
use Metinet\Domain\Location;
use Metinet\Domain\PostalAddress;
use Metinet\Domain\Price;
use Metinet\Domain\Reservation;
use Metinet\Domain\ReservationAttempt;
use Metinet\Domain\ReservationService;
use Metinet\Domain\Sms;
use Metinet\Domain\Speaker;
use Metinet\Domain\UnableToReserve;
use Metinet\Http\Request;
use Metinet\Http\Response;
use Metinet\Repositories\ConferenceNotFound;
use Metinet\Repositories\InMemoryConferenceRepository;

class ConferenceController
{
    private $conferenceRepository;
    private $reservationService;

    public function __construct()
    {
        $conferenceRepository = new InMemoryConferenceRepository();
        $smsSender = new FakeSmsSender();
        $reservationService = new ReservationService($conferenceRepository, $smsSender);

        $this->conferenceRepository = $conferenceRepository;
        $this->reservationService = $reservationService;

        $this->conferenceRepository->add(new Conference(
            '1234567890',
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
        ));
    }

    public function reserve(Request $request)
    {
        $body = http_build_query([
            'conferenceId' => '1234567890',
            'firstName'    => 'Boris',
            'lastName'     => 'Guéry',
            'phoneNumber'  => '+33686830312'
        ]);
        $request = new Request('POST', '/conferences/reserve', [], [], $body);

        parse_str($request->getBody(), $data);

        $attendee = new Attendee($data['firstName'], $data['lastName'], new PhoneNumber($data['phoneNumber']));
        $paymentTransaction = PaymentTransaction::successful(uniqid(), new Price(100), PaymentMean::CREDIT_CARD);

        $reservationAttempt = new ReservationAttempt(
            $attendee,
            $paymentTransaction,
            $data['conferenceId']
        );

        try {
            $this->reservationService->reserve($reservationAttempt);
        } catch (UnableToReserve $e) {
            return Response::success($e->getMessage(), []);
        }

        return Response::success("Reservation successful", []);
    }

    public function view(Request $request)
    {
        $conferenceId = $request->getQueryParameters()['conferenceId'];
        try {
            $conference = $this->conferenceRepository->get($conferenceId);
        } catch (ConferenceNotFound $e) {

            return Response::notFound(sprintf("Conference %s not found.", $conferenceId), []);
        }

        return Response::success(var_export($conference, true), []);
    }

    public function addConference(Request $request)
    {
        $body = [
            'title' => 'La programmation orientée objet',
            'maxAttendees' => 1,
            'location' => [
                'placeName' => 'LP Metinet',
                'postalAddress' => [
                    'street' => '21, rue Peter Fink',
                    'postalCode' => '01000',
                    'city' => 'Bourg-en-Bresse',
                    'country' => 'France',
                ],
            ],
            'date' => '2016-12-25T20:00:00',
            'price' => 10000,
            'speakers' => [
                [
                    'firstName' => 'Boris',
                    'lastName'  => 'Guéry',
                    'description' => 'blalbalba',
                ]
            ]
        ];
        $request = new Request('POST', '/conferences/add', [], [], $body);

        $data = $request->getBody();
        unset($data['id']);
        $data['id'] = uniqid();

        $conference = ConferenceFactory::fromArray($data);

        $this->conferenceRepository->add($conference);
        $conference = $this->conferenceRepository->get($data['id']);

        return Response::success(var_export($conference, true), []);
    }

    public function listConferences(Request $request)
    {
        $conferences = $this->conferenceRepository->all();

        $body = "";
        foreach ($conferences as $conference) {
            $body .= "\n\n" . var_export($conference, true);
        }

        return Response::success($body, ['Content-Type' => 'text/plain']);
    }
}
