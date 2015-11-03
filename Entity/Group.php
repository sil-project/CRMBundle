<?php

namespace Librinfo\CRMBundle\Entity;

/**
 * Group
 */
class Group
{

    /**
     * @var Guid
     */
    private $contact;

    /**
     * @var Guid
     */
    private $organism;

    /**
     * @var Guid
     */
    private $role;

    /**
     * Group constructor.
     *
     * @param Guid $contact
     * @param Guid $organism
     * @param Guid $role
     */
    public function __construct($contact, $organism, $role)
    {
        $this->contact = $contact;
        $this->organism = $organism;
        $this->role = $role;
    }

    /**
     * @return Guid
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Guid $contact
     *
     * @return Group
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return Guid
     */
    public function getOrganism()
    {
        return $this->organism;
    }

    /**
     * @param Guid $organism
     *
     * @return Group
     */
    public function setOrganism($organism)
    {
        $this->organism = $organism;
        return $this;
    }

    /**
     * @return Guid
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param Guid $role
     *
     * @return Group
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

}
