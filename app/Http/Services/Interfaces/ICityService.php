<?php

namespace App\Http\Services\Interfaces;

use App\Models\Dtos\CityDTO;

interface ICityService
{
    function create(CityDTO $dto);
}