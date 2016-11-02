<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\DoctrineBundle\Entity\Traits\BaseEntity;
use Librinfo\DoctrineBundle\Entity\Traits\Nameable;
use Librinfo\DoctrineBundle\Entity\Traits\Treeable;
use Librinfo\DoctrineBundle\Entity\Traits\Tree\NodeInterface;

/**
 * Category
 */
class Category implements NodeInterface
{

    use BaseEntity,
        Treeable,
        Nameable
    ;

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


    /**
     * Used by Treeable::setChildNodeOf() to sort the tree
     * @return string
     */
    public function getSortField()
    {
        return $this->getName();
    }

}
