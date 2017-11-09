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

use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Descriptible;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Emailable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Labelable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Timestampable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Searchable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Position.
 */
class Position implements VCardableInterface
{
    use BaseEntity,
        Timestampable,
        Labelable,
        Emailable,
        Descriptible,
        Searchable;

    use CirclableTrait;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $department;

    /**
     * @var \Sil\Bundle\CRMBundle\Entity\Organism
     */
    protected $individual;

    /**
     * @var \Sil\Bundle\CRMBundle\Entity\Organism
     */
    protected $organization;

    /**
     * @var PositionType
     */
    protected $positionType;

    public function __construct()
    {
        $this->circles = new ArrayCollection();
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Position
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set department.
     *
     * @param string $department
     *
     * @return Position
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department.
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set organism.
     *
     * @param string $organism
     *
     * @return Position
     */
    public function setOrganism($organism)
    {
        $this->organism = $organism;

        return $this;
    }

    /**
     * Get organism.
     *
     * @return string
     */
    public function getOrganism()
    {
        return $this->organism;
    }

    /**
     * Set positionType.
     *
     * @param string $positionType
     *
     * @return Position
     */
    public function setPositionType($positionType)
    {
        $this->positionType = $positionType;

        return $this;
    }

    /**
     * Get positionType.
     *
     * @return string
     */
    public function getPositionType()
    {
        return $this->positionType;
    }

    /**
     * Set individual.
     *
     * @param \Sil\Bundle\CRMBundle\Entity\Organism $individual
     *
     * @return Position
     */
    public function setIndividual(\Sil\Bundle\CRMBundle\Entity\Organism $individual)
    {
        $this->individual = $individual;

        return $this;
    }

    /**
     * Get individual.
     *
     * @return \Sil\Bundle\CRMBundle\Entity\Organism
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Set organization.
     *
     * @param \Sil\Bundle\CRMBundle\Entity\Organism $organization
     *
     * @return Position
     */
    public function setOrganization(\Sil\Bundle\CRMBundle\Entity\Organism $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization.
     *
     * @return \Sil\Bundle\CRMBundle\Entity\Organism
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @return string
     **/
    public function __toString()
    {
        return (string) $this->getPositionType();
    }

    public function isPersonal()
    {
        return false;
    }

    /**
     * description of the position from the individual point of view.
     *
     * @return string
     */
    public function getContactDescription()
    {
        $desc = (string) $this->organization;
        if ((string) $this) {
            $desc .= ' (' . (string) $this . ')';
        }

        return $desc;
    }

    /**
     * description of the position from the organization point of view.
     *
     * @return string
     */
    public function getOrganismDescription()
    {
        $desc = (string) $this->individual;
        if ((string) $this) {
            $desc .= ' (' . (string) $this . ')';
        }

        return $desc;
    }
}
