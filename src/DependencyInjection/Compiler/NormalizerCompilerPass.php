<?php

namespace Librinfo\CRMBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NormalizerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $service = $container->getDefinition('blast_base_entities.listener.normalize');
        $config = $container->getParameter('librinfo_crm');
        foreach ($config as $class => $settings) {
            $class = "Librinfo\\CRMBundle\\Entity\\" . $class;
            if ( class_exists($class, false) && !empty($settings['normalize']) ) {
                $arg = [$class => $settings['normalize']];
                $service->addMethodCall('addActions', [$arg]);
            }
        }

    }
}