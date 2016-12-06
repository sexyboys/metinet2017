<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class AttendeeReservationNotFound extends \Exception
{
    public function __construct(Attendee $attendee)
    {
        parent::__construct(
            sprintf("Aucune reservation n'a été trouvé. Vérifiez vos informations")
        );
    }
}
