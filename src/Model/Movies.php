<?php


namespace App\Model;


class Movies
{
    /**
     * @var array<Movie>
     */
    private array $results;

    /**
     * @return Movie[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Movie[] $results
     * @return Movies
     */
    public function setResults(array $results): Movies
    {
        $this->results = $results;
        return $this;
    }
}
