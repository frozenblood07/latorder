<?php

namespace App\Validator;


use App\Constant\Constant;
use App\Utility\ResponseUtility;

class OrderValidator
{
    /**
     * @param $parameters
     * @return array
     */
    public function validateCreateOrderParams($parameters) : array
    {

        if(!array_key_exists(Constant::ORIGIN,$parameters) || !array_key_exists(Constant::DESTINATION,$parameters)) {
            return ResponseUtility::failureResponse('Parameters missing');
        }

        if(!$this->validateLat($parameters[Constant::ORIGIN][0]) || !$this->validateLong($parameters[Constant::ORIGIN][1]) || !$this->validateLat($parameters[Constant::DESTINATION][0]) || !$this->validateLong($parameters[Constant::DESTINATION][1])) {
            return ResponseUtility::failureResponse('Incorrect latitude or longitude');
        }

        return ResponseUtility::successResponse();
    }

    /**
     * @param $lat
     * @return bool
     */
    private function validateLat($lat) : bool
    {
        if ($lat < -90 || $lat > 90) {
            return false;
        }
        return true;
    }

    /**
     * @param $long
     * @return bool
     */
    private function validateLong($long) : bool
    {
        if($long < -180 || $long > 180) {
            return false;
        }
        return true;
    }

    /**
     * @param $parameters
     * @return array
     */
    public function validateUpdateOrderStatusParameters($parameters) : array
    {
        if(!in_array($parameters[Constant::STATUS], Constant::ALLOWED_ORDER_STATUS)) {
            return ResponseUtility::failureResponse('Invalid Status');
        }

        if (!filter_var($parameters[Constant::ID], FILTER_VALIDATE_INT)) {
            return ResponseUtility::failureResponse('Incorrect type for Order Id');
        }

        return ResponseUtility::successResponse();
    }

    /**
     * @param $parameters
     * @return array
     */
    public function validateListOrderParameters($parameters) : array
    {
        if (!filter_var($parameters[Constant::PAGE], FILTER_VALIDATE_INT) || !filter_var($parameters[Constant::LIMIT], FILTER_VALIDATE_INT)) {
            return ResponseUtility::failureResponse('Incorrect type page or limit');
        }

        return ResponseUtility::successResponse();
    }
}