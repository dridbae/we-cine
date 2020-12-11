<?php

namespace App\Controller;

use App\Model\Video;
use App\Service\TheMovieDbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;
    /**
     * @var TheMovieDbService
     */
    private TheMovieDbService $movieDbService;

    public function __construct(SerializerInterface $serializer, TheMovieDbService $movieDbService)
    {
        $this->serializer = $serializer;
        $this->movieDbService = $movieDbService;
    }

    /**
     * @Route("/genre", name="api.genre.list")
     * @return JsonResponse
     */
    public function genreList(): JsonResponse
    {
        return new JsonResponse(
            $this
                ->serializer
                ->serialize(
                    $this->movieDbService->getGenres(),
                    'json'
                ),
            200,
            [],
            true
        );
    }

    /**
     * @Route("/moviesByGenre/{id}", name="api.movies.by.genre")
     * @param string $id
     * @return JsonResponse
     */
    public function moviesByGenre(string $id): JsonResponse
    {
        return new JsonResponse(
            $this
                ->serializer
                ->serialize(
                    $this->movieDbService->getMoviesByGenre($id),
                    'json'
                ),
            200,
            [],
            true
        );
    }

    /**
     * @Route("/moviesBySearch/{search}", name="api.movies.by.search")
     * @param string $search
     * @return JsonResponse
     */
    public function moviesBySearch(string $search): JsonResponse
    {
        return new JsonResponse(
            $this
                ->serializer
                ->serialize(
                    $this->movieDbService->getMoviesBySearch($search),
                    'json'
                ),
            200,
            [],
            true
        );
    }

    /**
     * @Route("/movieTrailer/{id}", requirements={"id"="\d+"}, name="movie_trailer")
     * @param int $id
     * @return JsonResponse
     */
    public function movieTrailer(int $id): JsonResponse
    {
        if (!($trailer = $this->movieDbService->getMovieTrailer($id)) instanceof Video) {
            throw new NotFoundHttpException('Trailer not found');
        }
        $trailer = ($this->serializer->serialize($trailer, 'json'));

        return new JsonResponse($trailer, 200, [], true);
    }
}
