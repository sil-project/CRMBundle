<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Addressable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Emailable;
use Librinfo\CRMBundle\Entity\Traits\Positionable;
use Librinfo\CRMBundle\Entity\Traits\Circlable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Descriptible;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Searchable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Loggable;

/**
 * Organism
 */
class Organism implements VCardableInterface
{
    use BaseEntity,
        Traceable,
        Addressable,
        Emailable,
        Positionable,
        Circlable,
        Descriptible,
        Searchable,
        Loggable
    ;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $administrativeNumber;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var Collection
     */
    private $phones;

    /**
     * Organism constructor.
     */
    public function __construct()
    {
        $this->circles = new ArrayCollection();
        $this->positions = new ArrayCollection();
        $this->phones = new ArrayCollection();
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Organism
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Organism
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set administrativeNumber
     *
     * @param string $administrativeNumber
     *
     * @return Organism
     */
    public function setAdministrativeNumber($administrativeNumber)
    {
        $this->administrativeNumber = $administrativeNumber;

        return $this;
    }

    /**
     * Get administrativeNumber
     *
     * @return string
     */
    public function getAdministrativeNumber()
    {
        return $this->administrativeNumber;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Organism
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }


    /**
     * @param OrganismPhone $phone
     * @return Organism
     */
    public function addPhone(OrganismPhone $phone)
    {
        $phone->setOrganism($this);
        $this->phones->add($phone);
        return $this;
    }

    /**
     * @param OrganismPhone $phone
     * @return Organism
     */
    public function removePhone(OrganismPhone $phone)
    {
        $this->phones->removeElement($phone);
        return $this;
    }

    public function isPersonal()
    {
        return false;
    }
}
