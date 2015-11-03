<?php

namespace Librinfo\CRMBundle\Entity;

/**
 * Role
 */
class Role
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var guid
     */
    private $id;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
