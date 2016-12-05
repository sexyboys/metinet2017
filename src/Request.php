<?php

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class Request
{
    private $method;
    private $path;
    private $queryParameters = [];
    private $headers = [];
    private $body;

    public function __construct($method, $path, array $queryParameters,
        array $headers, $body)
    {
        $this->method          = $method;
        $this->path            = $path;
        $this->queryParameters = $queryParameters;
        $this->headers         = $headers;
        $this->body            = $body;
    }

    public static function createFromGlobals()
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if ('HTTP_' === substr($key, 0, 5)) {
                $headerName = str_replace('_', '-', strtolower(substr($key, 5)));
                $headers[] = new Header($headerName, $value);
            }
        }

        parse_str($_SERVER['QUERY_STRING'], $queryParameters);
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];

        $request = new Request(
            $_SERVER['REQUEST_METHOD'],
            $path,
            $queryParameters,
            $headers,
            file_get_contents('php://input')
        );

        return $request;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getQueryParameters()
    {
        return $this->queryParameters;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getBody()
    {
        return $this->body;
    }
}
