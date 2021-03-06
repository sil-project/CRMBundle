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

namespace Librinfo\CRMBundle\Form\DataTransformer;

use Librinfo\CRMBundle\CodeGenerator\CustomerCodeGenerator;
use Symfony\Component\Form\DataTransformerInterface;

class CustomerCodeTransformer implements DataTransformerInterface
{
    /**
     * @param string|null $code
     *
     * @return string|null
     */
    public function transform($code)
    {
        return $code;
    }

    /**
     * Automatically add prefix and leading zeros when user submits only digits.
     *
     * @param string|null $code
     *
     * @return string|null
     */
    public function reverseTransform($code)
    {
        if (preg_match('/^[0-9]+$/', $code)) {
            return sprintf('%s%0' . CustomerCodeGenerator::$codeLength . 'd', CustomerCodeGenerator::$codePrefix, (int) $code);
        }

        return trim($code);
    }
}
