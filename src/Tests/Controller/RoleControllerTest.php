<?php

namespace Librinfo\CRMBundle\Tests\Controller;

use Librinfo\CRMBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoleControllerTest extends WebTestCase
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
        $role = new Role();
        $role->setName($this->datafixtures['role']['name']);

        $this->assertEquals($this->datafixtures['role']['name'], $role->getName());
    }
}
