<?php

namespace Librinfo\CRMBundle\DependencyInjection;

use Librinfo\CoreBundle\DependencyInjection\DefaultParameters;
use Librinfo\CoreBundle\DependencyInjection\LibrinfoCoreExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LibrinfoCRMExtension extends LibrinfoCoreExtension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        // Define Application Circles by parsing circles.yml files in installed Bundles

        $circles = [];
        $bundles = $container->getParameter('kernel.bundles');
        foreach ($bundles as $bundleClassName) {
            $rc = new \ReflectionClass($bundleClassName);
            $bundleDir = dirname($rc->getFileName());
            $circlesYml = $bundleDir . '/Resources/config/circles.yml';
            if (file_exists($circlesYml))
                $circles = array_merge($circles, Yaml::parse($circlesYml));
        }
        if ($circles) {
            $container->prependExtensionConfig('librinfo_crm', ['Circle' => ['app_circles' => $circles]]);
            $container->prependExtensionConfig('twig', ['globals' => ['librinfo_app_circles' => $circles]]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('admin.yml');

        $container->setParameter('librinfo_crm', $config);

        // Entity code generators
        $container->setParameter('librinfo_crm.code_generator.supplier',
            $container->getParameter('librinfo_crm')['code_generator']['supplier']
        );
        $container->setParameter('librinfo_crm.code_generator.customer',
            $container->getParameter('librinfo_crm')['code_generator']['customer']
        );

        if ($container->getParameter('kernel.environment') == 'test')
        {
            $loader->load('datafixtures.yml');
        }

        $this->mergeParameter('librinfo', $container, __DIR__ . '/../Resources/config');

        if (class_exists('\Librinfo\SecurityBundle\Configurator\SecurityConfigurator'))
            \Librinfo\SecurityBundle\Configurator\SecurityConfigurator::getInstance($container)->loadSecurityYml(__DIR__ . '/../Resources/config/security.yml');

        $configSonataAdmin = Yaml::parse(
            file_get_contents(__DIR__ . '/../Resources/config/bundles/sonata_admin.yml')
        );
        DefaultParameters::getInstance($container)->defineDefaultConfiguration($configSonataAdmin['default']);
    }
}
