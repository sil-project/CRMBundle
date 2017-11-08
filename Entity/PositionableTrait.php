<?php

/*
 * This file is part of the Sil Project.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity;

/**
 * Positionable trait.
 */
trait PositionableTrait
{
    /*
     * @var Collection
     */
    protected $positions;

    /**
     * @param Position $position
     *
     * @return self
     */
    public function addPosition(Position $position)
    {
        $rc = new \ReflectionClass($this);
        $position->{'set' . $rc->getShortName()}($this);
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
