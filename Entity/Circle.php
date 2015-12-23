<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Nameable;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\UserBundle\Entity\Traits\Ownable;
use Librinfo\CRMBundle\Entity\Contact;
use Librinfo\CRMBundle\Entity\Organism;

/**
 * Circle
 * groups of contacts and organisms
 */
class Circle
{
    use BaseEntity,
        Nameable,
        Ownable,
        Traceable;

    /**
     * @var Collection
     */
    private $contacts;

    /**
     * @var Collection
     */
    private $organisms;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->organisms = new ArrayCollection();
    }

    /**
     * @param Contact $contact
     * @return Circle
     */
    public function addContact(Contact $contact)
    {
        $contact->addCircle($this); // synchronously updating inverse side
        $this->contacts->add($contact);
        return $this;
    }

    /**
     * @param Contact $contact
     * @return Circle
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

    /**
     * @param Organism $organism
     * @return Circle
     */
    public function addOrganism(Organism $organism)
    {
        $organism->addCircle($this); // synchronously updating inverse side
        $this->organisms->add($organism);
        return $this;
    }

    /**
     * @param Organism $organism
     * @return Circle
     */
    public function removeOrganism(Organism $organism)
    {
        $this->organisms->removeElement($organism);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrganisms()
    {
        return $this->organisms;
    }

}

