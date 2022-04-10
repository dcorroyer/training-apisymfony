<?php

namespace App\DataFixtures;

use App\Entity\Bookmark\BookmarkImage;
use App\Entity\Bookmark\BookmarkVideo;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Embed\Embed;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $embed       = new Embed();
        $video       = $embed->get("https://vimeo.com/76979871");
        $oembedVideo = $video->getOEmbed();

        $bookmarkVideo = new BookmarkVideo();
        $bookmarkVideo->setHeight($oembedVideo->get('height'))
            ->setWidth($oembedVideo->get('width'))
            ->setDuration($oembedVideo->get('duration'))
            ->setType($oembedVideo->get('type'))
            ->setUrl("https://vimeo.com/76979871")
            ->setAuthor($oembedVideo->get('author_name'))
            ->setTitle($oembedVideo->get('title'))
            ->setProvider($oembedVideo->get('provider_name'))
            ->setPublishedAt(new DateTime($oembedVideo->get('upload_date'))
            )
        ;

        $manager->persist($bookmarkVideo);

        $embed       = new Embed();
        $image       = $embed->get("https://www.flickr.com/photos/flickr/51954549378/");
        $oembedImage = $image->getOEmbed();

        $bookmarkImage = new BookmarkImage();
        $bookmarkImage->setHeight($oembedImage->get('height'))
            ->setWidth($oembedImage->get('width'))
            ->setType($oembedImage->get('type'))
            ->setUrl("https://www.flickr.com/photos/flickr/51954549378/")
            ->setAuthor($oembedImage->get('author_name'))
            ->setTitle($oembedImage->get('title'))
            ->setProvider($oembedImage->get('provider_name'))
            ->setPublishedAt(new DateTime($oembedImage->get('upload_date'))
            )
        ;

        $manager->persist($bookmarkImage);

        $manager->flush();
    }
}
