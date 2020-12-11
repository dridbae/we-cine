<?php


namespace App\Model;


class TheMovieDBBase
{
    private int $page;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return TheMovieDBBase
     */
    public function setPage(int $page): TheMovieDBBase
    {
        $this->page = $page;
        return $this;
    }
}
