<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle;

use Sil\Bundle\CRMBundle\DependencyInjection\Compiler\AppCirclesCompilerPass;
use Sil\Bundle\CRMBundle\DependencyInjection\Compiler\NormalizerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SilCRMBundle extends Bundle
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
