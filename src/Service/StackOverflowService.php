<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Request\StackOverflowRequest;
use App\Response\StackOverflowResponse;
use App\Utils\DateFormatter;
use App\Config\StackOverflowConfig;

class StackOverflowService
{
    private $client;
    private $baseUrl = 'https://api.stackexchange.com/2.3/';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getDataByType(StackOverflowRequest $request, string $type): StackOverflowResponse
    {
        if ($type === StackOverflowConfig::POSTS_VARIABLE) {
            return $this->getPosts($request);
        } elseif ($type === StackOverflowConfig::QUESTION_VARIABLE) {
            return $this->getQuestions($request);
        } elseif ($type === StackOverflowConfig::ANSWERS_VARIABLE) {
            return $this->getAnswers($request);
        } else {
            throw new \InvalidArgumentException('Tipo de solicitud no válido');
        }
    }

    public function getPosts(StackOverflowRequest $stackOverflowRequest): StackOverflowResponse
    {
        $url = $this->baseUrl . 'posts?' . $this->buildParameters($stackOverflowRequest);
        $responseData = $this->client->request('GET', $url)->toArray();

        return new StackOverflowResponse($responseData);
    }

    public function getQuestions(StackOverflowRequest $stackOverflowRequest): StackOverflowResponse
    {
        $url = $this->baseUrl . 'questions?' . $this->buildParameters($stackOverflowRequest);
        $responseData = $this->client->request('GET', $url)->toArray();

        return new StackOverflowResponse($responseData);
    }

    public function getAnswers(StackOverflowRequest $stackOverflowRequest): StackOverflowResponse
    {
        $url = $this->baseUrl . 'answers?' . $this->buildParameters($stackOverflowRequest);
        $responseData = $this->client->request('GET', $url)->toArray();

        return new StackOverflowResponse($responseData);
    }

    private function buildParameters(StackOverflowRequest $request): string
    {
        $parameters = [
            'order' => $request->order,
            'sort' => $request->sort,
            'page' => $request->page,
            'pagesize' => $request->pagesize,
            'tagged' => $request->tagged,
            'todate' => DateFormatter::formatDate($request->todate),
            'max' => DateFormatter::formatDate($request->max),
            'fromdate' => DateFormatter::formatDate($request->fromdate),
            'min' => DateFormatter::formatDate($request->min),
            'site' => 'stackoverflow',
        ];
        
        return http_build_query($parameters);
    }
}