<?php

namespace Librinfo\CRMBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Librinfo\CRMBundle\DependencyInjection\Compiler\NormalizerCompilerPass;

class LibrinfoCRMBundle extends Bundle
{
   /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new NormalizerCompilerPass());
    }
}
