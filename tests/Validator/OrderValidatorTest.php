<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 25/9/18
 * Time: 2:06 PM
 */

namespace App\Tests\Validator;

use App\Constant\Constant;
use App\Utility\ResponseUtility;
use App\Validator\OrderValidator;
use PHPUnit\Framework\TestCase;

class OrderValidatorTest extends TestCase
{
    public function validateCreateOrderParamsDataProvider()
    {
        return array(
          array(
              array("origin" => ["40.6655101", "-73.89188969999998"],
                "destination"=> ["40.6905615", "-73.9976592"]
              ), ResponseUtility::successResponse()
          ),
          array(
              array("origin1" => ["40.6655101", "-73.89188969999998"],
                    "destination"=> ["40.6905615", "-73.9976592"]
              ), ResponseUtility::failureResponse('Parameters missing')
          ),
          array(
              array("origin" => ["140.6655101", "-73.89188969999998"],
                    "destination"=> ["40.6905615", "-173.9976592"]
              ), ResponseUtility::failureResponse('Incorrect latitude or longitude')
          ),

        );
    }

    /**
     * @param $data
     * @param $expectedResult
     * @dataProvider validateCreateOrderParamsDataProvider
     */
    public function testValidateCreateOrderParams($data, $expectedResult)
    {
        $orderValidator = new OrderValidator();

        $result = $orderValidator->validateCreateOrderParams($data);

        $this->assertEquals($expectedResult, $result);
    }

    public function validateUpdateOrderStatusParametersDataProvider()
    {
        return array(
            array(
                array(Constant::ID => 1, Constant::STATUS => 'taken'),
                ResponseUtility::successResponse()
            ),
            array(
                array(Constant::ID => '1a', Constant::STATUS => 'taken'),
                ResponseUtility::failureResponse('Incorrect type for Order Id')
            ),
            array(
                array(Constant::ID => '1', Constant::STATUS => 'taken1'),
                ResponseUtility::failureResponse('Invalid Status')
            ),
        );
    }

    /**
     * @param $data
     * @param $expectedResult
     * @dataProvider validateUpdateOrderStatusParametersDataProvider
     */
    public function testValidateUpdateOrderStatusParameters($data, $expectedResult)
    {
        $orderValidator = new OrderValidator();

        $result = $orderValidator->validateUpdateOrderStatusParameters($data);

        $this->assertEquals($expectedResult, $result);
    }

    public function validateListOrderParametersDataProvider()
    {
        return array(
          array(
            array(
                'page' => '1a',
                'limit' => '1a',
            ), ResponseUtility::failureResponse('Incorrect type page or limit')
          ),
          array(
            array(
                'page' => '1',
                'limit' => '1',
            ), ResponseUtility::successResponse()
          )
        );
    }

    /**
     * @param $data
     * @param $expectedResult
     * @dataProvider validateListOrderParametersDataProvider
     */
    public function testValidateListOrderParameters($data, $expectedResult)
    {
        $orderValidator = new OrderValidator();

        $result = $orderValidator->validateListOrderParameters($data);

        $this->assertEquals($expectedResult, $result);
    }
}