<?php

namespace Librinfo\CRMBundle\Services;

use Doctrine\ORM\EntityRepository;
use Librinfo\CRMBundle\Entity\Contact;
use Librinfo\CRMBundle\Entity\Organism;
use Librinfo\CRMBundle\Entity\Position;

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
     * @param array $circle (as defined in circles.yml files)
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
     * @return boolean
     */
    public function hasCircle($key)
    {
        return isset($this->circles[$key]);
    }

    /**
     * @param string $key
     * @return array
     * @throws \Exception
     */
    public function getCircle($key)
    {
        if (!isset($this->circles[$key]))
            throw new \Exception(sprintf('The app circle "%s" has not been defined. You must declare it in your Bundle circles.yml', $key));
        
        $circle = $this->circles[$key];
        
        return $this->circleRepository->find($circle['id']);
    }

    /**
     * @param Organism|Contact|Position $object
     * @param string $key
     * @return boolean
     */
    public function isInCircle($object, $key)
    {
        if (!$this->hasCircle($key))
            return false;
        foreach ($object->getCircles() as $circle)
            if ($circle->getId() == $this->circles[$key]['id'])
                return true;
        return false;
    }
}