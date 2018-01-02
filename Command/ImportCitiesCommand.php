<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCitiesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sil:crm:import-cities')
            ->setDescription('Imports cities from @SilCRMBundle/Resources/import/cities.csv')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('blast:import:csv');
        $commandInput = new ArrayInput([
            '--no-interaction' => true,
            '--mapping'        => dirname(__FILE__) . '/../Resources/import/mapping.yml',
            '--dir'            => dirname(__FILE__) . '/../Resources/import/cities',
        ]);

        return $command->run($commandInput, $output);
    }
}
