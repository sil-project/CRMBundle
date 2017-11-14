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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * HasPositions trait.
 */
trait HasPositionsTrait
{
    /**
     * @var Collection
     */
    protected $positions;

    /**
     * This function is called by the owning side of the N-N relationship.
     *
     * @param Position $position
     *
     * @return self
     */
    public function addPosition(Position $position)
    {
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
