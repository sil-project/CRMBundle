<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity\Association;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sil\Bundle\CRMBundle\Entity\Circle;

/**
 * HasCircles trait.
 */
trait HasCirclesTrait
{
    /**
     * @var Collection
     */
    protected $circles;

    public function initCircles()
    {
        $this->circles = new ArrayCollection();
    }

    /**
     * @param Circle $circle
     *
     * @return Circle
     */
    public function addCircle(Circle $circle = null)
    {
        if ($this->circles === null) {
            $this->initCircles();
        }

        if ($circle && !$this->circles->contains($circle)) {
            $this->circles->add($circle);
        }

        return $this;
    }

    /**
     * @param Circle $circle
     *
     * @return Circle
     */
    public function removeCircle(Circle $circle)
    {
        if ($this->circles === null) {
            $this->initCircles();
        }

        $this->circles->removeElement($circle);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCircles(): Collection
    {
        if ($this->circles === null) {
            $this->initCircles();
        }

        return $this->circles;
    }
}
