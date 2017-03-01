<?php

/*
 * Copyright (C) 2015-2016 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Entity;

use AppBundle\Entity\OuterExtension\LibrinfoCRMBundle\OrganismExtension;
use AppBundle\Entity\OuterExtension\LibrinfoCRMBundle\OrganismExtensionInterface;
use Blast\BaseEntitiesBundle\Entity\Traits\Addressable;
use Blast\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\BaseEntitiesBundle\Entity\Traits\Descriptible;
use Blast\BaseEntitiesBundle\Entity\Traits\Emailable;
use Blast\BaseEntitiesBundle\Entity\Traits\Loggable;
use Blast\BaseEntitiesBundle\Entity\Traits\Searchable;
use Blast\BaseEntitiesBundle\Entity\Traits\Timestampable;
use Blast\OuterExtensionBundle\Entity\Traits\OuterExtensible;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\CRMBundle\Entity\Traits\Circlable;
use Librinfo\CRMBundle\Entity\Traits\Positionable;

/**
 * Organism
 */
class Organism implements VCardableInterface, OrganismExtensionInterface
{
    use BaseEntity,
        OuterExtensible,
        Timestampable,
        Addressable,
        Emailable,
        Positionable,
        Circlable,
        Descriptible,
        Searchable,
        Loggable,
        OrganismExtension
    ;
    
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $administrativeNumber;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var bool
     */
    private $isIndividual = false;

    /**
     * @var bool
     */
    private $isCustomer = false;

    /**
     * @var string
     */
    private $customerCode;

    /**
     * @var bool
     */
    private $isSupplier = false;

    /**
     * @var string
     */
    private $supplierCode;

    /**
     * @var string
     */
    private $iban;

    /**
     * @var string
     */
    private $vat;

    /**
     * @var int
     */
    private $vatVerified = 0;

    /**
     * @var string
     */
    private $alert;
    
    /**
     * @var boolean
     */
    private $active;

    /**
     * @var boolean
     */
    private $catalogue_sent;

    /**
     * @var \DateTime
     */
    private $last_catalogue_sent_date;

    /**
     * @var \DateTime
     */
    private $first_catalogue_sent_date;

    /**
     * @ var string
     */
    private $catalogue_send_mean;
    
    /**
     * @var string
     */
    private $source;

    /**
     * @var Collection
     */
    private $phones;

    public function initContact()
    {
        $this->active = true;
        $this->circles = new ArrayCollection();
        $this->positions = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->initOuterExtendedClasses();
    }

    /**
     * Organism constructor.
     */
    public function __construct()
    {
        $this->initcontact();
    }
    
