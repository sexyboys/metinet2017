<?php

namespace Metinet\Http;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class Response
{
    private $statusCode;
    private $body;
    private $headers = [];

    public function __construct($statusCode, $body, array $headers)
    {
        $this->statusCode = $statusCode;
        $this->body       = $body;
        $this->headers    = $headers;
    }

    public static function notFound($body, array $headers)
    {
        return new self(404, $body, $headers);
    }

    public static function success($body, $headers)
    {
        return new self(200, $body, $headers);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function send()
    {
        foreach ($this->headers as $header) {
            header((string) $header);
        }
        http_response_code($this->statusCode);

        echo $this->body;
    }
}
