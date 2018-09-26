<?php
/**
 * Created by PhpStorm.
 * User: karan
 * Date: 25/9/18
 * Time: 11:32 AM
 */

namespace App\Library;


use Curl\Curl;

class DistanceGoogle implements Distance
{
    private $baseUrl = "https://maps.googleapis.com/maps/api/distancematrix/json";
    private $origin;
    private $destination;
    private $apiKey;

    public function __construct($origin, $destination)
    {
        $this->origin = implode("," ,$origin);
        $this->destination = implode(",",$destination);
        $this->apiKey =  getenv('GOOGLE_API_KEY');
    }

    /**
     * @return array
     * @throws \ErrorException
     */
    private function getDataFromApi() : array
    {
        $curl = new Curl();
        $resp =   $curl->get($this->baseUrl, array(
           'origins' => $this->origin ,
            'destinations' => $this->destination,
            'key' => $this->apiKey
        ));

        return json_decode(json_encode($resp), True);

    }

    /**
     * @param $response
     * @return float
     */
    private function getDistanceFromResponse($response) : float
    {
        $distance = -1;

        if(!empty($response['rows'][0]['elements'][0]['distance']['value'])) {
            $distance = $response['rows'][0]['elements'][0]['distance']['value'];
        }

        return $distance;
    }

    /**
     * @return float
     * @throws \ErrorException
     */
    public function getDistance() : float
    {
        $respGoogle = $this->getDataFromApi();

        $distance = $this->getDistanceFromResponse($respGoogle);

        if($distance === -1.0) {
            throw new \Exception("Something wrong with the Distance API");
        }

        return $distance;
    }
}