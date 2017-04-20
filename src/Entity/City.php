<?php

namespace Librinfo\CRMBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\Traits\BaseEntity;

/**
 * City
 */
class City
{
    use BaseEntity;

    /**
     * @var string
     */
    private $country_code;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $city;


    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return City
     */
    public function setCountryCode($countryCode)
    {
        $this->country_code = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return City
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return City
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
}

