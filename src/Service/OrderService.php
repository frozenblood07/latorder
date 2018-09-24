<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 24/9/18
 * Time: 2:02 PM
 */

namespace App\Service;


use App\Constant\Constant;
use App\Entity\Orders;
use App\Repository\OrderRepository;
use App\Utility\ResponseUtility;
use App\Validator\OrderValidator;

class OrderService
{
    private $orderValidator;
    private $distanceService;
    private $orderRepository;

    /**
     * OrderService constructor.
     * @param OrderValidator $orderValidator
     * @param DistanceService $distanceService
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderValidator $orderValidator, DistanceService $distanceService, OrderRepository $orderRepository)
    {
        $this->orderValidator = $orderValidator;
        $this->distanceService = $distanceService;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $parameters
     * @return array
     */
    public function createOrder($parameters) : array
    {
        //check if request is valid
        $respValidator = $this->orderValidator->validateCreateOrderParams($parameters);

        if(!$respValidator['status']) {
            return $respValidator;
        }

        //get distance from api
        $respDistanceCalc = $this->getDistanceBetweenCoordinates($parameters);
        if(!$respDistanceCalc['status']) {
            return $respDistanceCalc;
        }

        //create order
        $parameters[Constant::DISTANCE] = $respDistanceCalc['data'];

        $order = $this->createNewOrderObject($parameters);


        $this->orderRepository->save($order);

        $response = array(Constant::ID => $order->getId(), Constant::DISTANCE => $order->getDistance(), Constant::STATUS => $order->getStatus());

        return ResponseUtility::successResponse($response);

    }

    /**
     * @param $parameters
     * @return Orders
     */
    private function createNewOrderObject($parameters) : Orders
    {
        $order = new Orders();

        $order->setStatus(Constant::UNASSIGNED_STATUS);
        $order->setStartLat($parameters[Constant::ORIGIN][0]);
        $order->setStartLong($parameters[Constant::ORIGIN][1]);
        $order->setStopLat($parameters[Constant::DESTINATION][0]);
        $order->setStopLong($parameters[Constant::DESTINATION][1]);
        $order->setDistance($parameters[Constant::DISTANCE]);

        return $order;
    }

    /**
     * @param $parameters
     * @return array
     */
    private function getDistanceBetweenCoordinates($parameters) : array
    {
        try {
            $distance = $this->distanceService->getDistanceBetweenCoordinates($parameters[Constant::ORIGIN], $parameters[Constant::DESTINATION]);
        }catch (\Exception $ex)  {
            return ResponseUtility::failureResponse($ex->getMessage());
        }

        return ResponseUtility::successResponse($distance);
    }
}