<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Knp\DoctrineBehaviors\Model\Tree\Node;
use Knp\DoctrineBehaviors\Model\Tree\NodeInterface;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Nameable;
use Librinfo\BaseEntitiesBundle\EventListener\TreeableListener;

/**
 * Category
 */
class Category implements NodeInterface
{

    use BaseEntity, Node, Nameable;

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

}
