<?php

namespace Appturbo\ExerciseBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class KnightControllerTest extends WebTestCase
{

    public function testPostKnightBipolelm()
    {
        $client = static::createClient();

        $client->request('POST', '/knight', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"name":"Bipolelm","strength":10,"weapon_power":20}'
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPostKnightElrynd()
    {
        $client = static::createClient();

        $client->request('POST', '/knight', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"name":"Elrynd","strength":10,"weapon_power":50}'
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPostBadKnight()
    {
        $client = static::createClient();

        $client->request('POST', '/knight', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{"name":"FAILED"}'
        );

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        $this->assertArrayHasKey('code', $content);
        $this->assertArrayHasKey('message', $content);
    }

    public function testGetKnightAll()
    {
        $client = static::createClient();

        $client->request('GET', '/knight', [], [], []);

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertArrayHasKey('id', $content[0]);
        $this->assertArrayHasKey('name', $content[0]);
        $this->assertArrayHasKey('strength', $content[0]);
        $this->assertArrayHasKey('weapon_power', $content[0]);

        $this->assertEquals(1, $content[0]['id']);
        $this->assertGreaterThan(2, $content);
    }

    public function testGetKnightNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/knight/1000', [], [], []);

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $this->assertArrayHasKey('code', $content);
        $this->assertArrayHasKey('message', $content);

        $this->assertEquals('Knight #1000 not found.', $content['message']);
    }
}
