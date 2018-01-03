<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity;

use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Nameable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Descriptible;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Emailable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Loggable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Searchable;
use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Blast\Component\Resource\Model\ResourceInterface;

abstract class OrganismAbstract implements OrganismInterface, VCardableInterface, ResourceInterface
{
    use BaseEntity,
        Nameable,
        Timestampable,
        Emailable,
        Descriptible,
        Searchable,
        Loggable;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $shortname;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $flashOnControl;

    /**
     * @var bool
     */
    protected $familyContact;

    /**
     * @var string
     */
    protected $culture;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $administrativeNumber;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var bool
     */
    protected $isIndividual = false;

    /**
     * @var bool
     */
    protected $isCustomer = false;

    /**
     * @var string
     */
    protected $customerCode;

    /**
     * @var bool
     */
    protected $isSupplier = false;

    /**
     * @var string
     */
    protected $supplierCode;

    /**
     * @var string
     */
    protected $iban;

    /**
     * @var string
     */
    protected $vat;

    /**
     * @var int
     */
    protected $vatVerified = 0;

    /**
     * @var string
     */
    protected $alert;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var bool
     */
    protected $catalogue_sent;

    /**
     * @var \DateTime
     */
    protected $last_catalogue_sent_date;

    /**
     * @var \DateTime
     */
    protected $first_catalogue_sent_date;

    /**
     * @ var string
     */
    protected $catalogue_send_mean;

    /**
     * @var string
     */
    protected $catalogue_type;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var Phone
     */
    protected $defaultPhone;

    /**
     * @var Collection|Phone[]
     */
    protected $phones;

    /**
     * @var Collection
     */
    protected $individuals;

    /**
     * @var Collection
     */
    protected $organizations;

    public function initOrganism()
    {
        $this->active = true;
        $this->circles = new ArrayCollection();
        $this->positions = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->individuals = new ArrayCollection();
        $this->organizations = new ArrayCollection();
    }

    /**
     * Organism constructor.
     */
    public function __construct()
    {
        $this->initOrganism();
    }

    // implementation of __clone for duplication
    public function __clone()
    {
        $this->id = null;
        $this->initOrganism();
    }

    public function __toString()
    {
        if ($this->isIndividual()) {
            return sprintf(
                '%s %s',
                $this->getFirstname(),
                $this->getLastname()
            );
        } else {
            return (string) $this->getName();
        }
    }

