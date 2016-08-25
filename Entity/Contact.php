<?php

namespace Librinfo\CRMBundle\Entity;

use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\DoctrineBundle\Entity\Traits\BaseEntity;
use Librinfo\DoctrineBundle\Entity\Traits\Addressable;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\DoctrineBundle\Entity\Traits\Emailable;
use Librinfo\DoctrineBundle\Entity\Traits\Descriptible;
use Librinfo\CRMBundle\Entity\Traits\Positionable;
use Librinfo\CRMBundle\Entity\Traits\Circlable;
use Librinfo\CRMBundle\Entity\ContactPhone;
use Librinfo\DoctrineBundle\Entity\Traits\Searchable;

/**
 * Contact
 */
class Contact implements VCardableInterface
{

    use BaseEntity,
        Addressable,
        Traceable,
        Emailable,
        Positionable,
        Circlable,
        Descriptible,
        Searchable
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
        $this->emailMessages = new ArrayCollection();
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

    public function isPersonal()
    {
        return true;
    }

    /**
     * ex. "Mr John DOE"
     * @return string
     */
    public function getFulltextName()
    {
        return sprintf('%s %s %s', $this->getTitle(), ucfirst(strtolower($this->getFirstname())), strtoupper($this->getName()));
    }

    public function validateName(ExecutionContextInterface $context)
    {
        // check if name or fistname are filled
        if ( empty(trim($this->getName()) . trim($this->getFirstname())) ) {
            $context->buildViolation('librinfo.error.provide_name_or_firstname')
                ->atPath('name')
                ->addViolation();
            $context->buildViolation('librinfo.error.provide_name_or_firstname')
                ->atPath('firstname')
                ->addViolation();
        }
    }
}
