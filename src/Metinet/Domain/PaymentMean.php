<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

final class PaymentMean
{
    const CREDIT_CARD   = 'credit_card';
    const WIRE_TRANSFER = 'wire_transfer';

    public static function isValid($paymentMean)
    {
        return in_array($paymentMean, [self::CREDIT_CARD, self::WIRE_TRANSFER]);
    }

    private function __construct() {}
}
