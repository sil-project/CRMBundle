<?php

namespace Librinfo\CRMBundle\Entity\OuterExtension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\CRMBundle\Entity\Organism;

/**
 * HasOrganisms trait
 */
trait HasOrganisms
{
    /**
     * @var Collection
     */
    private $organisms;

    public function initOrganisms()
    {
        $this->organisms = new ArrayCollection();
    }

    /**
     * This function is called by the owning side of the N-N relationship
     * @param Organism $organism
     * @return self
     */
    public function addOrganism(Organism $organism)
    {
        $this->organisms->add($organism);
        return $this;
    }

    /**
     * @param Organism $organism
     * @return self
     */
    public function removeOrganism(Organism $organism)
    {
        $this->organisms->removeElement($organism);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrganisms()
    {
        return $this->organisms;
    }

}
