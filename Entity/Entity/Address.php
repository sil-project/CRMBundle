<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Entity;

use AppBundle\Entity\OuterExtension\LibrinfoCRMBundle\AddressExtension;
use Blast\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\BaseEntitiesBundle\Entity\Traits\Searchable;
use Blast\BaseEntitiesBundle\Entity\Traits\Timestampable;
use Blast\OuterExtensionBundle\Entity\Traits\OuterExtensible;

/**
 * Address.
 * https://github.com/Sylius/Sylius/issues/8345 & https://ocramius.github.io/blog/fluent-interfaces-are-evil/.
 */
class Address implements AddressInterface, VCardableInterface
{
    use BaseEntity,
        OuterExtensible,
        Timestampable,
        Searchable,
        AddressExtension
    ;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    private $postCode;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $countryCode = 'FR';

    /**
     * @var string
     */
    private $provinceCode;

    /**
     * @var string
     */
    private $provinceName;

    /**
     * @var bool
     */
    private $npai = false;

    /**
     * @var string
     */
    private $vcardUid;

    /**
     * @var bool
     */
    private $confirmed = true;

    /**
     * @var \Librinfo\CRMBundle\Entity\Organism
     */
    private $organism;

    /**
     * Organism constructor.
     */
    public function __construct()
    {
        $this->initAddress();
    }

    public function initAddress()
    {
        $this->initOuterExtendedClasses();
    }

    public function __toString()
    {
        return sprintf(
            '%s %s, %s %s',
            $this->getFirstName(),
            $this->getLastName(),
            $this->getStreet(),
            $this->getCountryCode()
        );
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Set postCode.
     *
     * @param string $postCode
     */
    public function setPostCode(?string $postCode): void
    {
        $this->postCode = $postCode;
    }

    /**
     * Get postCode.
     *
     * @return string
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * Set street.
     *
     * @param string $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * Get street.
     *
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Set city.
     *
     * @param string $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Set countryCode.
     *
     * @param string $countryCode
     */
    public function setCountryCode(?string $countryCode = null): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Get countryCode.
     *
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * Set provinceCode.
     *
     * @param string $provinceCode
     */
    public function setProvinceCode(?string $provinceCode = null): void
    {
        $this->provinceCode = $provinceCode;
    }

    /**
     * Get provinceCode.
     *
     * @return string
     */
    public function getProvinceCode(): ?string
    {
        return $this->provinceCode;
    }

    /**
     * Set provinceName.
     *
     * @param string $provinceName
     */
    public function setProvinceName(?string $provinceName = null): void
    {
        $this->provinceName = $provinceName;
    }

    /**
     * Get provinceName.
     *
     * @return string
     */
    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    /**
     * Set npai.
     *
     * @param bool $npai
     */
    public function setNpai($npai)
    {
        $this->npai = $npai;
    }

    /**
     * Is npai.
     *
     * @return bool
     */
    public function isNpai()
    {
        return $this->npai;
    }

    /**
     * Get npai.
     *
     * @return bool
     */
    public function getNpai()
    {
        /* for retrocomp only */
        return $this->isNpai();
    }

    /**
     * Set vcardUid.
     *
     * @param string $vcardUid
     */
    public function setVcardUid($vcardUid)
    {
        $this->vcardUid = $vcardUid;
    }

    /**
     * Get vcardUid.
     *
     * @return string
     */
    public function getVcardUid()
    {
        return $this->vcardUid;
    }

    /**
     * Set confirmed.
     *
     * @param bool $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * Is confirmed.
     *
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Get confirmed.
     *
     * @return bool
     */
    public function getConfirmed()
    {
        /* for retrocomp only */
        return $this->isConfirmed();
    }

    /**
     * Set organism.
     *
     * @param \Librinfo\CRMBundle\Entity\Organism $organism
     */
    public function setOrganism(\Librinfo\CRMBundle\Entity\Organism $organism = null): void
    {
        $this->organism = $organism;
    }

    /**
     * Get organism.
     *
     * @return \Librinfo\CRMBundle\Entity\Organism
     */
    public function getOrganism(): ?\Librinfo\CRMBundle\Entity\Organism
    {
        return $this->organism;
    }

    public function isPersonal()
    {
        return true;
    }
}
