<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 24/9/18
 * Time: 3:07 PM
 */

namespace App\Service;


use App\Library\DistanceProviderFactory;

class DistanceService
{
    /**
     * @var DistanceProviderFactory
     */
    private $distanceProviderFactory;

    /**
     * DistanceService constructor.
     * @param DistanceProviderFactory $distanceProviderFactory
     */
    public function __construct(DistanceProviderFactory $distanceProviderFactory)
    {
        $this->distanceProviderFactory = $distanceProviderFactory;
    }

    /**
     * @param $from
     * @param $to
     * @param string $provider
     * @return float
     * @throws \Exception
     */
    public function getDistanceBetweenCoordinates($from, $to,$provider = 'google') : float
    {
        $distanceObj = $this->distanceProviderFactory->getDistanceProviderObject($from,$to,$provider);

        return $distanceObj->getDistance();
    }
}