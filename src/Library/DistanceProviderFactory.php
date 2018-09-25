<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 25/9/18
 * Time: 12:04 PM
 */

namespace App\Library;


class DistanceProviderFactory
{
    /**
     * @param $from
     * @param $to
     * @param $provider
     * @return object
     */
    public function getDistanceProviderObject($from,$to,$provider) : object
    {
        switch ($provider) {
            case 'google':
                    return new DistanceGoogle($from,$to);
            default:
                return new DistanceGoogle($from,$to);
        }
    }
}