<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 25/9/18
 * Time: 1:34 PM
 */

namespace App\Tests\Utility;

use App\Utility\ResponseUtility;
use PHPUnit\Framework\TestCase;

class ResponseUtilityTest extends TestCase
{
    public function successResponseDataProvider()
    {
        return array(
            array(
                array('id' => 1), array('status' => true, 'data' => array('id' => 1))
            )
        );
    }

    public function failureResponseDataProvider()
    {
        return array(
            array(
                "Error Message", array('status' => false, 'error' => 'Error Message')
            )
        );
    }

    /**
     * @param $data
     * @param $expectedResult
     * @dataProvider successResponseDataProvider
     */
    public function testSuccessResponse($data, $expectedResult)
    {
        $result = ResponseUtility::successResponse($data);
        self::assertEquals($expectedResult, $result);
    }


    /**
     * @param $data
     * @param $expectedResult
     * @dataProvider failureResponseDataProvider
     */
    public function testFailureResponse($data,$expectedResult)
    {
        $result = ResponseUtility::failureResponse($data);
        self::assertEquals($expectedResult, $result);
    }




}