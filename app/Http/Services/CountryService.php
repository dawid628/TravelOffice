<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\ICountryService;
use App\Models\Dtos\CountryDTO;
use App\Models\Country;

class CountryService implements ICountryService
{
    public function create(CountryDTO $dto)
    {
        $obj = Country::mapFromDto($dto);
        return $obj->save();
    }
}