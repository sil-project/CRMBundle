<?php

namespace Librinfo\CRMBundle\DependencyInjection;

use Librinfo\SecurityBundle\Configurator\SecurityConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Librinfo\CoreBundle\DependencyInjection\LibrinfoCoreExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LibrinfoCRMExtension extends LibrinfoCoreExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('admin.yml');

        if($container->getParameter('kernel.environment') == 'test')
        {
            if(!$container->hasParameter('librinfo.datafixtures')){
                $container->setParameter('librinfo.datafixtures', array());
            }
            $this->mergeParameter('librinfo.datafixtures', $container, __DIR__.'/../Resources/config/','datafixtures.yml');
        }
        
        $this->mergeParameter('librinfo', $container, __DIR__.'/../Resources/config');

        SecurityConfigurator::getInstance($container)->loadSecurityYml(__DIR__ . '/../Resources/config/security.yml');
    }
}
