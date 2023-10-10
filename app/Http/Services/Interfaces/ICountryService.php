<?php

namespace App\Http\Services\Interfaces;

use App\Models\Dtos\CountryDTO;

interface ICountryService
{
    function create(CountryDTO $dto);
}