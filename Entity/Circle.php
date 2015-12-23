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
 * groups of contacts, positions and organisms
 */
class Circle
{
    use BaseEntity,
        Nameable,
        Ownable,
        Traceable
    ;
    
    /**
     * @var Collection
     */
    private $contacts;

    /**
     * @var Collection
     */
    private $organisms;
    
    /**
     * @var Collection
     */
    private $positions;
    
    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->organisms = new ArrayCollection();
        $this->positions = new ArrayCollection();
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
     * @param Position $contact
     * @return Circle
     */
    public function addPosition(Position $position)
    {
        $position->addCircle($this); // synchronously updating inverse side
        $this->positions->add($position);
        return $this;
    }
    
    /**
     * @param Position $position
     * @return Circle
     */
    public function removePosition(Position $position)
    {
        $this->positions->removeElement($position);
        return $this;
    }
    
    /**
     * @return Collection
     */
    public function getPositions()
    {
        return $this->positions;
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

