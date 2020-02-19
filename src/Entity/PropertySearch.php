<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;



class PropertySearch
{
    /**
    *@var int|null
    */
    private $maxPrice;

    /**
    *@var int|null
    *@Assert\Range(min=10, max=400)
    */
    private $minSurface;

    /**
    *@var ArrayCollection
    */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }



    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of Options
     *
     * @return ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /** 
     * Set the value of Options
     *
     * @param ArrayCollection $options
     *
     * @return self
     */
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }

}
