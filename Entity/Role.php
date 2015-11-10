<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;

/**
 * Role
 */
class Role
{
    use BaseEntity, Nameable;

    /**
     * @var string
     */
    private $id;

    /**
     * @var Collection
     */
    private $contactGroups;

    public function __construct()
    {
        $this->contactGroups = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
