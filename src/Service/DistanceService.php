<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 24/9/18
 * Time: 3:07 PM
 */

namespace App\Service;


class DistanceService
{
    /**
     * @param $from
     * @param $to
     * @param string $provider
     * @return float
     */
    public function getDistanceBetweenCoordinates($from, $to,$provider = 'google') : float
    {
        return 10;
    }
}