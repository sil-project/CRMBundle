<?php

namespace Librinfo\CRMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\DoctrineBundle\Entity\Traits\BaseEntity;
use Librinfo\UserBundle\Entity\Traits\Traceable;
use Librinfo\DoctrineBundle\Entity\Traits\Addressable;
use Librinfo\DoctrineBundle\Entity\Traits\Emailable;
use Librinfo\CRMBundle\Entity\Traits\Positionable;
use Librinfo\CRMBundle\Entity\Traits\Circlable;
use Librinfo\DoctrineBundle\Entity\Traits\Descriptible;
use Librinfo\DoctrineBundle\Entity\Traits\Searchable;
use Librinfo\DoctrineBundle\Entity\Traits\Loggable;

/**
 * Organism
 */
class Organism implements VCardableInterface
{
    use BaseEntity,
        Traceable,
        Addressable,
        Emailable,
        Positionable,
        Circlable,
        Descriptible,
        Searchable,
        Loggable
    ;

    // CustomerCode constants (TODO: put this in application settings)
    const CC_PREFIX = 'CL';
    const CC_LENGTH = 6;
    // SupplierCode constants (TODO: put this in application settings)
    const SC_PREFIX = 'FO';
    const SC_LENGTH = 6;

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
    private $individual = false;

    /**
     * @var bool
     */
    private $customer = false;

    /**
     * @var string
     */
    private $customerCode;

    /**
     * @var bool
     */
    private $supplier = false;

    /**
     * @var string
     */
    private $supplierCode;

    /**
     * @var Collection
     */
    private $phones;

    /**
     * Organism constructor.
     */
    public function __construct()
    {
        $this->circles = new ArrayCollection();
        $this->positions = new ArrayCollection();
        $this->phones = new ArrayCollection();
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
     * Set individual
     *
     * @param bool $individual
     *
     * @return Organism
     */
    public function setIndividual($individual)
    {
        $this->customer = $individual;

        return $this;
    }

    /**
     * Get individual
     *
     * @return bool
     */
    public function isIndividual()
    {
        return $this->individual;
    }


    /**
     * Set customer
     *
     * @param bool $customer
     *
     * @return Organism
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return bool
     */
    public function isCustomer()
    {
        return $this->customer;
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
     * Set supplier
     *
     * @param bool $supplier
     *
     * @return Organism
     */
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return bool
     */
    public function isSupplier()
    {
        return $this->supplier;
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
