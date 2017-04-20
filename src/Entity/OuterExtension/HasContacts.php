<?php

namespace Librinfo\CRMBundle\Entity\OuterExtension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\CRMBundle\Entity\Contact;

/**
 * HasContacts trait
 */
trait HasContacts
{
    /**
     * @var Collection
     */
    private $contacts;

    public function initContacts()
    {
        $this->contacts = new ArrayCollection();
    }

    /**
     * This function is called by the owning side of the N-N relationship
     * @param Contact $contact
     * @return self
     */
    public function addContact(Contact $contact)
    {
        $this->contacts->add($contact);
        return $this;
    }

    /**
     * @param Contact $contact
     * @return self
     */
    public function removeContact(Contact $contact)
    {
        $this->contacts->removeElement($contact);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

}
