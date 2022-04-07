<?php

namespace App\Controller;

use App\Service\BookmarkService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookmarkController
 * @package App\Controller
 * @Route("/bookmark")
 */
class BookmarkController extends AbstractController
{
    /**
     * @var bookmarkService
     */
    protected BookmarkService $bookmarkService;

    /**
     * BookmarkController constructor.
     *
     * @param BookmarkService $bookmarkService
     */
    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }

    /**
     * @Route("/list", name="bookmark_list", methods={"GET"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        return $this->bookmarkService->listBookmarks($request);
    }

    /**
     * @Route("/{id}", name="bookmark_item", methods={"GET"})
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function item(Request $request, $id): JsonResponse
    {
        return $this->bookmarkService->getBookmark($request, $id);
    }

    /**
     * @Route("/create", name="bookmark_create", methods={"POST"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        return $this->bookmarkService->createBookmark($request);
    }

    /**
     * @Route("/delete/{id}", name="bookmark_delete", methods={"DELETE"})
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function delete(Request $request, $id): JsonResponse
    {
        return $this->bookmarkService->deleteBookmark($request, $id);
    }
}
