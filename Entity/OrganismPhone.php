<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity;

use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Stringable;

class OrganismPhone extends Phone
{
    use Stringable;

    /**
     * @var Organism
     */
    protected $organism;

    /**
     * Get organism.
     *
     * @return Organism
     */
    public function getOrganism()
    {
        return $this->organism;
    }

    /**
     * Set organism.
     *
     * @param Organism $organism
     *
     * @return OrganismPhone
     */
    public function setOrganism($organism)
    {
        $this->organism = $organism;

        return $this;
    }
}
