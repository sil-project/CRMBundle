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

namespace Sil\Bundle\CRMBundle\Services;

use Doctrine\ORM\EntityRepository;
use Sil\Bundle\CRMBundle\Entity\Contact;
use Sil\Bundle\CRMBundle\Entity\Organism;
use Sil\Bundle\CRMBundle\Entity\Position;

class AppCirclesService
{
    private $circles = [];
    private $circleRepository;

    public function __construct(EntityRepository $repository)
    {
        $this->circleRepository = $repository;
    }

    /**
     * @param string $key
     * @param array  $circle (as defined in circles.yml files)
     */
    public function addCircle($key, $circle)
    {
        $this->circles[$key] = $circle;
    }

    /**
     * @return array
     */
    public function getCircles()
    {
        return $this->circles;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasCircle($key)
    {
        return isset($this->circles[$key]);
    }

    /**
     * @param string $key
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getCircle($key)
    {
        if (!isset($this->circles[$key])) {
            throw new \Exception(sprintf('The app circle "%s" has not been defined. You must declare it in your Bundle circles.yml', $key));
        }
        $circle = $this->circles[$key];

        return $this->circleRepository->find($circle['id']);
    }

    /**
     * @param Organism|Contact|Position $object
     * @param string                    $key
     *
     * @return bool
     */
    public function isInCircle($object, $key)
    {
        if (!$this->hasCircle($key)) {
            return false;
        }
        foreach ($object->getCircles() as $circle) {
            if ($circle->getId() == $this->circles[$key]['id']) {
                return true;
            }
        }

        return false;
    }
}
