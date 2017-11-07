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

namespace Sil\Bundle\CRMBundle\Entity;

use AppBundle\Entity\OuterExtension\SilCRMBundle\CircleExtension;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Descriptible;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Nameable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Timestampable;
use Blast\Bundle\OuterExtensionBundle\Entity\Traits\OuterExtensible;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Circle
 * groups of contacts, positions and organisms.
 */
class Circle
{
    use BaseEntity,
        OuterExtensible,
        Nameable,
        Timestampable,
        Descriptible,
        CircleExtension
    ;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $color;

    /**
     * @var bool
     */
    private $translatable = false;

    /**
     * @var bool
     */
    private $editable = true;

    /**
     * @var string
     */
    private $type;

    /**
     * @var Collection
     */
    private $organisms;

    /**
     * @var Collection
     */
    private $positions;

    public function __construct()
    {
        $this->organisms = new ArrayCollection();
        $this->positions = new ArrayCollection();
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Circle
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set color.
     *
     * @param string $color
     *
     * @return Circle
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set translatable.
     *
     * @param bool $translatable
     *
     * @return Circle
     */
    public function setTranslatable($translatable)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable.
     *
     * @return bool
     */
    public function isTranslatable()
    {
        return $this->translatable;
    }

    /**
     * Set editable.
     *
     * @param bool $editable
     *
     * @return Circle
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable.
     *
     * @return bool
     */
    public function isEditable()
    {
        return $this->editable;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param Position $position
     *
     * @return Circle
     */
    public function addPosition(Position $position)
    {
        $position->addCircle($this); // synchronously updating inverse side
        $this->positions->add($position);

        return $this;
    }

    /**
     * @param Position $position
     *
     * @return Circle
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

    /**
     * @param Organism $organism
     *
     * @return Circle
     */
    public function addOrganism(Organism $organism)
    {
        $organism->addCircle($this); // synchronously updating inverse side
        $this->organisms->add($organism);

        return $this;
    }

    /**
     * @param Organism $organism
     *
     * @return Circle
     */
    public function removeOrganism(Organism $organism)
    {
        $this->organisms->removeElement($organism);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrganisms()
    {
        return $this->organisms;
    }

    public function countOrganisms()
    {
        return $this->organisms->count();
    }

    public function countContacts()
    {
        return $this->contacts->count();
    }

    public function countPositions()
    {
        return $this->positions->count();
    }

    public function __toString()
    {
        return (string) sprintf('%s %s', $this->code, $this->name);
    }
}
