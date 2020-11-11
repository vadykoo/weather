<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService {

    public function __construct()
    {
        $this->appid = env('OPENWEATHER_SECRET');
        $this->link = 'https://api.openweathermap.org';
    }

    public function getWeatherByCoordinates($lat, $lon)
    {
        $response = Http::get("$this->link/data/2.5/onecall?lat=$lat&lon=$lon&exclude=current,minutely,hourly,alerts&appid=$this->appid&units=metric");
        return json_decode($response)->daily;
    }

    /** need to use this function for coordinates because the free openweathermap
    *   can show 7 days weather only by coordinates
    */
    public function getCityCoordinates($cityName)
    {
        $response = Http::get("$this->link/data/2.5/weather?q=$cityName&appid=$this->appid");
        $response = json_decode($response, true);

        if($response['cod'] == 200) {
            return $response['coord'];
        } else {
            return false;
        }
    }
}
