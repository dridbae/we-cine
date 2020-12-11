<?php


namespace App\Model;


/**
 * Class Movie
 * @package App\Model
 */
class Movie
{
    /**
     * @var array<ProductionCompany>
     */
    private array $production_companies = [];
    /**
     * @var array<ProductionCountries>
     */
    private array $production_countries = [];
    /**
     * @var array<SpokenLanguages>
     */
    private array $spoken_languages = [];
    /**
     * @var array<Genre>
     */
    private array $genres = [];
    /**
     * @var string|null
     */
    private ?string $status = null;
    /**
     * @var string|null
     */
    private ?string $tagline = null;
    /**
     * @var Video|null
     */
    private ?Video $trailer = null;
    /**
     * @var string|int
     */
    private string|int $id;
    /**
     * @var string|int|float|null
     */
    private string|int|float|null $budget = null;
    /**
     * @var float
     */
    private float $popularity;
    /**
     * @var string
     */
    private string $original_language;
    /**
     * @var string
     */
    private string $original_title;
    /**
     * @var string
     */
    private string $overview;
    /**
     * @var ?string
     */
    private ?string $poster_path;
    /**
     * @var ?string
     */
    private ?string $release_date = '';
    /**
     * @var string
     */
    private string $title;
    /**
     * @var bool
     */
    private bool $adult;
    /**
     * @var bool
     */
    private bool $video;
    /**
     * @var float|bool
     */
    private float|bool $vote_average;
    /**
     * @var int|bool
     */
    private int|bool $vote_count;
    /**
     * @var string|null
     */
    private ?string $backdrop_path;

    /**
     * @return float
     */
    public function getPopularity(): float
    {
        return $this->popularity;
    }

    /**
     * @param float $popularity
     */
    public function setPopularity(float $popularity): void
    {
        $this->popularity = $popularity;
    }

    /**
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->original_title;
    }

    /**
     * @param string $original_title
     * @return Movie
     */
    public function setOriginalTitle(string $original_title): Movie
    {
        $this->original_title = $original_title;
        return $this;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     * @return Movie
     */
    public function setOverview(string $overview): Movie
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    /**
     * @param string|null $poster_path
     * @return Movie
     */
    public function setPosterPath(?string $poster_path): Movie
    {
        $this->poster_path = $poster_path;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReleaseDate(): ?string
    {
        return $this->release_date;
    }

    /**
     * @param string|null $release_date
     * @return Movie
     */
    public function setReleaseDate(?string $release_date): Movie
    {
        $this->release_date = $release_date;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVideo(): bool
    {
        return $this->video;
    }

    /**
     * @param bool $video
     * @return Movie
     */
    public function setVideo(bool $video): Movie
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return bool|float
     */
    public function getVoteAverage(): float|bool
    {
        return $this->vote_average;
    }

    /**
     * @param bool|float $vote_average
     */
    public function setVoteAverage(float|bool $vote_average): void
    {
        $this->vote_average = $vote_average;
    }

    /**
     * @return bool
     */
    public function isAdult(): bool
    {
        return $this->adult;
    }

    /**
     * @param bool $adult
     * @return Movie
     */
    public function setAdult(bool $adult): Movie
    {
        $this->adult = $adult;
        return $this;
    }

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
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->original_language;
    }

    /**
     * @param string $original_language
     * @return Movie
     */
    public function setOriginalLanguage(string $original_language): Movie
    {
        $this->original_language = $original_language;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBackdropPath(): ?string
    {
        return $this->backdrop_path;
    }

    /**
     * @param string|null $backdrop_path
     * @return Movie
     */
    public function setBackdropPath(?string $backdrop_path): Movie
    {
        $this->backdrop_path = $backdrop_path;
        return $this;
    }

    /**
     * @return ProductionCompany[]
     */
    public function getProductionCompanies(): array
    {
        return $this->production_companies;
    }

    /**
     * @param ProductionCompany[] $production_companies
     */
    public function setProductionCompanies(array $production_companies): void
    {
        $this->production_companies = $production_companies;
    }

    /**
     * @return ProductionCountries[]
     */
    public function getProductionCountries(): array
    {
        return $this->production_countries;
    }

    /**
     * @param ProductionCountries[] $production_countries
     */
    public function setProductionCountries(array $production_countries): void
    {
        $this->production_countries = $production_countries;
    }

    /**
     * @return SpokenLanguages[]
     */
    public function getSpokenLanguages(): array
    {
        return $this->spoken_languages;
    }

    /**
     * @param SpokenLanguages[] $spoken_languages
     */
    public function setSpokenLanguages(array $spoken_languages): void
    {
        $this->spoken_languages = $spoken_languages;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return Movie
     */
    public function setStatus(?string $status): Movie
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    /**
     * @param string|null $tagline
     * @return Movie
     */
    public function setTagline(?string $tagline): Movie
    {
        $this->tagline = $tagline;
        return $this;
    }

    /**
     * @return float|int|string|null
     */
    public function getBudget(): float|int|string|null
    {
        return $this->budget;
    }

    /**
     * @param float|int|string|null $budget
     * @return Movie
     */
    public function setBudget(float|int|string|null $budget): Movie
    {
        $this->budget = $budget;
        return $this;
    }

    /**
     * @return Genre[]
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param Genre[] $genres
     */
    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return Video|null
     */
    public function getTrailer(): ?Video
    {
        return $this->trailer;
    }

    /**
     * @param Video|null $trailer
     */
    public function setTrailer(?Video $trailer): void
    {
        $this->trailer = $trailer;
    }

    /**
     * @return bool|int
     */
    public function getVoteCount(): bool|int
    {
        return $this->vote_count;
    }

    /**
     * @param bool|int $vote_count
     */
    public function setVoteCount(bool|int $vote_count): void
    {
        $this->vote_count = $vote_count;
    }
}
