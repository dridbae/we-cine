<?php


namespace App\Model;


class Videos
{
    /**
     * @var string|int
     */
    private string|int $id;
    /**
     * @var array<Video>
     */
    private array $results = [];

    /**
     * @return int|string
     */
    public function getId(): int|string
    {
        return $this->id;
    }

    /**
     * @param int|string $id
     */
    public function setId(int|string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array<Video>
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Video[] $results
     * @return Videos
     */
    public function setResults(array $results): Videos
    {
        $this->results = $results;
        return $this;
    }

}
