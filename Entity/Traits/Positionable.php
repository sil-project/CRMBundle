<?php

namespace Librinfo\CRMBundle\Entity\Traits;

/**
 * Positionable trait
 */
trait Positionable
{
    /*
     * @var Collection
     */
    private $positions;
    
    /**
     * @param Position $position
     * @return self
     */
    public function addPosition(Position $position)
    {
        $rc = new \ReflectionClass($this);
        $position->{'set'.$rc->getShortName()}($this);
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
