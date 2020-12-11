<?php


namespace App\Model;


/**
 * Class Video
 * @package App\Model
 */
class Video
{
    /**
     * @var int|string
     */
    private int|string $id;
    /**
     * @var string
     */
    private string $key;
    /**
     * @var string
     */
    private string $site;
    /**
     * @var string
     */
    private string $type;

    /**
     * @return int|string
     */
    public function getId(): int|string
    {
        return $this->id;
    }

    /**
     * @param int|string $id
     * @return Video
     */
    public function setId(int|string $id): Video
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Video
     */
    public function setKey(string $key): Video
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getSite(): string
    {
        return $this->site;
    }

    /**
     * @param string $site
     * @return Video
     */
    public function setSite(string $site): Video
    {
        $this->site = $site;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Video
     */
    public function setType(string $type): Video
    {
        $this->type = $type;
        return $this;
    }
}
