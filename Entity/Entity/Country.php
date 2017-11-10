<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\CRMBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Country entity.
 */
class Country
{
    use BaseEntity;

    /**
     * @var string
     */
    private $code;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $provinces;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->provinces = new ArrayCollection();
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Country
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set enabled.
     *
     * @param bool $enabled
     *
     * @return Country
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled.
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return Country
     */
    public function enable()
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * @return Country
     */
    public function disable()
    {
        $this->enabled = false;

        return $this;
    }

    /**
     * Add provinces.
     *
     * @param Province $province
     *
     * @return Country
     */
    public function addProvince(Province $province)
    {
        $this->provinces[] = $province;

        return $this;
    }

    /**
     * Remove provinces.
     *
     * @param Province $province
     *
     * @return Country
     */
    public function removeProvince(Province $province)
    {
        $this->provinces->removeElement($province);

        return $this;
    }

    /**
     * Get provinces.
     *
     * @return Collection
     */
    public function getProvinces()
    {
        return $this->provinces;
    }

    /**
     * @return bool
     */
    public function hasProvinces()
    {
        return !$this->provinces->isEmpty();
    }

    /**
     * @param Province $province
     *
     * @return bool
     */
    public function hasProvince(Province $province)
    {
        return $this->provinces->contains($province);
    }
}
