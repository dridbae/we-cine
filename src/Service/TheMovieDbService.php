<?php

namespace App\Service;

use App\Model\Genres;
use App\Model\Movie;
use App\Model\Movies;
use App\Model\TopRated;
use App\Model\Video;
use App\Model\Videos;
use App\Utils\VideoUtils;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TheMovieDbService
{
    /**
     * @var TheMovieDBRequesterService
     */
    private TheMovieDBRequesterService $theMovieDBRequesterService;
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * TheMovieDbService constructor.
     * @param TheMovieDBRequesterService $theMovieDBRequesterService
     * @param SerializerInterface $serializer
     */
    public function __construct(
        TheMovieDBRequesterService $theMovieDBRequesterService,
        SerializerInterface $serializer
    ) {
        $this->theMovieDBRequesterService = $theMovieDBRequesterService;
        $this->serializer = $serializer;
    }

    /**
     * @param bool $format
     * @return array|object|string|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getGenres($format = true): array|object|string|null
    {
        if (null !== ($genres = $this->theMovieDBRequesterService->makeGetRequest(TheMovieDBRequesterService::ROUTES['getGenres']))) {
            if ($format) {
                return $this->serializer->deserialize($genres, Genres::class, 'json');
            } else {
                return $genres;
            }
        }

        return null;
    }

    /**
     * @param bool $format
     * @return array|string|null|TopRated
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getTopRated(bool $format = true): array|string|TopRated|null
    {
        if (null !== ($topRated = $this->theMovieDBRequesterService->makeGetRequest(TheMovieDBRequesterService::ROUTES['topRated']))) {
            if ($format) {
                $movies = $this->serializer->deserialize($topRated, TopRated::class, 'json');
                if (!$movies instanceof TopRated) {
                    return null;
                }

                $this->populateTrailers($movies->getResults());

                return $movies;
            } else {
                return $topRated;
            }
        }

        return null;
    }


    /**
     * @param int $id
     * @param bool $format
     * @return array|object|string|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovieVideo(int $id, $format = true): array|object|string|null
    {
        if (null !== ($movieVideo = $this->theMovieDBRequesterService->makeGetRequest(str_replace('{id}', (string) $id, TheMovieDBRequesterService::ROUTES['videos'])))) {
            if ($format) {
                return $this->serializer->deserialize($movieVideo, Videos::class, 'json');
            } else {
                return $movieVideo;
            }
        }

        return null;
    }

    /**
     * @param int $id
     * @return Video|bool|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovieTrailer(int $id): Video|bool|null
    {
        if (null !== ($movieVideo = $this->theMovieDBRequesterService->makeGetRequest(str_replace('{id}', (string) $id, TheMovieDBRequesterService::ROUTES['videos']), [], true))) {
            if (($videos = $this->serializer->deserialize($movieVideo, Videos::class, 'json')) instanceof Videos) {
                return (new VideoUtils())->getVideoTrailer($videos);
            }
        }

        return null;
    }

    /**
     * @param int|string $id
     * @return object|array|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMoviesByGenre(int|string $id): object|array|null
    {
        if (null !== ($movies = $this->theMovieDBRequesterService->makeGetRequest(TheMovieDBRequesterService::ROUTES['topRated'], ['with_genres' => $id]))) {
            return $this->serializer->deserialize($movies, Movies::class, 'json');
        }

        return null;
    }

    /**
     * @param string $search
     * @return Movies|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMoviesBySearch(string $search): ?Movies
    {
        if (null !== ($movies = $this->theMovieDBRequesterService->makeGetRequest(TheMovieDBRequesterService::ROUTES['search'], ['query' => $search]))) {
            /** @var Movies $movies */
            $movies = $this->serializer->deserialize($movies, Movies::class, 'json');
            $this->populateTrailers($movies->getResults());

            return $movies;
        }

        return null;
    }

    /**
     * @param int $id
     * @return object|array|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovie(int $id): object|array|null
    {
        if (null !== ($movie = $this->theMovieDBRequesterService->makeGetRequest(str_replace('{id}', (string) $id, TheMovieDBRequesterService::ROUTES['getMovie'])))) {
            return $this->serializer->deserialize($movie, Movie::class, 'json');
        }

        return null;
    }

    /**
     * @return int|string|null
     */
    private function getTopRatedMovie(): int|string|null
    {
        if (
            $this->getTopRated() instanceof TopRated &&
            count($topRated = $this->getTopRated()->getResults())
        ) {
            return $topRated[0]->getId() ?? null;
        }

        return null;
    }

    /**
     * @return Video|bool|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getTopRatedMovieTrailer(): Video|bool|null
    {
        if (null !== ($id = $this->getTopRatedMovie())) {
            return $this->getMovieTrailer((int) $id);
        }

        return null;
    }

    /**
     * @param mixed $movies
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function populateTrailers(mixed $movies): void
    {
        array_walk($movies, function ($item) {
            if (($trailer = $this->getMovieTrailer($item->getId())) instanceof Video) {
                $item->setTrailer($trailer);
            }
        });
    }
}
