<?php

namespace App\Tests\unit\Request;

namespace App\Tests;

use App\Request\StackOverflowRequest;
use App\Config\StackOverflowConfig;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class StackOverflowRequestTest extends WebTestCase
{
    public function testSetFromRequestWithDescOrder()
    {
        $requestData = [
            'order' => 'desc',
            'sort' => 'activity',
            'page' => 1,
            'pagesize' => 10,
            'todate' => '2023-01-01',
            'max' => 100,
            'fromdate' => '2022-01-01',
            'min' => 10,
        ];

        $request = new Request([], $requestData);

        $stackOverflowRequest = new StackOverflowRequest();
        $stackOverflowRequest->setFromRequest($request, StackOverflowConfig::POSTS_VARIABLE);

        $this->assertEquals('desc', $stackOverflowRequest->order);
        $this->assertEquals('activity', $stackOverflowRequest->sort);
        $this->assertEquals(1, $stackOverflowRequest->page);
        $this->assertEquals(10, $stackOverflowRequest->pagesize);
        $this->assertEquals('2023-01-01', $stackOverflowRequest->todate);
        $this->assertEquals(100, $stackOverflowRequest->max);
        $this->assertEquals('2022-01-01', $stackOverflowRequest->fromdate);
        $this->assertEquals(10, $stackOverflowRequest->min);
    }

    public function testSetFromRequestWithInvalidSortForQuestions()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid sort option for questions.');

        $requestData = [
            'order' => 'asc',
            'sort' => 'invalid_sort',  // Un valor inválido para sort
        ];

        $request = new Request([], $requestData);

        $stackOverflowRequest = new StackOverflowRequest();
        $stackOverflowRequest->setFromRequest($request, StackOverflowConfig::QUESTION_VARIABLE);
    }

    public function testSetFromRequestWithMinAndMaxForQuestions()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Min and Max are not applicable for questions.');

        $requestData = [
            'min' => 5,
            'max' => 15,
        ];

        $request = new Request([], $requestData);

        $stackOverflowRequest = new StackOverflowRequest();
        $stackOverflowRequest->setFromRequest($request, StackOverflowConfig::QUESTION_VARIABLE);
    }

}
