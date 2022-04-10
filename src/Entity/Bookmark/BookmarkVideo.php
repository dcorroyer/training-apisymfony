<?php

namespace App\Entity\Bookmark;

use App\Entity\Bookmark;
use App\Entity\Traits\BookmarkDimensionsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class BookmarkVideo extends Bookmark
{
    use BookmarkDimensionsTrait;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("bookmark_item")
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
