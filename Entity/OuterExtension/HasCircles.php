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

namespace Librinfo\CRMBundle\Entity\OuterExtension;

use Doctrine\Common\Collections\ArrayCollection;
use Librinfo\CRMBundle\Entity\Traits\Circlable;

/**
 * HasAddresses trait.
 */
trait HasCircles
{
    use Circlable;

    public function initCircles()
    {
        $this->circles = new ArrayCollection();
    }
}
