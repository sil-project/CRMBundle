<?php

namespace Librinfo\CRMBundle\Entity;

class OrganismPhone extends Phone
{
    /**
     * @var Organism
     */
    private $organism;

    /**
     * Get organism
     *
     * @return Organism
     */
    public function getOrganism()
    {
        return $this->organism;
    }

    /**
     * Set organism
     *
     * @param Organism $organism
     * @return OrganismPhone
     */
    public function setOrganism($organism)
    {
        $this->organism = $organism;
        return $this;
    }

}
