<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Tests\Controller;

use Sil\Bundle\CRMBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    private $datafixtures;
    private $client;

    public function init()
    {
        $this->client = static::createClient();

        $this->datafixtures = $this->client->getContainer()->getParameter('sil.crmbundle.datafixtures');
    }

    /**
     * testsAdd.
     */
    public function testsAdd()
    {
        $this->init();

        $contact = new Contact();
        $contact->setTitle($this->datafixtures['contact']['title']);

        $this->assertEquals($this->datafixtures['contact']['title'], $contact->getTitle());
    }
}
