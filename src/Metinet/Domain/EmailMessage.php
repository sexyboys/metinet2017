<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;


class EmailMessage
{
    private $to;
    private $from;
    private $subject;
    private $message;

    public function __construct($to, $from, $subject, $message)
    {
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getSubject()
    {
        return $this->subject;
    }
}
