<?php

namespace Librinfo\CRMBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Register the entity code generator services
 * (app circles are defined in each bundle in the Resources/config/circles.yml file)
 */
class AppCirclesCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('librinfo_crm.app_circles'))
            return;

        $registry = $container->findDefinition('librinfo_crm.app_circles');

        $librinfo_crm = $container->getParameter('librinfo_crm');
        if (isset($librinfo_crm['Circle']['app_circles']))
            foreach ($librinfo_crm['Circle']['app_circles'] as $key => $circle)
                $registry->addMethodCall('addCircle',  [$key, $circle]);
    }
}