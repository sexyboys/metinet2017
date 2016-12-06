<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Location
{
    private $placeName;
    private $address;

    public function __construct(string $placeName, PostalAddress $address)
    {
        $this->address   = $address;
        $this->placeName = $placeName;
    }

    public function getPlaceName()
    {
        return $this->placeName;
    }

    public function getAddress()
    {
        return $this->address;
    }
}
