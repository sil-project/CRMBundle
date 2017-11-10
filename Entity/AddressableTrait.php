<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Marcos Bezerra de Menezes <marcos.bezerra@libre-informatique.fr>
 */
trait AddressableTrait
{
    /**
     * @var Address
     */
    protected $defaultAddress;

    /**
     * @var Collection|AddressInterface[]
     */
    protected $addresses;

    /**
     * @return AddressInterface
     */
    public function getDefaultAddress()
    {
        return $this->defaultAddress;
    }

    // /**
    //  * @param AddressInterface $defaultAddress
    //  *
    //  * @return self
    //  */
    // public function setDefaultAddress(AddressInterface $defaultAddress = null)
    // {
    //     $this->defaultAddress = $defaultAddress;
    //
    //     if (null !== $defaultAddress) {
    //         $this->addAddress($defaultAddress);
    //     }
    //
    //     return $this;
    // }

    /**
     * @param Address $address
     *
     * @return self
     */
    public function addAddress(AddressInterface $address)
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
     * @param AddressInterface $address
     */
    public function removeAddress(AddressInterface $address)
    {
        $this->addresses->removeElement($address);

        if ($address->getId() == $this->defaultAddress->getId()) {
            if ($this->addresses->count() > 0) {
                $this->defaultAddress = $this->addresses[0];
            } else {
                $this->defaultAddress = null;
            }
        }
    }

    /**
     * @param AddressInterface $address
     *
     * @return bool
     */
    public function hasAddress(AddressInterface $address)
    {
        return $this->addresses->contains($address);
    }

    /**
     * @return Collection|AddressInterface[]
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
