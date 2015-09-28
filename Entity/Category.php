<?php

namespace AppBundle\Entity;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $organisms;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->organisms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add organism
     *
     * @param \AppBundle\Entity\Organism $organism
     *
     * @return Category
     */
    public function addOrganism(\AppBundle\Entity\Organism $organism)
    {
        $this->organisms[] = $organism;

        return $this;
    }

    /**
     * Remove organism
     *
     * @param \AppBundle\Entity\Organism $organism
     */
    public function removeOrganism(\AppBundle\Entity\Organism $organism)
    {
        $this->organisms->removeElement($organism);
    }

    /**
     * Get organisms
     *
     * @return \Doctrine\Common\Collections\Collection
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
