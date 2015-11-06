<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ContactGroup
 */
class ContactGroup
{

    /**
     * @var string
     */
    private $id;

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
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
    public function addRole($role)
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
    public function removeRole($role)
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
