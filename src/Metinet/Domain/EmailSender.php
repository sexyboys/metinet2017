<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

interface EmailSender
{
    public function send(EmailMessage $emailMessage);
}
