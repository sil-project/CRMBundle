<?php

namespace Librinfo\CRMBundle\Entity\OuterExtension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\CRMBundle\Entity\Position;

/**
 * HasPositions trait
 */
trait HasPositions
{
    /**
     * @var Collection
     */
    private $positions;

    public function initPositions()
    {
        $this->positions = new ArrayCollection();
    }

    /**
     * This function is called by the owning side of the N-N relationship
     * @param Position $position
     * @return self
     */
    public function addPosition(Position $position)
    {
        $this->positions->add($position);
        return $this;
    }

    /**
     * @param Position $position
     * @return self
     */
    public function removePosition(Position $position)
    {
        $this->positions->removeElement($position);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }

}
