<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity\Association;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Sil\Bundle\CRMBundle\Entity\Position;

/**
 * HasPositions trait.
 */
trait HasPositionsTrait
{
    /**
     * @var Collection
     */
    protected $positions;

    public function initPositions()
    {
        $this->positions = new ArrayCollection();
    }

    /**
     * This function is called by the owning side of the N-N relationship.
     *
     * @param Position $position
     *
     * @return self
     */
    public function addPosition(Position $position)
    {
        if ($this->positions === null) {
            $this->initPositions();
        }

        $this->positions->add($position);

        return $this;
    }

    /**
     * @param Position $position
     *
     * @return self
     */
    public function removePosition(Position $position)
    {
        if ($this->positions === null) {
            $this->initPositions();
        }

        $this->positions->removeElement($position);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPositions(): Collection
    {
        if ($this->positions === null) {
            $this->initPositions();
        }

        return $this->positions;
    }
}
