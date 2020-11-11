<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DailyWeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->withoutWrapping();

        return [
            "temp" => $this->temp->day,
            "pressure" => $this->pressure,
            "humidity" => $this->humidity
        ];
    }
}
