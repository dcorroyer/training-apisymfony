<?php

namespace App\Entity\Bookmark;

use App\Entity\Bookmark;
use App\Entity\Traits\BookmarkDimensionsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class BookmarkVideo extends Bookmark
{
    use BookmarkDimensionsTrait;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("bookmark_item")
     * @Assert\GreaterThan(value="0", message="Duration cannot be less than 0")
     */
    private ?float $duration = null;

    /**
     * @return float|null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @param float|null $duration
     *
     * @return $this
     */
    public function setDuration(?float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
