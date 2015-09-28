<?php

namespace AppBundle\Entity;

/**
 * Organism
 */
class Organism extends Addressable
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var guid
     */
    private $category_id;

    /**
     * @var string
     */
    private $administrativeNumber;

    /**
     * @var guid
     */
    private $professional_id;


    /**
     * Set url
     *
     * @param string $url
     *
     * @return Organism
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set categoryId
     *
     * @param guid $categoryId
     *
     * @return Organism
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return guid
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set administrativeNumber
     *
     * @param string $administrativeNumber
     *
     * @return Organism
     */
    public function setAdministrativeNumber($administrativeNumber)
    {
        $this->administrativeNumber = $administrativeNumber;

        return $this;
    }

    /**
     * Get administrativeNumber
     *
     * @return string
     */
    public function getAdministrativeNumber()
    {
        return $this->administrativeNumber;
    }

    /**
     * Set professionalId
     *
     * @param guid $professionalId
     *
     * @return Organism
     */
    public function setProfessionalId($professionalId)
    {
        $this->professional_id = $professionalId;

        return $this;
    }

    /**
     * Get professionalId
     *
     * @return guid
     */
    public function getProfessionalId()
    {
        return $this->professional_id;
    }
    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Organism
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
