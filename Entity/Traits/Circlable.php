<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity\Traits;

use Sil\Bundle\CRMBundle\Entity\Circle;

/**
 * Circlable trait.
 */
trait Circlable
{
    /**
     * @var Collection
     */
    private $circles;

    /**
     * This function is called by the owning side (Circle::addContact) of the N-N relationship.
     *
     * @param \Sil\Bundle\CRMBundle\Entity\Circle $circle
     *
     * @return Contact
     */
    public function addCircle(Circle $circle)
    {
        $this->circles->add($circle);

        return $this;
    }

    /**
     * @param Circle $circle
     *
     * @return Contact
     */
    public function removeCircle(Circle $circle)
    {
        $this->circles->removeElement($circle);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCircles()
    {
        return $this->circles;
    }
}
