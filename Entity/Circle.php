<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Nameable;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Descriptible;
use Librinfo\UserBundle\Entity\Traits\Ownable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Circle
 * groups of contacts, positions and organisms
 */
class Circle
{
    use BaseEntity,
        Nameable,
        Ownable,
        Traceable,
        Descriptible
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

    /**
     * @var Collection
     */
    private $users;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->organisms = new ArrayCollection();
        $this->positions = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * @param Position $position
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

    /**
     * @param UserInterface $user
     * @return Circle
     */
    public function addUser(UserInterface $user)
    {
        $this->users->add($user);
        return $this;
    }

    /**
     * @param UserInterface $user
     * @return Circle
     */
    public function removeUser(UserInterface $user)
    {
        $this->users->removeElement($user);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}

