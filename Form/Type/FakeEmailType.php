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

namespace Sil\Bundle\CRMBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Blast\Bundle\UtilsBundle\Form\Type\UniqueFieldType;

class FakeEmailType extends AbstractType
{
    public function getParent()
    {
        return UniqueFieldType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sil_fake_email';
    }
}
