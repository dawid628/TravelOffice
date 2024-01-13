<?php

namespace App\Http\Services\Interfaces;

use App\Http\Requests\UpdateTravelRequest;
use App\Models\Dtos\TravelDTO;

interface ITravelService
{
    function create(TravelDTO $dto);
    function updateTravelData(UpdateTravelRequest $request, $travel): void;
}