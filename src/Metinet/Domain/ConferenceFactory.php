<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class ConferenceFactory
{
    public static function fromArray(array $data)
    {
        $speakers = [];
        foreach ($data['speakers'] as $speaker) {
            $speakers[] = new Speaker($speaker['firstName'], $speaker['lastName'], $speaker['description']);
        }

        return new Conference(
            $data['id'],
            $data['title'],
            $data['maxAttendees'],
            new Location(
                $data['location']['placeName'],
                new PostalAddress(
                    $data['location']['postalAddress']['street'],
                    $data['location']['postalAddress']['postalCode'],
                    $data['location']['postalAddress']['city'],
                    $data['location']['postalAddress']['country']
                )
            ),
            \DateTimeImmutable::createFromFormat("Y-m-d\TH:i:s", $data['date'], new \DateTimeZone('UTC')),
            new Price($data['price']),
            $speakers
        );
    }
}
