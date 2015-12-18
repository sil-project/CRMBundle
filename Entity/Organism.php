<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Addressable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Emailable;

/**
 * Organism
 */
class Organism
{
    use BaseEntity, Traceable, Addressable, Emailable;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $administrativeNumber;

    /**
     * @var Collection
     */
    private $categories;
    
    /**
     * @var Collection
     */
    private $circles;    

    /**
     * Organism constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->circles = new ArrayCollection();
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
     * @param Collection $categories
     *
     * @return Organism
     */
    public function setCategories(Collection $categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    /**
     * This function is called by the owning side (Circle::addOrganism) of the N-N relationship
     * @param \Librinfo\CRMBundle\Entity\Circle $circle
     * @return Organism
     */    
    public function addCircle(Circle $circle)
    {
        $this->circles->add($circle);
        return $this;
    }    
    
    /**
     * @param Circle $circle
     * @return Organism
     */    
    public function removeCircle(Circle $circle)
    {
        $this->circles->removeElement($circle);
        return $this;
    }      
    
    /**
     * @return Collection
     */
    public function getCircles()
    {
        return $this->circles;
    }  
}
