<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\DoctrineBundle\Entity\Traits\BaseEntity;
use Librinfo\DoctrineBundle\Entity\Traits\Nameable;

/**
 * ContactGroup
 */
class ContactGroup
{
    use BaseEntity,
        Nameable
    ;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * @var Organism
     */
    private $organism;

    /**
     * @var Collection
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     *
     * @return ContactGroup
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return Organism
     */
    public function getOrganism()
    {
        return $this->organism;
    }

    /**
     * @param Organism $organism
     *
     * @return ContactGroup
     */
    public function setOrganism($organism)
    {
        $this->organism = $organism;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param Collection $roles
     *
     * @return ContactGroup
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * addRole
     *
     * @param Role $role
     *
     * @return $this
     *
     */
    public function addRole(Role $role)
    {
        if (!$this->getRoles()->contains($role))
        {
            $this->getRoles()->add($role);
            $role->addContactGroup($this);
        }

        return $this;
    }

    /**
     * removeRole
     *
     * @param Role $role
     *
     * @return $this
     *
     */
    public function removeRole(Role $role)
    {
        if ($this->getRoles()->contains($role))
        {
            $this->getRoles()->removeElement($role);
            $role->removeContactGroup($this);
        }
        return $this;
    }

    /**
     * __toString
     *
     *
     * @return string
     *
     */
    public function __toString()
    {
        return $this->getId();
    }

}
