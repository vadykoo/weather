<?php

namespace App\Services;
use ipinfo\ipinfo\IPinfo;

class LocationService {

    public function getCity($ip)
    {
        $client = new IPinfo(env('IPINFO_SECRET'));
        $details = $client->getDetails($ip);

        $location = [
            'lat'  => $details->latitude,
            'lon' => $details->longitude,
        ];

        return $location;
    }

}
