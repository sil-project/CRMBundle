<?php

namespace Librinfo\CRMBundle\Entity;

use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Nameable;

/**
 * Position
 */
class Position
{

    use BaseEntity,
        Nameable;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $description;

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
    private $position_type;    

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Position
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Position
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set position_type
     *
     * @param string $position_type
     *
     * @return Position
     */
    public function setPositionType($position_type)
    {
        $this->position_type = $position_type;

        return $this;
    }

    /**
     * Get position_type
     *
     * @return string
     */
    public function getPositionType()
    {
        return $this->position_type;
    }    
}
