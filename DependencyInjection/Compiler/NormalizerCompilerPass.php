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

namespace Sil\Bundle\CRMBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NormalizerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $service = $container->getDefinition('blast_base_entities.listener.normalize');
        $config = $container->getParameter('librinfo_crm');
        foreach ($config as $class => $settings) {
            $class = 'Librinfo\\CRMBundle\\Entity\\' . $class;
            if (class_exists($class, false) && !empty($settings['normalize'])) {
                $arg = [$class => $settings['normalize']];
                $service->addMethodCall('addActions', [$arg]);
            }
        }
    }
}
