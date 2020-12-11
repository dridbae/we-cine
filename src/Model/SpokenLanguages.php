<?php


namespace App\Model;


class SpokenLanguages
{
private string|null $english_name;
private string|null $iso_639_1;
private string|null $name;

    /**
     * @return string|null
     */
    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    /**
     * @param string|null $english_name
     * @return SpokenLanguages
     */
    public function setEnglishName(?string $english_name): SpokenLanguages
    {
        $this->english_name = $english_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIso6391(): ?string
    {
        return $this->iso_639_1;
    }

    /**
     * @param string|null $iso_639_1
     * @return SpokenLanguages
     */
    public function setIso6391(?string $iso_639_1): SpokenLanguages
    {
        $this->iso_639_1 = $iso_639_1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return SpokenLanguages
     */
    public function setName(?string $name): SpokenLanguages
    {
        $this->name = $name;
        return $this;
    }
}
