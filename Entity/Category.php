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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Nameable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\NestedTreeable;

/**
 * Category.
 */
class Category
{
    use BaseEntity,
        Nameable,
        NestedTreeable
    ;

    /**
     * @var Collection
     */
    protected $organisms;

    /**
     * Constructor.
     */
    public function __construct()
    {
        //init NesteTreeable treeChildren Collection
        $this->initCollections();
        $this->organisms = new ArrayCollection();
    }

    /**
     * Add organism.
     *
     * @param Organism $organism
     *
     * @return Category
     */
    public function addOrganism(Organism $organism)
    {
        $this->organisms[] = $organism;

        return $this;
    }

    /**
     * Remove organism.
     *
     * @param Organism $organism
     */
    public function removeOrganism(Organism $organism)
    {
        $this->organisms->removeElement($organism);
    }

    /**
     * Get organisms.
     *
     * @return Collection
     */
    public function getOrganisms()
    {
        return $this->organisms;
    }
}
