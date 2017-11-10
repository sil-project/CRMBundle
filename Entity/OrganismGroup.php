<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Nameable;

/**
 * OrganismGroup.
 */
class OrganismGroup
{
    use BaseEntity,
        Nameable
    ;

    /**
     * @var Contact
     */
    protected $contact;

    /**
     * @var Organism
     */
    protected $organism;

    /**
     * @var Collection
     */
    protected $roles;

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
     * addRole.
     *
     * @param Role $role
     *
     * @return self
     */
    public function addRole(Role $role)
    {
        if (!$this->getRoles()->contains($role)) {
            $this->getRoles()->add($role);
            $role->addContactGroup($this);
        }

        return $this;
    }

    /**
     * removeRole.
     *
     * @param Role $role
     *
     * @return self
     */
    public function removeRole(Role $role)
    {
        if ($this->getRoles()->contains($role)) {
            $this->getRoles()->removeElement($role);
            $role->removeContactGroup($this);
        }

        return $this;
    }

    /**
     * __toString.
     *
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getId();
    }
}
