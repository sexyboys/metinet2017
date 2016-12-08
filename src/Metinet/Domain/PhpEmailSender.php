<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class PhpEmailSender implements EmailSender
{
    public function send(EmailMessage $emailMessage)
    {
        //mail($emailMessage->getTo(), $emailMessage->getSubject(),  $emailMessage->getMessage());
    }
}
