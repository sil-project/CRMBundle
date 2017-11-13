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

/**
 * HasCircles trait.
 */
trait HasCirclesTrait
{
    use Circlable;

    public function initCircles()
    {
        $this->circles = new ArrayCollection();
    }
}
