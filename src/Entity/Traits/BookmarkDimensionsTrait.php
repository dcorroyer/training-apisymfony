<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait BookmarkDimensionsTrait
{
    /**
     * @ORM\Column(type="float")
     * @Groups("bookmark_item")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value="0", message="Height cannot be less than 0")
     */
    private float $height;

    /**
     * @ORM\Column(type="float")
     * @Groups("bookmark_item")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value="0", message="Width cannot be less than 0")
     */
    private float $width;

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     *
     * @return $this
     */
    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     *
     * @return $this
     */
    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }
}
