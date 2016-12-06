<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\BaseEntitiesBundle\Entity\Traits\Descriptible;
use Blast\BaseEntitiesBundle\Entity\Traits\Nameable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\UserBundle\Entity\Traits\Ownable;
use Librinfo\UserBundle\Entity\Traits\Traceable;
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
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $color;

    /**
     * @var bool
     */
    private $translatable = false;

    /**
     * @var bool
     */
    private $editable = true;

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
     * Set code
     *
     * @param string $code
     *
     * @return Circle
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Circle
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set translatable
     *
     * @param bool $translatable
     *
     * @return Circle
     */
    public function setTranslatable($translatable)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return bool
     */
    public function isTranslatable()
    {
        return $this->translatable;
    }

    /**
     * Set editable
     *
     * @param bool $editable
     *
     * @return Circle
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable
     *
     * @return bool
     */
    public function isEditable()
    {
        return $this->editable;
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

