<?php

namespace App\Service;

use App\Entity\Bookmark;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class BookmarkService
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $manager;

    /**
     * @var SerializerInterface
     */
    protected SerializerInterface $serializer;

    /**
     * @var BookmarkEmbedService
     */
    protected BookmarkEmbedService $bookmarkEmbedService;

    /**
     * bookmarkService constructor.
     *
     * @param EntityManagerInterface $manager
     * @param SerializerInterface $serializer
     * @param BookmarkEmbedService $bookmarkEmbedService
     */
    public function __construct(
        EntityManagerInterface $manager,
        SerializerInterface $serializer,
        BookmarkEmbedService $bookmarkEmbedService
    )
    {
        $this->manager              = $manager;
        $this->serializer           = $serializer;
        $this->bookmarkEmbedService = $bookmarkEmbedService;
    }

    /**
     * Function to get the bookmarks list
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function listBookmarks(Request $request): JsonResponse
    {
        $bookmarkRepository = $this->manager->getRepository(Bookmark::class);

        return new JsonResponse(
            $this->serializer->serialize($bookmarkRepository->findAll(), 'json', ['groups' => 'bookmark_list']),
            Response::HTTP_OK,
            [],
            true,
        );
    }

    /**
     * Function to get a single bookmark
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function getBookmark(Request $request, $id): JsonResponse
    {
        $bookmarkRepository = $this->manager->getRepository(Bookmark::class);

        return new JsonResponse(
            $this->serializer->serialize($bookmarkRepository->find($id), 'json', ['groups' => 'bookmark_item']),
            Response::HTTP_OK,
            [],
            true,
        );
    }

    /**
     * Function to add a bookmark to the Bookmark list
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createBookmark(Request $request): JsonResponse
    {
        $url      = $this->serializer->deserialize($request->getContent(), Bookmark::class, 'json');
        $bookmark = $this->bookmarkEmbedService->getBookmarkFieldsFromUrl($url);

        $this->manager->persist($bookmark);
        $this->manager->flush();

        return new JsonResponse(
            $this->serializer->serialize($bookmark, 'json', ['groups' => 'bookmark_item']),
            Response::HTTP_CREATED,
            [],
            true,
        );
    }

    /**
     * Function to delete a single bookmark
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function deleteBookmark(Request $request, $id): JsonResponse
    {
        $bookmarkRepository = $this->manager->getRepository(Bookmark::class);
        $bookmark           = $bookmarkRepository->find($id);

        $this->manager->remove($bookmark);
        $this->manager->flush();

        return new JsonResponse(
            $this->serializer->serialize($bookmark, 'json', ['groups' => 'bookmark_item']),
            Response::HTTP_OK,
            [],
            true,
        );
    }
}
