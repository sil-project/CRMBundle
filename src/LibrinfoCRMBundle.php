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
