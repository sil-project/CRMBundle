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
use Sil\Bundle\CRMBundle\Entity\OrganismInterface;

/**
 * HasOrganisms trait.
 */
trait HasOrganismsTrait
{
    /**
     * @var Collection
     */
    protected $organisms;

    public function initOrganisms()
    {
        $this->organisms = new ArrayCollection();
    }

    /**
     * This function is called by the owning side of the N-N relationship.
     *
     * @param OrganismInterface $organism
     *
     * @return self
     */
    public function addOrganism(OrganismInterface $organism)
    {
        if ($this->organisms === null) {
            $this->initOrganisms();
        }

        $this->organisms->add($organism);

        return $this;
    }

    /**
     * @param OrganismInterface $organism
     *
     * @return self
     */
    public function removeOrganism(OrganismInterface $organism)
    {
        if ($this->organisms === null) {
            $this->initOrganisms();
        }

        $this->organisms->removeElement($organism);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrganisms(): Collection
    {
        if ($this->organisms === null) {
            $this->initOrganisms();
        }

        return $this->organisms;
    }
}
