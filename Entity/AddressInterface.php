<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Entity;


/**
 * AddressInterface
 */
interface AddressInterface extends \Sylius\Component\Resource\Model\ResourceInterface
{
    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Address
     */
    public function setFirstName($firstName);

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName();

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return Address
     */
    public function setPostCode($postCode);

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode();

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street);

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet();

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city);

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity();

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country);

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry();

    /**
     * Set npai
     *
     * @param boolean $npai
     * @return Address
     */
    public function setNpai($npai);

    /**
     * Get npai
     *
     * @return boolean 
     */
    public function getNpai();

    /**
     * Set vcardUid
     *
     * @param string $vcardUid
     * @return Address
     */
    public function setVcardUid($vcardUid);

    /**
     * Get vcardUid
     *
     * @return string 
     */
    public function getVcardUid();

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return Address
     */
    public function setConfirmed($confirmed);
    /**
     * Get confirmed
     *
     * @return boolean 
     */
    public function getConfirmed();
    
    /**
     * Set organism
     *
     * @param \Librinfo\CRMBundle\Entity\Organism $organism
     * @return Address
     */
    public function setOrganism(\Librinfo\CRMBundle\Entity\Organism $organism = null);

    /**
     * Get organism
     *
     * @return \Librinfo\CRMBundle\Entity\Organism 
     */
    public function getOrganism();

    /**
     * Set contact
     *
     * @param \Librinfo\CRMBundle\Entity\Contact $contact
     * @return Address
     */
    public function setContact(\Librinfo\CRMBundle\Entity\Contact $contact = null);

    /**
     * Get contact
     *
     * @return \Librinfo\CRMBundle\Entity\Contact 
     */
    public function getContact();
}
