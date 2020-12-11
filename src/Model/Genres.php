<?php

namespace App\Model;

class Genres
{
    /**
     *   @var array<Genre>
     */
    private array $genres = [];

    /**
     * @return array<Genre>
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param array<Genre> $genres
     * @return Genres
     */
    public function setGenres(array $genres): Genres
    {
        $this->genres = $genres;
        return $this;
    }
}