    // implementation of __clone for duplication
    public function __clone()
    {
        $this->id = null;
        $this->initContact();
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Organism
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Organism
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set administrativeNumber
     *
     * @param string $administrativeNumber
     *
     * @return Organism
     */
    public function setAdministrativeNumber($administrativeNumber)
    {
        $this->administrativeNumber = $administrativeNumber;

        return $this;
    }

    /**
     * Get administrativeNumber
     *
     * @return string
     */
    public function getAdministrativeNumber()
    {
        return $this->administrativeNumber;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Organism
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * Set isIndividual
     *
     * @param boolean $isIndividual
     * @return Organism
     */
    public function setIsIndividual($isIndividual)
    {
        $this->isIndividual = $isIndividual;

        return $this;
    }

    /**
     * Get isIndividual
     *
     * @return boolean 
     */
    public function getIsIndividual()
    {
        return $this->isIndividual;
    }

    /**
     * Set isCustomer
     *
     * @param boolean $isCustomer
     * @return Organism
     */
    public function setIsCustomer($isCustomer)
    {
        $this->isCustomer = $isCustomer;

        return $this;
    }

    /**
     * Get isCustomer
     *
     * @return boolean 
     */
    public function getIsCustomer()
    {
        return $this->isCustomer;
    }

    /**
     * Alias for  getIsIndividual
     *
     * @return bool
     */
    public function isIndividual()
    {
        return $this->isIndividual;
    }

    /**
     * Alias for getIsCustomer
     *
     * @return bool
     */
    public function isCustomer()
    {
        return $this->isCustomer;
    }

    /**
     * Set customerCode
     *
     * @param string $customerCode
     *
     * @return Organism
     */
    public function setCustomerCode($customerCode)
    {
        $this->customerCode = $customerCode;

        return $this;
    }

    /**
     * Get customerCode
     *
     * @return string
     */
    public function getCustomerCode()
    {
        return $this->customerCode;
    }

    /**
     * Set isSupplier
     *
     * @param boolean $isSupplier
     * @return Organism
     */
    public function setIsSupplier($isSupplier)
    {
        $this->isSupplier = $isSupplier;

        return $this;
    }

    /**
     * Get isSupplier
     *
     * @return boolean 
     */
    public function getIsSupplier()
    {
        return $this->isSupplier;
    }

    /**
     * Alias for getIsSupplier
     *
     * @return bool
     */
    public function isSupplier()
    {
        return $this->isSupplier;
    }

    /**
     * Set supplierCode
     *
     * @param string $supplierCode
     *
     * @return Organism
     */
    public function setSupplierCode($supplierCode)
    {
        $this->supplierCode = $supplierCode;

        return $this;
    }

    /**
     * Get supplierCode
     *
     * @return string
     */
    public function getSupplierCode()
    {
        return $this->supplierCode;
    }

    /**
     * Set iban
     *
     * @param string $iban
     *
     * @return Organism
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get iban
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set vat
     *
     * @param string $vat
     *
     * @return Organism
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return string
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set vatVerified
     *
     * @param int $vatVerified
     *
     * @return Organism
     */
    public function setVatVerified($vatVerified)
    {
        $this->vatVerified = $vatVerified;

        return $this;
    }

    /**
     * Get vatVerified
     *
     * @return int
     */
    public function getVatVerified()
    {
        return $this->vatVerified;
    }

    /**
     * Set alert
     *
     * @param string $alert
     *
     * @return Organism
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;

        return $this;
    }

    /**
     * Get alert
     *
     * @return string
     */
    public function getAlert()
    {
        return $this->alert;
    }
    
    /**
     * Set active
     *
     * @param boolean $active
     * @return Organism
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set catalogue_sent
     *
     * @param boolean $catalogueSent
     * @return Organism
     */
    public function setCatalogueSent($catalogueSent)
    {
        $this->catalogue_sent = $catalogueSent;

        return $this;
    }

    /**
     * Get catalogue_sent
     *
     * @return boolean 
     */
    public function getCatalogueSent()
    {
        return $this->catalogue_sent;
    }
    
    /**
     * Set catalogue_send_mean
     *
     * @param boolean $catalogueSendMean
     * @return Organism
     */
    public function setCatalogueSendMean($catalogueSendMean)
    {
        $this->catalogue_send_mean = $catalogueSendMean;

        return $this;
    }

    /**
     * Get catalogue_send_mean
     *
     * @return boolean 
     */
    public function getCatalogueSendMean()
    {
        return $this->catalogue_send_mean;
    }

    /**
     * Set last_catalogue_sent_date
     *
     * @param \DateTime $lastCatalogueSentDate
     * @return Organism
     */
    public function setLastCatalogueSentDate($lastCatalogueSentDate)
    {
        $this->last_catalogue_sent_date = $lastCatalogueSentDate;

        return $this;
    }

    /**
     * Get last_catalogue_sent_date
     *
     * @return \DateTime 
     */
    public function getLastCatalogueSentDate()
    {
        return $this->last_catalogue_sent_date;
    }

    /**
     * Set first_catalogue_sent_date
     *
     * @param \DateTime $firstCatalogueSentDate
     * @return Organism
     */
    public function setFirstCatalogueSentDate($firstCatalogueSentDate)
    {
        $this->first_catalogue_sent_date = $firstCatalogueSentDate;

        return $this;
    }

    /**
     * Get first_catalogue_sent_date
     *
     * @return \DateTime 
     */
    public function getFirstCatalogueSentDate()
    {
        return $this->first_catalogue_sent_date;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Organism
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }


    /**
     * @param OrganismPhone $phone
     * @return Organism
     */
    public function addPhone(OrganismPhone $phone)
    {
        $phone->setOrganism($this);
        $this->phones->add($phone);
        return $this;
    }

    /**
     * @param OrganismPhone $phone
     * @return Organism
     */
    public function removePhone(OrganismPhone $phone)
    {
        $this->phones->removeElement($phone);
        return $this;
    }

    public function isPersonal()
    {
        return false;
    }
}
