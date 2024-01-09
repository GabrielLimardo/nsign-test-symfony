<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Request\StackOverflowRequest;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use App\Response\StackOverflowResponse;
use App\Service\StackOverflowService;

class StackOverflowServiceTest extends TestCase
{
    private $httpClient;
    private $stackOverflowService;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->stackOverflowService = new StackOverflowService($this->httpClient);
    }

    public function testGetPosts()
    {
        $expectedData = [
            'items' => [
            ]
        ];

        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('toArray')->willReturn($expectedData);

        $this->httpClient->method('request')->willReturn($responseMock);

        $stackOverflowRequest = new StackOverflowRequest();

        $response = $this->stackOverflowService->getPosts($stackOverflowRequest);

        $this->assertInstanceOf(StackOverflowResponse::class, $response);
    }
}
