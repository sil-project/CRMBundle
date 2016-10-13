<?php

namespace Librinfo\CRMBundle;

use Librinfo\CRMBundle\DependencyInjection\Compiler\AppCirclesCompilerPass;
use Librinfo\CRMBundle\DependencyInjection\Compiler\NormalizerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LibrinfoCRMBundle extends Bundle
{
   /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new NormalizerCompilerPass());
        $container->addCompilerPass(new AppCirclesCompilerPass());
    }
}
