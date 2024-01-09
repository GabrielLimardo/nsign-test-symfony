<?php

namespace App\Tests\unit\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StackOverflowControllerTest extends WebTestCase
{
    public function testGetStackOverflowData()
    {
        $client = static::createClient();

        $client->request('GET', '/api/stackoverflow_posts');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetStackOverflowDataQuestion()
    {
        $client = static::createClient();
        
        $client->request('GET', '/api/stackoverflow_questions');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetStackOverflowDataAnswers()
    {
        $client = static::createClient();
        
        $client->request('GET', '/api/stackoverflow_answers');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
