<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Http\Resources\DailyWeatherResource;
use App\Services\LocationService;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class WeatherController extends Controller
{
    protected $weatherService;
    protected $locationService;

    public function __construct(WeatherService $weatherService, LocationService $locationService)
    {
        $this->weatherService = $weatherService;
        $this->locationService = $locationService;
    }

    public function show(WeatherRequest $request)
    {
        $city = $request->city;
        $date = Carbon::parse($request->date)->format('d-m-Y') ?? Carbon::now()->format('d-m-Y');

        if($city) {
            if(!$coord = $this->weatherService->getCityCoordinates($city))
                throw ValidationException::withMessages(['city' => 'The city not found']); //trowing exeption if city not found in API
        } else {
            $ip = '91.198.4.227'; //$request->ip();
            $coord = $this->locationService->getCity($ip);
        }

        $daily = $this->weatherService->getWeatherByCoordinates($coord['lat'], $coord['lon']);
        foreach($daily as $day) {
            $day->date = Carbon::parse($day->dt)->format('d-m-Y'); //tranforming dates from seconds format
        }
        $daily = collect($daily)->where('date', $date)->first();

        return new DailyWeatherResource($daily);
    }
}
