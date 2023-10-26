<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\ITravelService;
use App\Models\Dtos\TravelDTO;
use App\Models\Travel;

class TravelService implements ITravelService
{
    public function create(TravelDTO $dto)
    {
        $obj = Travel::mapFromDto($dto);
        return $obj->save();
    }
}