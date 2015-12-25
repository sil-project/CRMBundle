<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Addressable;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\BaseEntitiesBundle\Entity\Traits\Emailable;
use Librinfo\CRMBundle\Entity\Traits\Positionable;
use Librinfo\CRMBundle\Entity\Traits\Circlable;
use Librinfo\CRMBundle\Entity\ContactPhone;

/**
 * Contact
 */
class Contact
{

    use BaseEntity,
        Addressable,
        Traceable,
        Emailable,
        Positionable,
        Circlable
    ;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $shortname;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $flashOnControl;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $familyContact;

    /**
     * @var string
     */
    private $culture;

    /**
     * @var Collection
     */
    private $phones;

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Contact
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     *
     * @return Contact
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Contact
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set flashOnControl
     *
     * @param string $flashOnControl
     *
     * @return Contact
     */
    public function setFlashOnControl($flashOnControl)
    {
        $this->flashOnControl = $flashOnControl;

        return $this;
    }

    /**
     * Get flashOnControl
     *
     * @return string
     */
    public function getFlashOnControl()
    {
        return $this->flashOnControl;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Contact
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set familyContact
     *
     * @param boolean $familyContact
     *
     * @return Contact
     */
    public function setFamilyContact($familyContact)
    {
        $this->familyContact = $familyContact;

        return $this;
    }

    /**
     * Get familyContact
     *
     * @return boolean
     */
    public function getFamilyContact()
    {
        return $this->familyContact;
    }

    /**
     * Set culture
     *
     * @param string $culture
     *
     * @return Contact
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string
     */
    public function getCulture()
    {
        return $this->culture;
    }

    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->circles = new ArrayCollection();
        $this->positions = new ArrayCollection();
    }

    /**
     * @param ContactPhone $phone
     * @return Contact
     */
    public function addPhone(ContactPhone $phone)
    {
        $phone->setContact($this);
        $this->phones->add($phone);
        return $this;
    }

    /**
     * @param ContactPhone $phone
     * @return Contact
     */
    public function removePhone(ContactPhone $phone)
    {
        $this->phones->removeElement($phone);
        return $this;
    }

    /**
     * Get phones
     *
     * @return Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }
    
    public function __toString()
    {
        return $this->getFirstname().' '.$this->getName();
    }
}
