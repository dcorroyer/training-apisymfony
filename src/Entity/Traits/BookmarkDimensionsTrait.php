<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait BookmarkDimensionsTrait
{
    /**
     * @ORM\Column(type="float")
     * @Groups("bookmark_item")
     */
    private float $height;

    /**
     * @ORM\Column(type="float")
     * @Groups("bookmark_item")
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
