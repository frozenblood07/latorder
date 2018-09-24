<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 24/9/18
 * Time: 2:03 PM
 */

namespace App\Validator;


use App\Constant\Constant;
use App\Utility\ResponseUtility;

class OrderValidator
{
    /*
     * ```
    {
        "Constant::ORIGIN": ["START_LATITUDE", "START_LONGTITUDE"],
        "Constant::DESTINATION": ["END_LATITUDE", "END_LONGTITUDE"]
    }
     */
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
}