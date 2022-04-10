<?php

namespace App\Entity\Bookmark;

use App\Entity\Bookmark;
use App\Entity\Traits\BookmarkDimensionsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BookmarkImage extends Bookmark
{
    use BookmarkDimensionsTrait;
}
