<?php

/*
 * This file is part of the Sil Project.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Register the entity code generator services
 * (app circles are defined in each bundle in the Resources/config/circles.yml file).
 */
class AppCirclesCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('sil_crm.app_circles')) {
            return;
        }

        $registry = $container->findDefinition('sil_crm.app_circles');

        $sil_crm = $container->getParameter('sil_crm');
        if (isset($sil_crm['Circle']['app_circles'])) {
            foreach ($sil_crm['Circle']['app_circles'] as $key => $circle) {
                $registry->addMethodCall('addCircle', [$key, $circle]);
            }
        }
    }
}
