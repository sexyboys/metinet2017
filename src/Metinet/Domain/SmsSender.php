<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

interface SmsSender
{
    public function send(Sms $sms);
}
