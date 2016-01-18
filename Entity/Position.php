<?php

namespace Librinfo\CRMBundle\Entity;

use Librinfo\DoctrineBundle\Entity\Traits\BaseEntity;
use Librinfo\DoctrineBundle\Entity\Traits\Labelable;
use Librinfo\DoctrineBundle\Entity\Traits\Emailable;
use Librinfo\CRMBundle\Entity\Traits\Circlable;
use Librinfo\DoctrineBundle\Entity\Traits\Descriptible;

/**
 * Position
 */
class Position implements VCardableInterface
{
    use BaseEntity,
        Labelable,
        Emailable,
        Circlable,
        Descriptible
    ;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $department;
    
    /**
     * @var Contact
     */
    private $contact;
    
    /**
     * @var Organism
     */
    private $organism;
    
    /**
     * @var PositionType
     */
    private $positionType;

    /**
     * Set phone
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
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set department
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
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Position
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set organism
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
     * Get organism
     *
     * @return string
     */
    public function getOrganism()
    {
        return $this->organism;
    }

    /**
     * Set positionType
     *
     * @param string $position_type
     *
     * @return Position
     */
    public function setPositionType($positionType)
    {
        $this->positionType = $positionType;

        return $this;
    }

    /**
     * Get positionType
     *
     * @return string
     */
    public function getPositionType()
    {
        return $this->positionType;
    }
    
    /**
     * @return string
     **/
    public function __toString()
    {
        return $this->label ? $this->getLabel() : (string)$this->getPositionType();
    }
    
    public function isPersonal()
    {
        return false;
    }
}
