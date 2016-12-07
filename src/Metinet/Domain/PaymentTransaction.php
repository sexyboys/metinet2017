<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class PaymentTransaction
{
    const PENDING_APPROVAL = 'pending_approval';
    const SUCCESSFUL       = 'successful';
    const FAILED           = 'failed';

    private $transactionId;
    private $price;
    private $paymentMean;
    private $status;

    public static function successful(string $transactionId, Price $price, string $paymentMean)
    {
        $paymentTransaction = new self();
        $paymentTransaction->transactionId = $transactionId;
        $paymentTransaction->price         = $price;
        $paymentTransaction->paymentMean   = $paymentMean;
        $paymentTransaction->status        = self::SUCCESSFUL;

        return $paymentTransaction;
    }

    public static function failed(string $transactionId, Price $price, string $paymentMean)
    {
        $paymentTransaction = new self();
        $paymentTransaction->transactionId = $transactionId;
        $paymentTransaction->price         = $price;
        $paymentTransaction->paymentMean   = $paymentMean;
        $paymentTransaction->status        = self::FAILED;

        return $paymentTransaction;
    }

    public static function pendingApproval(Price $price, string $paymentMean)
    {
        $paymentTransaction = new self();
        $paymentTransaction->price       = $price;
        $paymentTransaction->paymentMean = $paymentMean;
        $paymentTransaction->status      = self::PENDING_APPROVAL;

        return $paymentTransaction;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPaymentMean()
    {
        return $this->paymentMean;
    }

    public function isSuccessful()
    {
        return $this->status === self::SUCCESSFUL;
    }

    public function isPendingApproval()
    {
        return $this->status === self::PENDING_APPROVAL;
    }

    private function __construct() {}
}
