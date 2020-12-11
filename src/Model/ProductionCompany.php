<?php


namespace App\Model;


class ProductionCompany extends TheMovieDBBase
{
    private ?string $logo_path;
    private string $name;
    private string $origin_country;

    /**
     * @return string|null
     */
    public function getLogoPath(): ?string
    {
        return $this->logo_path;
    }

    /**
     * @param string|null $logo_path
     * @return ProductionCompany
     */
    public function setLogoPath(?string $logo_path): ProductionCompany
    {
        $this->logo_path = $logo_path;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductionCompany
     */
    public function setName(string $name): ProductionCompany
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginCountry(): string
    {
        return $this->origin_country;
    }

    /**
     * @param string $origin_country
     * @return ProductionCompany
     */
    public function setOriginCountry(string $origin_country): ProductionCompany
    {
        $this->origin_country = $origin_country;
        return $this;
    }
}
