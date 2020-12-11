<?php


namespace App\Model;


class ProductionCountries
{
    private string $iso_3166_1;
    private string $name;

    /**
     * @return string
     */
    public function getIso31661(): string
    {
        return $this->iso_3166_1;
    }

    /**
     * @param string $iso_3166_1
     * @return ProductionCountries
     */
    public function setIso31661(string $iso_3166_1): ProductionCountries
    {
        $this->iso_3166_1 = $iso_3166_1;
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
     * @return ProductionCountries
     */
    public function setName(string $name): ProductionCountries
    {
        $this->name = $name;
        return $this;
    }
}
