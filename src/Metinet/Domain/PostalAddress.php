<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class PostalAddress
{
    private $street;
    private $postalCode;
    private $city;
    private $country;

    public function __construct($street, $postalCode, $city, $country)
    {
        $this->street     = $street;
        $this->postalCode = $postalCode;
        $this->city       = $city;
        $this->country    = $country;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }
}
