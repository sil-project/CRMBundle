<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\DoctrineBundle\Entity\Traits\BaseEntity;
use Librinfo\DoctrineBundle\Entity\Traits\Nameable;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\DoctrineBundle\Entity\Traits\Descriptible;
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

    /**
     * @param UserInterface $user
     * @return boolean
     */
    public function isAccessibleBy(UserInterface $user)
    {
        // no owner and no users : everybody has access to the circle
        if ( !$this->getOwner() && $this->getUsers()->isEmpty() )
            return true;

        // current user is the circle owner
        if ( $this->getOwner() && $user->getId() === $this->getOwner()->getId() )
            return true;

        // current user belongs to the circle users
        foreach ( $this->getUsers() as $u)
        if ( $user->getId() === $u->getId() )
            return true;

        return false;
    }

    public function countOrganisms()
    {
        dump('here');
        return $this->organisms->count();
    }

    public function countContacts()
    {
        return $this->contacts->count();
    }

    public function countPositions()
    {
        return $this->positions->count();
    }

}

