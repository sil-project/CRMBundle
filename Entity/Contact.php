<?php

namespace Librinfo\CRMBundle\Entity;
use Librinfo\CoreBundle\Entity\Addressable;

/**
 * Contact
 */
class Contact extends Addressable
{
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
}

