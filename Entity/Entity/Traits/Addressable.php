<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Entity\Traits;

use Librinfo\CRMBundle\Entity\Address;
use Doctrine\Common\Collections\Collection;

/**
 * @author Marcos Bezerra de Menezes <marcos.bezerra@libre-informatique.fr>
 */
trait Addressable
{
    /**
     * @var Address
     */
    protected $defaultAddress;

    /**
     * @var Collection|Address[]
     */
    protected $addresses;

    /**
     * @return Address
     */
    public function getDefaultAddress()
    {
        return $this->defaultAddress;
    }

    /**
     * @param Address $defaultAddress
     *
     * @return self
     */
    public function setDefaultAddress(Address $defaultAddress = null)
    {
        $this->defaultAddress = $defaultAddress;

        if (null !== $defaultAddress) {
            $this->addAddress($defaultAddress);
        }

        return $this;
    }

    /**
     * @param Address $address
     *
     * @return self
     */
    public function addAddress(Address $address)
    {
        if (!$this->hasAddress($address)) {
            $this->addresses->add($address);
            $address->setOrganism($this);

            if (!$this->getDefaultAddress()) {
                $this->setDefaultAddress($address);
            }
        }

        return $this;
    }

    /**
     * @param Address $address
     *
     * @return self
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);

        if ($address->getId() == $this->defaultAddress->getId()) {
            if ($this->addresses->count() > 0) {
                $this->defaultAddress = $this->addresses[0];
            } else {
                $this->defaultAddress = null;
            }
        }

        return $this;
    }

    /**
     * @param Address $address
     *
     * @return bool
     */
    public function hasAddress(Address $address)
    {
        return $this->addresses->contains($address);
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
