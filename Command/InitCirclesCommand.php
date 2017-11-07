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

namespace Sil\Bundle\CRMBundle\Command;

use Sil\Bundle\CRMBundle\Entity\Circle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Creates the application circles in database.
 */
class InitCirclesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('librinfo:crm:init-circles')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates the application circles in database.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Creates the application circles in database.'
                . "\nApplication circles are defined in librinfo_crm.Circle.app_circles configuration parameter."
                . "\nCircles that already exist in database are updated.")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $librinfo_crm = $this->getContainer()->getParameter('librinfo_crm');

        if (!isset($librinfo_crm['Circle']['app_circles'])) {
            $output->writeln('No application circle defined. Nothing to do.');
            exit(0);
        }

        $app_circles = $librinfo_crm['Circle']['app_circles'];
        foreach ($app_circles as $app_circle) {
            $exists = false;
            $circle = $em->getRepository('SilCRMBundle:Circle')->findOneById($app_circle['id']);
            if (!$circle) {
                $output->write(sprintf('Creating circle "%s" (id: %s)', $app_circle['name'], $app_circle['id']));
                $circle = $this->createCircle($em, $app_circle['id']);
            } else {
                $exists = true;
                $output->write(sprintf('Updating circle "%s" (id: %s)', $app_circle['name'], $app_circle['id']));
            }

            $circle->setName($app_circle['name']);
            $circle->setCode($app_circle['code']);
            $circle->setDescription($app_circle['description']);
            $circle->setColor($app_circle['color']);
            $circle->setTranslatable($app_circle['translatable']);
            $circle->setEditable(false);

            $em->persist($circle);
            $output->writeln('<info> done.</info>');
        }

        $em->flush();
    }

    protected function createCircle(\Doctrine\ORM\EntityManager $em, $id)
    {
        $entity = new Circle();
        $className = Circle::class;
        $idRef = new \ReflectionProperty($className, 'id');
        $idRef->setAccessible(true);
        $idRef->setValue($entity, $id);

        $metadata = $em->getClassMetadata($className);
        /** @var \Doctrine\ORM\Mapping\ClassMetadataInfo $metadata */
        $generator = $metadata->idGenerator;
        $generatorType = $metadata->generatorType;

        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $unitOfWork = $em->getUnitOfWork();
        $persistersRef = new \ReflectionProperty($unitOfWork, 'persisters');
        $persistersRef->setAccessible(true);
        $persisters = $persistersRef->getValue($unitOfWork);
        unset($persisters[$className]);
        $persistersRef->setValue($unitOfWork, $persisters);

        $em->persist($entity);
        $em->flush();

        $idRef->setAccessible(false);
        $metadata->setIdGenerator($generator);
        $metadata->setIdGeneratorType($generatorType);

        $persisters = $persistersRef->getValue($unitOfWork);
        unset($persisters[$className]);
        $persistersRef->setValue($unitOfWork, $persisters);
        $persistersRef->setAccessible(false);

        return $entity;
    }
}
