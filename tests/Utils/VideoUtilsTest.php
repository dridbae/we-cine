<?php

namespace App\Tests\Utils;

use App\Model\Video;
use App\Model\Videos;
use App\Utils\VideoUtils;
use PHPUnit\Framework\TestCase;

class VideoUtilsTest extends TestCase
{
    public function testGetVideoTrailerValid()
    {
        $util = new VideoUtils();
        $video1 = new Video();
        $video1->setId('1');
        $video1->setType('dummy');
        $video1->setSite('dummy');
        $video2 = new Video();
        $video2->setId('2');
        $video2->setType('Trailer');
        $video2->setSite('YouTube');
        // @TODO Find the reason why both prophecy and mock builder genrerate a reflection error
//        $videosProphecy = $this->prophesize(Videos::class);
//        $videosProphecy->getResults()->willReturn([$video1, $video2]);
//        $result = $util->getVideoTrailer($videosProphecy->reveal());
//        $stub = $this->createMock(Videos::class);
//        $stub->method('getResults')->willReturn([$video1, $video2]);
//        $result = $util->getVideoTrailer($stub);
        $result = $util->getVideoTrailer((new Videos())->setResults([$video1, $video2]));
        $this->assertNotNull($result);
        $this->assertInstanceOf(Video::class, $result);
        $this->assertEquals('2', $result->getId());
    }

    public function testGetVideoTrailerInvalid()
    {
        $util = new VideoUtils();
        $video1 = new Video();
        $video1->setId('1');
        $video1->setType('dummy');
        $video1->setSite('dummy');
        $video2 = new Video();
        $video2->setId('2');
        $video2->setType('dummy');
        $video2->setSite('YouTube');
//        $videosProphecy = $this->prophesize(Videos::class);
//        $videosProphecy->getResults()->willReturn([$video1, $video2]);
//        $result = $util->getVideoTrailer($videosProphecy->reveal());

        $result =  $util->getVideoTrailer((new Videos())->setResults([$video1, $video2]));
        $this->assertFalse($result);
    }
}
