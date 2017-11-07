<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity\OuterExtension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sil\Bundle\CRMBundle\Entity\Address;

/**
 * HasAddresses trait.
 */
trait HasAddresses
{
    /**
     * @var Collection
     */
    private $addresses;

    public function initAddresses()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
     * This function is called by the owning side of the N-N relationship.
     *
     * @param Address $address
     *
     * @return self
     */
    public function addAddress(Address $address)
    {
        $this->addresses->add($address);

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

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
