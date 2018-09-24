<?php

namespace App\Controller;

use App\Service\OrderService;
use App\Utility\ResponseUtility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OrderController
 * @package App\Controller
 */
class OrderController extends AbstractController
{
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param mixed ...$args
     * @return bool
     */
    private function is_JSON(...$args) : bool
    {
        json_decode(...$args);
        return (json_last_error()===JSON_ERROR_NONE);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function checkRequestBodyContent(Request $request) : array
    {
        $content = $request->getContent();

        if(empty($content)){
            return ResponseUtility::failureResponse("Content is empty");
        }

        if(!$this->is_JSON($content)){
            return ResponseUtility::failureResponse("Content is not a valid json");
        }

        return ResponseUtility::successResponse();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function getRequestContent(Request $request) : array
    {
        return json_decode($request->getContent(),true);
    }

    /**
     * @param $response
     * @return int
     */
    private function getStatusCode($response) : int
    {
        if(!$response['status']) {
            $statusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        } else {
            $statusCode = JsonResponse::HTTP_OK;
        }
        return $statusCode;
    }

    private function getResponseContent($response)
    {
        if($response['status']) {
            return $response['data'];
        }
        return $response;
    }

    /*
     *  - Method: `GET`
  - Url path: `/orders?page=:page&limit=:limit`
     */
    /**
     * @Route("/orders", name="orderList", methods="GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        var_dump($request->query->get('limit'));
        var_dump($request->query->get('page'));die();
        return new JsonResponse(['status' => 'success'], JsonResponse::HTTP_OK);
    }


    /**
     * @Route("/order", name="orderCreate", methods="POST")
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function create(Request $request) : JsonResponse
    {
        $respReqCheck = $this->checkRequestBodyContent($request);

        if(!$respReqCheck['status']) {
            $response = $respReqCheck;
        }else {
            $parameters = $this->getRequestContent($request);
            $response = $this->orderService->createOrder($parameters);
        }



        return new JsonResponse($this->getResponseContent($response), $this->getStatusCode($response));
    }

    /*
     * - Method: `PUT`
  - URL path: `/order/:id`
  - Request body:
    ```
    {
        "status":"taken"
    }
    ```
     */
    /**
     * @Route("/order/{id}", name="orderUpdate", methods="PUT")
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        var_dump($id);
        var_dump(json_decode($request->getContent(),true));die();
        return new JsonResponse(['status' => 'success'], JsonResponse::HTTP_OK);
    }
}
