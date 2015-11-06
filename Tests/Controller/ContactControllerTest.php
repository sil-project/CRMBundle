<?php

namespace Librinfo\CRMBundle\Tests\Controller;

use Librinfo\CRMBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    private $datafixtures;

    public function __construct(){
        parent::__construct();
        $client = static::createClient();

        $this->datafixtures = $client->getContainer()->getParameter('librinfo.crmbundle.datafixtures');
    }

    /**
     * testsAdd
     *
     */
    public function testsAdd()
    {
        $contact = new Contact();
        $contact->setTitle($this->datafixtures['contact']['title']);

        $this->assertEquals($this->datafixtures['contact']['title'], $contact->getTitle());
    }
}
