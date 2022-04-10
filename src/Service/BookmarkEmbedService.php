<?php

namespace App\Service;

use App\Entity\Bookmark;
use App\Entity\Bookmark\BookmarkImage;
use App\Entity\Bookmark\BookmarkVideo;
use DateTime;
use Embed\Embed;

class BookmarkEmbedService
{
    public function getBookmarkFieldsFromUrl($url): ?Bookmark
    {
        $embed       = new Embed();
        $info        = $embed->get($url->getUrl());
        $oembed      = $info->getOEmbed();
        $publishedAt = $oembed->get('upload_date');
        $type        = $oembed->get('type');
        $bookmark    = "";

        if ($type === Bookmark::BOOKMARK_VIDEO) {
            $bookmark = $this->getBookmarkVideoFields($url);
        }

        if ($type === Bookmark::BOOKMARK_IMAGE) {
            $bookmark = $this->getBookmarkImageFields($url);
        }

        $bookmark->setUrl($url->getUrl())
            ->setAuthor($oembed->get('author_name'))
            ->setTitle($oembed->get('title'))
            ->setProvider($oembed->get('provider_name'))
            ->setPublishedAt(
                $this->getPublishedStringToDateTime(
                    $publishedAt
                )
            )
        ;

        return $bookmark;
    }

    public function getPublishedStringToDateTime($publishedAt): DateTime
    {
        return new DateTime($publishedAt);
    }

    private function getBookmarkVideoFields(Bookmark $url): BookmarkVideo
    {
        $embed  = new Embed();
        $info   = $embed->get($url->getUrl());
        $oembed = $info->getOEmbed();

        $url = new BookmarkVideo();
        $url->setHeight($oembed->get('height'))
            ->setWidth($oembed->get('width'))
            ->setDuration($oembed->get('duration'))
            ->setType($oembed->get('type'))
        ;

        return $url;
    }

    private function getBookmarkImageFields(Bookmark $url): BookmarkImage
    {
        $embed  = new Embed();
        $info   = $embed->get($url->getUrl());
        $oembed = $info->getOEmbed();

        $url = new BookmarkImage();
        $url->setHeight($oembed->get('height'))
            ->setWidth($oembed->get('width'))
            ->setType($oembed->get('type'))
        ;

        return $url;
    }
}