<?php
namespace Librinfo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Librinfo\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCRMData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * load
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fixturesData = $this->container->getParameter('librinfo.crmbundle.datafixtures');

        $userAdmin = new User();
        $userAdmin->setUsername($fixturesData['user']['username']);
        $userAdmin->setPassword($fixturesData['user']['password']);
        $userAdmin->setEmail($fixturesData['user']['email']);
        $userAdmin->addRole($fixturesData['user']['role']);

        $manager->persist($userAdmin);
        $manager->flush();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}