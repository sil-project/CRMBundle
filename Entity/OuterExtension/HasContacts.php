<?php

/*
 * This file is part of the Sil Project.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Entity\OuterExtension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * HasContacts trait.
 */
trait HasContacts
{
    /**
     * @var Collection
     */
    private $contacts;

    public function initContacts()
    {
        $this->contacts = new ArrayCollection();
    }

    /**
     * This function is called by the owning side of the N-N relationship.
     *
     * @param Contact $contact
     *
     * @return self
     */
    public function addContact($contact)
    {
        $this->contacts->add($contact);

        return $this;
    }

    /**
     * @param Contact $contact
     *
     * @return self
     */
    public function removeContact($contact)
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
