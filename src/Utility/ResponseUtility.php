<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 24/9/18
 * Time: 2:04 PM
 */

namespace App\Utility;


class ResponseUtility
{
    /**
     * @param $data
     * @return array
     */
    public static function successResponse($data = array()) : array
    {
        return array('status' => true, 'data' => $data);
    }

    /**
     * @param $message
     * @return array
     */
    public static function failureResponse($message) : array
    {
        return array('status' => false, 'error' => $message);
    }
}