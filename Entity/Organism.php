<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sil\Bundle\CRMBundle\Entity\Association\HasAddressesTrait;
use Sil\Bundle\CRMBundle\Entity\Association\HasPositionsTrait;
use Sil\Bundle\CRMBundle\Entity\Association\HasCirclesTrait;

/**
 * Organism.
 */
class Organism extends OrganismAbstract
{
    use
        HasAddressesTrait,
        HasPositionsTrait,
        HasCirclesTrait;

    public function __construct()
    {
        parent::__construct();
        $this->addresses = new ArrayCollection();
    }
}
