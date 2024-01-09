<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\StackOverflowService;
use App\Request\StackOverflowRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Config\StackOverflowConfig;
use Symfony\Component\HttpFoundation\JsonResponse;

class StackOverflowController extends AbstractController
{
    private $stackOverflowService;

    public function __construct(StackOverflowService $stackOverflowService)
    {
        $this->stackOverflowService = $stackOverflowService;
    }

    public function getStackOverflowData(Request $request): JsonResponse
    {
        return $this->handleRequest($request, StackOverflowConfig::POSTS_VARIABLE);
    }

    public function getStackOverflowDataQuestion(Request $request): JsonResponse
    {
        return $this->handleRequest($request, StackOverflowConfig::QUESTION_VARIABLE);
    }

    public function getStackOverflowDataAnswers(Request $request): JsonResponse
    {
        return $this->handleRequest($request, StackOverflowConfig::ANSWERS_VARIABLE);
    }

    private function handleRequest(Request $request, string $type)
    {
        try {
            $stackOverflowRequest = new StackOverflowRequest();
            $stackOverflowRequest->setFromRequest($request, $type);

            $data = $this->stackOverflowService->getDataByType($stackOverflowRequest, $type);

            return $this->json([
                'status' => 'succeed',
                'data' => $data,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return $this->json([
                'status' => 'unsucceed',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
