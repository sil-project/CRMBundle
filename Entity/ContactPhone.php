<?php

namespace Librinfo\CRMBundle\Entity;

class ContactPhone extends Phone
{
    /**
     * @var Contact
     */
    private $contact;

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
     * @return ContactPhone
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

}
