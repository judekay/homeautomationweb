<?php

namespace app\modules\api\common;

class Geocoder{

    private $url;
    private $result_array = array();

    public function __construct($latitude,$longitude,$apikey) {
        $this->url  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&key=".$apikey;
    }

    public function getLocation(){
        //$url = self::$url.urlencode($address);
        //$url = $this->$url;

        $response_json = $this->curl_file_get_contents($this->url);
        $response = json_decode($response_json, true);

        if($response['status']='OK'){
            $this->result_array = $response['results'][0];
            return $this->result_array['formatted_address'];
        }else{
            return false;
        }
    }

    private function curl_file_get_contents($URL){
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }
}
?>