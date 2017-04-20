<?php

namespace Librinfo\CRMBundle\Entity\OuterExtension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Librinfo\CRMBundle\Entity\Address;

/**
 * HasAddresses trait
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
     * This function is called by the owning side of the N-N relationship
     * @param Address $address
     * @return self
     */
    public function addAddress(Address $address)
    {
        $this->addresses->add($address);
        
        return $this;
    }

    /**
     * @param Address $address
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
