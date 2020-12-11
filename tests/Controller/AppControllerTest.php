<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = $this->createClient();
        $client->request('GET', '/');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGenrePage()
    {
        $client = $this->createClient();
        $client->request('GET', '/genre/dummy');
        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
        $client->request('GET', '/genre/18');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testMoviePage()
    {
        $client = $this->createClient();
        $client->request('GET', '/movie/dummy');
        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
        $client->request('GET', '/movie/11334');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

}
