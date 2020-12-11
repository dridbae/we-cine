<?php


namespace App\Utils;


use App\Model\Video;
use App\Model\Videos;

class VideoUtils
{
    public function getVideoTrailer(Videos $videos): Video|bool
    {
        $filteredArray = array_filter(
            $videos->getResults(),
            fn ($element) => $element->getType() === 'Trailer' && $element->getSite() === 'YouTube'
        );

        return reset($filteredArray);
    }
}
