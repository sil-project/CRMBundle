<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity;

use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Nameable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Treeable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Role.
 */
class Role
{
    use BaseEntity,
        Treeable,
        Nameable
    ;

    /**
     * @var Collection
     */
    protected $contactGroups;

    public function __construct()
    {
        $this->contactGroups = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getContactGroups()
    {
        return $this->contactGroups;
    }

    /**
     * @param Collection $contactGroups
     *
     * @return Role
     */
    public function setContactGroups($contactGroups)
    {
        $this->contactGroups = $contactGroups;

        return $this;
    }

    /**
     * addContactGroup.
     *
     * @param OrganismGroup $contactGroup
     *
     * @return self
     */
    public function addContactGroup(OrganismGroup $contactGroup)
    {
        if (!$this->getContactGroups()->contains($contactGroup)) {
            $this->getContactGroups()->add($contactGroup);
            $contactGroup->addRole($this);
        }

        return $this;
    }

    /**
     * removeContactGroup.
     *
     * @param OrganismGroup $contactGroup
     *
     * @return self
     */
    public function removeContactGroup(OrganismGroup $contactGroup)
    {
        if ($this->getContactGroups()->contains($contactGroup)) {
            $this->getContactGroups()->removeElement($contactGroup);
            $contactGroup->removeRole($this);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
