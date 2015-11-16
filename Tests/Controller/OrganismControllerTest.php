<?php

namespace Librinfo\CRMBundle\Tests\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Librinfo\CRMBundle\Entity\Category;
use Librinfo\CRMBundle\Entity\Organism;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrganismControllerTest extends WebTestCase
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

        $organism = new Organism();

        $organism->setAdministrativeNumber($this->datafixtures['organism']['administrative_number']);
        $this->assertEquals($this->datafixtures['organism']['administrative_number'], $organism->getAdministrativeNumber());

        $organism->setUrl($this->datafixtures['organism']['url']);
        $this->assertEquals($this->datafixtures['organism']['url'], $organism->getUrl());
    }

    /**
     * testsCategories
     *
     */
    public function testsCategories()
    {
        $this->init();

        $organism = new Organism();

        $categoryCollection = new ArrayCollection();
        $category = new Category();
        $category->setName($this->datafixtures['category']['name']);

        $categoryCollection->add($category);

        $organism->setCategories($categoryCollection);

        $this->assertContains($category, $organism->getCategories());
    }
}
