<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Treeable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Nameable;

/**
 * Role
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
    private $contactGroups;

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
     * addContactGroup
     *
     * @param ContactGroup $contactGroup
     *
     * @return $this
     *
     */
    public function addContactGroup(ContactGroup $contactGroup)
    {
        if (!$this->getContactGroups()->contains($contactGroup))
        {
            $this->getContactGroups()->add($contactGroup);
            $contactGroup->addRole($this);
        }

        return $this;
    }

    /**
     * removeContactGroup
     *
     * @param ContactGroup $contactGroup
     *
     * @return $this
     *
     */
    public function removeContactGroup(ContactGroup $contactGroup)
    {
        if ($this->getContactGroups()->contains($contactGroup))
        {
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
