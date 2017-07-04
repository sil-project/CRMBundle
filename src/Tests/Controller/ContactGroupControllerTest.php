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

namespace Librinfo\CRMBundle\Tests\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Librinfo\CRMBundle\Entity\Contact;
use Librinfo\CRMBundle\Entity\ContactGroup;
use Librinfo\CRMBundle\Entity\Organism;
use Librinfo\CRMBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactGroupControllerTest extends WebTestCase
{
    private $datafixtures;

    public function init()
    {
        $this->client = static::createClient();

        $this->datafixtures = $this->client->getContainer()->getParameter('librinfo.crmbundle.datafixtures');
    }

    /**
     * testsAdd.
     */
    public function testsAdd()
    {
        $this->init();

        $contactGroup = new ContactGroup();

        $contact = new Contact();
        $contact->setTitle($this->datafixtures['contact']['title']);

        $organism = new Organism();
        $organism->setName($this->datafixtures['organism']['name']);

        $role = new Role();
        $role->setName($this->datafixtures['role']['name']);

        $contactGroup->setContact($contact);
        $this->assertEquals($contact, $contactGroup->getContact());

        $contactGroup->setOrganism($organism);
        $this->assertEquals($organism, $contactGroup->getOrganism());

        $contactGroup->addRole($role);
        $this->assertContains($role, $contactGroup->getRoles());
        $contactGroup->removeRole($role);
        $this->assertNotContains($role, $contactGroup->getRoles());
    }

    /**
     * testsRoles.
     */
    public function testsRoles()
    {
        $this->init();

        $contactGroup = new ContactGroup();

        $roleCollection = new ArrayCollection();
        $role = new Role();
        $role->setName($this->datafixtures['role']['name']);

        $roleCollection->add($role);

        $contactGroup->setRoles($roleCollection);
        $this->assertContains($role, $contactGroup->getRoles());
    }
}
