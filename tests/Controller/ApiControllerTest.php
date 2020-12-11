<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGenreList()
    {
        $client = $this->createClient();
        $client->request('GET', '/api/genre');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());
        $content = (json_decode($response->getContent(), true));
        $this->assertIsArray($content);
        $this->assertArrayHasKey('genres', $content);
        $this->assertEquals(19, count($content['genres']));
        $this->assertArrayHasKey(0, $content['genres']);
        $this->assertEquals(2, count($content['genres'][0]));
        $this->assertArrayHasKey('id', $content['genres'][0]);
        $this->assertEquals(28, $content['genres'][0]['id']);
        $this->assertArrayHasKey('name', $content['genres'][0]);
        $this->assertEquals('Action', $content['genres'][0]['name']);
    }

    public function testMoviesByGenre()
    {
        $client = $this->createClient();
        $client->request('GET', '/api/moviesByGenre/28');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());
        $content = json_decode($response->getContent(), true);
        $this->assertIsArray($content);
        $this->assertArrayHasKey('results', $content);
        $this->assertIsArray($content['results']);
        $this->assertArrayHasKey(0, $content['results']);
        $this->assertEquals(20, count($content['results']));
        $this->assertIsArray($content['results'][0]);
        $this->assertEquals(21, count($content['results'][0]));
        $this->assertArrayHasKey('popularity', $content['results'][0]);
        $this->assertEquals(348.08, $content['results'][0]['popularity']);
        $client->request('GET', '/api/moviesByGenre');
        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());
    }

    public function testMoviesBySearch()
    {
        $client = $this->createClient();
        $client->request('GET', '/api/moviesBySearch/Jack');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());
        $content = json_decode($response->getContent(), true);
        $this->assertIsArray($content);
        $this->assertArrayHasKey('results', $content);
        $this->assertIsArray($content['results']);
        $this->assertArrayHasKey(0, $content['results']);
        $this->assertEquals(20, count($content['results']));
        $this->assertIsArray($content['results'][0]);
        $this->assertEquals(21, count($content['results'][0]));
        $this->assertArrayHasKey('popularity', $content['results'][0]);
        $this->assertEquals(25, $content['results'][0]['popularity']);
    }

    public function testMovieTrailer()
    {
        $client = $this->createClient();
        $client->request('GET', '/api/movieTrailer/75780');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());
        $content = json_decode($response->getContent(), true);
        $this->assertIsArray($content);
        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('key', $content);
        $this->assertArrayHasKey('site', $content);
        $this->assertArrayHasKey('type', $content);
        $this->assertEquals('YouTube', $content['site']);
        $this->assertEquals('Trailer', $content['type']);
        $client->request('GET', '/api/movieTrailer/dummy');
        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }
}
