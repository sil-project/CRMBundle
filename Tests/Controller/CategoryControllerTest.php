<?php

namespace Librinfo\CRMBundle\Tests\Controller;

use Librinfo\CRMBundle\Entity\Category;
use Librinfo\CRMBundle\Entity\Organism;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
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
        $category = new Category();

        $category->setName($this->datafixtures['category']['name']);

        $this->assertEquals($this->datafixtures['category']['name'], $category->getName());
    }

    /**
     * testsOrganism
     *
     */
    public function testsOrganism()
    {
        $category = new Category();

        $organism = new Organism();
        $organism->setName($this->datafixtures['organism']['name']);

        $category->addOrganism($organism);
        $this->assertContains($organism, $category->getOrganisms());

        $category->removeOrganism($organism);
        $this->assertNotContains($organism, $category->getOrganisms());
    }

}
