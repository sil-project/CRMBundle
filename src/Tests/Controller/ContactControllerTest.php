<?php

namespace Librinfo\CRMBundle\Tests\Controller;

use Librinfo\CRMBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    private $datafixtures;
    private $client;

    public function init(){
        $this->client = static::createClient();

        $this->datafixtures = $this->client->getContainer()->getParameter('librinfo.crmbundle.datafixtures');
    }

    /**
     * testsAdd
     *
     */
    public function testsAdd()
    {
        $this->init();

        $contact = new Contact();
        $contact->setTitle($this->datafixtures['contact']['title']);

        $this->assertEquals($this->datafixtures['contact']['title'], $contact->getTitle());
    }
}
