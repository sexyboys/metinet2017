<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class FakeSmsSender implements SmsSender
{
    public function send(Sms $sms)
    {
        // do nothing
    }
}
