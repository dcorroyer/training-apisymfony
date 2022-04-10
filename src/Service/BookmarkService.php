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
        $bookmarks          = $bookmarkRepository->findAll();

        return new JsonResponse(
            $this->serializer->serialize($bookmarks, 'json', ['groups' => 'bookmark_list']),
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
        $bookmark           = $bookmarkRepository->find($id);

        if ($bookmark) {
            return new JsonResponse(
                $this->serializer->serialize($bookmark, 'json', ['groups' => 'bookmark_item']),
                Response::HTTP_OK,
                [],
                true,
            );
        }

        return new JsonResponse([
            'error' => 'Bookmark not found'
        ], Response::HTTP_NOT_FOUND);
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
        $url = $this->serializer->deserialize($request->getContent(), Bookmark::class, 'json');

        if (preg_match('/^(http|https):\/\/(www.)?flickr|vimeo.com/', $url->getUrl()) === 1) {
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

        return new JsonResponse([
            'error' => 'The link you sent is not provided by Vimeo or Flickr'
        ], Response::HTTP_BAD_REQUEST);
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

        if ($bookmark) {
            $this->manager->remove($bookmark);
            $this->manager->flush();

            return new JsonResponse(
                $this->serializer->serialize($bookmark, 'json', ['groups' => 'bookmark_item']),
                Response::HTTP_OK,
                [],
                true,
            );
        }

        return new JsonResponse([
            'error' => "Cannot delete the Bookmark $id, Bookmark not found"
        ], Response::HTTP_NOT_FOUND);
    }
}
