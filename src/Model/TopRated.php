<?php


namespace App\Model;


class TopRated extends TheMovieDBBase
{
    /**
     * @var array<Movie>
     */
    private $results;

    /**
     * @return Movie[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Movie[] $results
     * @return TopRated
     */
    public function setResults(array $results): TopRated
    {
        $this->results = $results;
        return $this;
    }
}