    /**
     * bEvErly CRuSHeR = Beverly Crusher
     * JEAN-LUC PICARD => Jean-Luc Picard
     * MILES O'BRIEN => Miles O'Brian.
     *
     * @param string $string
     *
     * @return string
     */
    protected function ucname($string)
    {
        $string = ucwords(mb_strtolower($string));

        foreach (array('-', '\'', '_') as $delimiter) {
            if (strpos($string, $delimiter) !== false) {
                $string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
            }
        }

        return $string;
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return Contact
     *
     * @todo ucname should go in an event listener, so we can configure the behaviour
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $this->ucname($firstname);
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return Contact
     *
     * @todo mb_strtoupper should go in an event listener, so we can configure the behaviour
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = mb_strtoupper($lastname);
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set shortname.
     *
     * @param string $shortname
     *
     * @return Contact
     */
    public function setShortname(?string $shortname): void
    {
        $this->shortname = $shortname;
    }

    /**
     * Get shortname.
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set title.
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
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set flashOnControl.
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
     * Get flashOnControl.
     *
     * @return string
     */
    public function getFlashOnControl()
    {
        return $this->flashOnControl;
    }

    /**
     * Set familyContact.
     *
     * @param bool $familyContact
     *
     * @return Contact
     */
    public function setFamilyContact($familyContact)
    {
        $this->familyContact = $familyContact;

        return $this;
    }

    /**
     * Get familyContact.
     *
     * @return bool
     */
    public function getFamilyContact()
    {
        return $this->familyContact;
    }

    /**
     * Set culture.
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
     * Get culture.
     *
     * @return string
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set url.
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
     * Get url.
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
     *
     * @todo mb_strtoupper should go in an event listener, so we can configure the behaviour
     */
    public function setName($name)
    {
        $this->name = mb_strtoupper($name);

        return $this;
    }

    /**
     * Set administrativeNumber.
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
     * Get administrativeNumber.
     *
     * @return string
     */
    public function getAdministrativeNumber()
    {
        return $this->administrativeNumber;
    }

    /**
     * Set category.
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
     * Get category.
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set isIndividual.
     *
     * @param bool $isIndividual
     *
     * @return Organism
     */
    public function setIsIndividual($isIndividual)
    {
        $this->isIndividual = $isIndividual;

        return $this;
    }

    /**
     * Get isIndividual.
     *
     * @return bool
     */
    public function getIsIndividual()
    {
        return $this->isIndividual;
    }

    /**
     * Set isCustomer.
     *
     * @param bool $isCustomer
     *
     * @return Organism
     */
    public function setIsCustomer($isCustomer)
    {
        $this->isCustomer = $isCustomer;

        return $this;
    }

    /**
     * Get isCustomer.
     *
     * @return bool
     */
    public function getIsCustomer()
    {
        return $this->isCustomer;
    }

    /**
     * Alias for  getIsIndividual.
     *
     * @return bool
     */
    public function isIndividual()
    {
        return $this->isIndividual;
    }

    /**
     * Alias for getIsCustomer.
     *
     * @return bool
     */
    public function isCustomer()
    {
        return $this->isCustomer;
    }

    /**
     * Set customerCode.
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
     * Get customerCode.
     *
     * @return string
     */
    public function getCustomerCode()
    {
        return $this->customerCode;
    }

    /**
     * Set isSupplier.
     *
     * @param bool $isSupplier
     *
     * @return Organism
     */
    public function setIsSupplier($isSupplier)
    {
        $this->isSupplier = $isSupplier;

        return $this;
    }

    /**
     * Get isSupplier.
     *
     * @return bool
     */
    public function getIsSupplier()
    {
        return $this->isSupplier;
    }

    /**
     * Alias for getIsSupplier.
     *
     * @return bool
     */
    public function isSupplier()
    {
        return $this->isSupplier;
    }

    /**
     * Set supplierCode.
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
     * Get supplierCode.
     *
     * @return string
     */
    public function getSupplierCode()
    {
        return $this->supplierCode;
    }

    /**
     * Set iban.
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
     * Get iban.
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set vat.
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
     * Get vat.
     *
     * @return string
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set vatVerified.
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
     * Get vatVerified.
     *
     * @return int
     */
    public function getVatVerified()
    {
        return $this->vatVerified;
    }

    /**
     * Set alert.
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
     * Get alert.
     *
     * @return string
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Organism
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set catalogue_sent.
     *
     * @param bool $catalogueSent
     *
     * @return Organism
     */
    public function setCatalogueSent($catalogueSent)
    {
        $this->catalogue_sent = $catalogueSent;

        return $this;
    }

    /**
     * Get catalogue_sent.
     *
     * @return bool
     */
    public function getCatalogueSent()
    {
        return $this->catalogue_sent;
    }

    /**
     * Set catalogue_send_mean.
     *
     * @param bool $catalogueSendMean
     *
     * @return Organism
     */
    public function setCatalogueSendMean($catalogueSendMean)
    {
        $this->catalogue_send_mean = $catalogueSendMean;

        return $this;
    }

    /**
     * Get catalogue_send_mean.
     *
     * @return bool
     */
    public function getCatalogueSendMean()
    {
        return $this->catalogue_send_mean;
    }

    /**
     * Set last_catalogue_sent_date.
     *
     * @param \DateTime $lastCatalogueSentDate
     *
     * @return Organism
     */
    public function setLastCatalogueSentDate($lastCatalogueSentDate)
    {
        $this->last_catalogue_sent_date = $lastCatalogueSentDate;

        return $this;
    }

    /**
     * Get last_catalogue_sent_date.
     *
     * @return \DateTime
     */
    public function getLastCatalogueSentDate()
    {
        return $this->last_catalogue_sent_date;
    }

    /**
     * Set first_catalogue_sent_date.
     *
     * @param \DateTime $firstCatalogueSentDate
     *
     * @return Organism
     */
    public function setFirstCatalogueSentDate($firstCatalogueSentDate)
    {
        $this->first_catalogue_sent_date = $firstCatalogueSentDate;

        return $this;
    }

    /**
     * Get first_catalogue_sent_date.
     *
     * @return \DateTime
     */
    public function getFirstCatalogueSentDate()
    {
        return $this->first_catalogue_sent_date;
    }

    /**
     * Set source.
     *
     * @param string $source
     *
     * @return Organism
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source.
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultPhone()
    {
        return $this->defaultPhone;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultPhone(OrganismPhone $defaultPhone = null)
    {
        $this->defaultPhone = $defaultPhone;
        if (null !== $defaultPhone) {
            $this->addPhone($defaultPhone);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addPhone(OrganismPhone $phone)
    {
        if (!$this->hasPhone($phone)) {
            $this->phones->add($phone);
            $phone->setOrganism($this);

            if (!$this->getDefaultPhone()) {
                $this->setDefaultPhone($phone);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removePhone(Phone $phone)
    {
        $this->phones->removeElement($phone);

        if ($phone->getId() == $this->defaultPhone->getId()) {
            if ($this->phones->count() > 0) {
                $this->defaultPhone = $this->phones[0];
            } else {
                $this->defaultPhone = null;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasPhone(Phone $phone)
    {
        return $this->phones->contains($phone);
    }

    /**
     * {@inheritdoc}
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add individual.
     *
     * @param Position $individual
     *
     * @return Organism
     */
    public function addIndividual(Position $individual)
    {
        $this->individuals[] = $individual;

        return $this;
    }

    /**
     * Remove individual.
     *
     * @param Position $individual
     */
    public function removeIndividual(Position $individual)
    {
        $this->individuals->removeElement($individual);
    }

    /**
     * Get individuals.
     *
     * @return Collection
     */
    public function getIndividuals()
    {
        return $this->individuals;
    }

    /**
     * Add organization.
     *
     * @param Position $organization
     *
     * @return Organism
     */
    public function addOrganization(Position $organization)
    {
        $this->organizations[] = $organization;

        return $this;
    }

    /**
     * Remove organization.
     *
     * @param Position $organization
     */
    public function removeOrganization(Position $organization)
    {
        $this->organizations->removeElement($organization);
    }

    /**
     * Get organizations.
     *
     * @return Collection
     */
    public function getOrganizations()
    {
        return $this->organizations;
    }

    public function isPersonal()
    {
        return false;
    }

    /**
     * ex. "Mr John DOE".
     *
     * @return string
     */
    public function getFulltextName()
    {
        if (!$this->isIndividual()) {
            return $this->getName();
        }

        return sprintf('%s %s', $this->getFirstname(), $this->getLastName());
    }

    /**
     * @return string
     */
    public function getCatalogueType()
    {
        return $this->catalogue_type;
    }

    /**
     * @param string catalogue_type
     *
     * @return self
     */
    public function setCatalogueType($catalogue_type)
    {
        $this->catalogue_type = $catalogue_type;

        return $this;
    }
}
