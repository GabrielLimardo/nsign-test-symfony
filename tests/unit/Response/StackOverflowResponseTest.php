<?php

namespace App\Tests\unit\Response;


use PHPUnit\Framework\TestCase;
use App\Response\StackOverflowResponse;

class StackOverflowResponseTest extends TestCase
{
    private $mockData;

    public function setUp(): void
    {
        $this->mockData = [
            'items' => [
                [
                    'owner' => ['display_name' => 'JohnDoe'],
                    'score' => 10,
                    'creation_date' => 1641752400,
                    'post_type' => 'answer',
                    'link' => 'https://example.com/answer'
                ],
            ]
        ];
    }

    public function testGetItems()
    {
        $response = new StackOverflowResponse($this->mockData);
        $items = $response->getItems();

        $this->assertIsArray($items);
        $this->assertCount(1, $items);
        $this->assertEquals('JohnDoe', $items[0]['owner']['display_name']);
    }

    public function testGetFirstItemOwnerDisplayName()
    {
        $response = new StackOverflowResponse($this->mockData);
        $displayName = $response->getFirstItemOwnerDisplayName();

        $this->assertEquals('JohnDoe', $displayName);
    }

    public function testGetFirstItemScore()
    {
        $response = new StackOverflowResponse($this->mockData);
        $score = $response->getFirstItemScore();

        $this->assertEquals(10, $score);
    }

    public function testGetFirstItemCreationDate()
    {
        $response = new StackOverflowResponse($this->mockData);
        $creationDate = $response->getFirstItemCreationDate();

        $this->assertEquals(1641752400, $creationDate);
    }

    public function testGetFirstItemPostType()
    {
        $response = new StackOverflowResponse($this->mockData);
        $postType = $response->getFirstItemPostType();

        $this->assertEquals('answer', $postType);
    }

    public function testGetFirstItemLink()
    {
        $response = new StackOverflowResponse($this->mockData);
        $link = $response->getFirstItemLink();

        $this->assertEquals('https://example.com/answer', $link);
    }
}
