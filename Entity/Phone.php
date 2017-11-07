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

namespace Sil\Bundle\CRMBundle\Entity;

use Blast\Bundle\BaseEntitiesBundle\Entity\Traits\BaseEntity;

/**
 * Phone.
 */
abstract class Phone
{
    use BaseEntity;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $phoneType;

    public function __toString(): string
    {
        $str = $this->number;
        if ($this->phoneType) {
            $str .= ' (' . $this->phoneType . ')';
        }

        return $str;
    }

    /**
     * Set number.
     *
     * @param string $number
     *
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set phoneType.
     *
     * @param string $phoneType
     *
     * @return Phone
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;

        return $this;
    }

    /**
     * Get phoneType.
     *
     * @return string
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }
}
