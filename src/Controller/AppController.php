<?php
namespace App\Controller;

use App\Model\Movie;
use App\Model\Movies;
use App\Model\TopRated;
use App\Model\Video;
use App\Service\TheMovieDbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @var TheMovieDbService
     */
    private TheMovieDbService $theMovieDbService;

    public function __construct(TheMovieDbService $theMovieDbService)
    {
        $this->theMovieDbService = $theMovieDbService;
    }

    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return Response
     */
    public function homePage(Request $request): Response
    {
        $params = [];
        if (null !== $request->get('search')) {
            $params['movies'] = $this->theMovieDbService->getMoviesBySearch($request->get('search'))?->getResults();
        } else {
            $params['movies'] =
                $this->theMovieDbService->getTopRated() instanceof TopRated ?
                    $this->theMovieDbService->getTopRated()->getResults() :
                    null
            ;
        }
        $params['genres'] = $this->theMovieDbService->getGenres();
        $params['trailer'] = $this->theMovieDbService->getTopRatedMovieTrailer();

        return $this->render('pages/home.html.twig', $params);
    }

    /**
     *
     * @Route("/movie/{id}", name="movie", requirements={"id"="\d+"})
     * @param int $id
     * @return Response
     */
    public function moviePage(int $id): Response
    {
        $movie = $this->theMovieDbService->getMovie($id);

        if (!$movie instanceof Movie) {
            throw new NotFoundHttpException();
        }
        if (($trailer = $this->theMovieDbService->getMovieTrailer($id)) instanceof Video) {
            $movie->setTrailer($trailer);
        }

        return $this->render('pages/movie.html.twig', ['movie' => $movie]);
    }

    /**
     *
     * @Route("/genre/{id}", name="genre", requirements={"id"="\d+"})
     * @param int $id
     * @return Response
     */
    public function genrePage(int $id): Response
    {
        $params = [];
        $params['movies'] =
            $this->theMovieDbService->getMoviesByGenre($id) instanceof Movies ?
                $this->theMovieDbService->getMoviesByGenre($id)->getResults() :
                null
        ;
        $params['genres'] = $this->theMovieDbService->getGenres();
        $params['trailer'] = $this->theMovieDbService->getTopRatedMovieTrailer();

        return $this->render('pages/home.html.twig', $params);
    }
}
