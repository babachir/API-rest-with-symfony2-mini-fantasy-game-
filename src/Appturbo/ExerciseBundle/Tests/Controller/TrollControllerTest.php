<?php

namespace Appturbo\ExerciseBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrollControllerTest extends WebTestCase
{

    public function testPostFirstTroll()
    {
        $client = static::createClient();

        $client->request('POST', '/troll', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"strength":10}'
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPostSecondTroll()
    {
        $client = static::createClient();

        $client->request('POST', '/troll', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"strength":10}'
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPostBadTroll()
    {
        $client = static::createClient();

        $client->request('POST', '/troll', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"name":"FAILED","strength":10}'
        );

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        $this->assertArrayHasKey('code', $content);
        $this->assertArrayHasKey('message', $content);
    }

    public function testGetTrollAll()
    {
        $client = static::createClient();

        $client->request('GET', '/troll', [], [], []);

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertArrayHasKey('id', $content[0]);
        $this->assertArrayHasKey('strength', $content[0]);

        $this->assertEquals(1, $content[0]['id']);
        $this->assertGreaterThan(2, $content);
    }

    public function testGetKnightNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/troll/1000', [], [], []);

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $this->assertArrayHasKey('code', $content);
        $this->assertArrayHasKey('message', $content);

        $this->assertEquals('Troll #1000 not found.', $content['message']);
    }
}
