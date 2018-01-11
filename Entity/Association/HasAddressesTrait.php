<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity\Association;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sil\Bundle\CRMBundle\Entity\AddressInterface;

/**
 * HasAddresses trait.
 */
trait HasAddressesTrait
{
    /**
     * @var Collection
     */
    protected $addresses;

    /**
     * @var AddressInterface
     */
    protected $defaultAddress;

    public function initAddresses()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
     * @return AddressInterface
     */
    public function getDefaultAddress()
    {
        return $this->defaultAddress;
    }

    /**
     * @param AddressInterface $defaultAddress
     *
     * @return self
     */
    public function setDefaultAddress(AddressInterface $defaultAddress = null)
    {
        $this->defaultAddress = $defaultAddress;

        if ($defaultAddress !== null && !$this->addresses->contains($defaultAddress)) {
            $this->addresses->add($defaultAddress);
        }

        return $this;
    }

    /**
     * @param AddressInterface $address
     *
     * @return self
     */
    public function addAddress(AddressInterface $address)
    {
        if ($this->addresses === null) {
            $this->initAddresses();
        }

        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);

            if (!$this->getDefaultAddress()) {
                $this->setDefaultAddress($address);
            }
        }

        return $this;
    }

    /**
     * @param AddressInterface $address
     */
    public function removeAddress(AddressInterface $address)
    {
        if ($this->addresses === null) {
            $this->initAddresses();
        }

        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);

            if ($address->getId() == $this->defaultAddress->getId()) {
                if ($this->addresses->count() > 0) {
                    $this->defaultAddress = $this->addresses[0];
                } else {
                    $this->defaultAddress = null;
                }
            }
        }
    }

    /**
     * @return Collection
     */
    public function getAddresses()
    {
        if ($this->addresses === null) {
            $this->initAddresses();
        }

        return $this->addresses;
    }
}
