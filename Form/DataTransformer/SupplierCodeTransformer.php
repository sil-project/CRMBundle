<?php

namespace Librinfo\CRMBundle\Form\DataTransformer;

use Librinfo\CRMBundle\CodeGenerator\SupplierCodeGenerator;
use Symfony\Component\Form\DataTransformerInterface;

class SupplierCodeTransformer implements DataTransformerInterface
{
    /**
     * @param  string|null $code
     * @return string|null
     */
    public function transform($code)
    {
        return $code;
    }

    /**
     * Automatically add prefix and leading zeros when user submits only digits
     * @param  string|null $code
     * @return string|null
     */
    public function reverseTransform($code)
    {
        if (preg_match('/^[0-9]+$/', $code))
          return sprintf('%s%0'.SupplierCodeGenerator::$codeLength.'d', SupplierCodeGenerator::$codePrefix, (int)$code);
        return trim($code);
    }
}
