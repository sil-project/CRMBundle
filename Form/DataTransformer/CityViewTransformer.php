<?php

/*
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\CRMBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Doctrine\Common\Persistence\ObjectRepository;
use Ramsey\Uuid\Uuid;

class CityViewTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectRepository
     */
    private $cityRepository;

    /**
     * @var string
     */
    private $targetField;

    public function __construct($targetField = 'city')
    {
        $this->targetField = $targetField;
    }

    /**
     * @param string $cityOrZip
     *
     * @return string
     */
    public function transform($cityOrZip)
    {
        if (Uuid::isValid($cityOrZip)) {
            $realCity = $this->cityRepository->find($cityOrZip);

            if ($realCity) {
                $propertyAccessor = new PropertyAccessor();

                return $propertyAccessor->getValue($realCity, $this->targetField);
            }
        }

        return $cityOrZip;
    }

    /**
     * @param string $cityOrZip
     *
     * @return string
     */
    public function reverseTransform($cityOrZip)
    {
        return $cityOrZip;
    }

    /**
     * @param ObjectRepository $cityRepository
     */
    public function setCityRepository(ObjectRepository $cityRepository): void
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param string $targetField
     */
    public function setTargetField(string $targetField): void
    {
        $this->targetField = $targetField;
    }
}
