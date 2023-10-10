<?php

namespace App\Http\Services;

use App\Models\Dtos\CityDTO;
use App\Models\City;
use App\Http\Services\Interfaces\ICityService;

class CityService implements ICityService
{
    public function create(CityDTO $dto)
    {
        $obj = City::mapFromDto($dto);
        return $obj->save();
    }
}