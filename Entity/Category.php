<?php

namespace Librinfo\CRMBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traceable;

/**
 * Category
 */
class Category extends Traceable
{
    /**
     * @var string
     */
    private $name;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @var Collection
     */
    private $organisms;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->organisms = new ArrayCollection();
    }

    /**
     * Add organism
     *
     * @param Organism $organism
     *
     * @return Category
     */
    public function addOrganism(Organism $organism)
    {
        $this->organisms[] = $organism;

        return $this;
    }

    /**
     * Remove organism
     *
     * @param Organism $organism
     */
    public function removeOrganism(Organism $organism)
    {
        $this->organisms->removeElement($organism);
    }

    /**
     * Get organisms
     *
     * @return Collection
     */
    public function getOrganisms()
    {
        return $this->organisms;
    }

    public function __toString()
    {
        return $this->name;
    }
}
