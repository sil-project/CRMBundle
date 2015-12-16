<?php

namespace Librinfo\CRMBundle\Entity;

use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;

/**
 * ContactPhone
 */
class ContactPhone
{
    use BaseEntity;
    
    /**
     * @var string
     */
    private $number;
    
    /**
     * @var Contact
     */
    private $contact;   
    
    public function __toString()
    {
        return $this->number;
    }
    
    /**
     * Set number
     *
     * @param string $number
     *
     * @return ContactPhone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
    
    /**
     * Get contact
     *
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }    
    
    /**
     * Set contact
     *
     * @param Contact $contact
     *
     * @return ContactPhone
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }



}
