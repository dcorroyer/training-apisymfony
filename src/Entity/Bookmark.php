<?php

namespace App\Entity;

use App\Repository\BookmarkRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookmarkRepository::class)
 * @ORM\Table(name="bookmark")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class Bookmark
{
    const BOOKMARK_IMAGE = 'photo';
    const BOOKMARK_VIDEO = 'video';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"bookmark_list", "bookmark_item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"bookmark_list", "bookmark_item"})
     * @Assert\NotBlank()
     */
    private string $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"bookmark_list", "bookmark_item"})
     * @Assert\NotBlank()
     */
    private string $provider;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"bookmark_list", "bookmark_item"})
     * @Assert\NotBlank()
     */
    private string $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"bookmark_list", "bookmark_item"})
     * @Assert\NotBlank()
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"bookmark_list", "bookmark_item"})
     * @Assert\NotBlank()
     */
    private string $author;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("bookmark_item")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private DateTime $publishedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("bookmark_item")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return $this
     */
    public function setProvider(string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     *
     * @return $this
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPublishedAt(): DateTime
    {
        return $this->publishedAt;
    }

    /**
     * @param DateTime $publishedAt
     *
     * @return $this
     */
    public function setPublishedAt(DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
