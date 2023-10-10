<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\CountryRequest;
use Illuminate\Models\Country;
use App\Models\Dtos\CountryDTO;
use App\Http\Services\CountryService;

interface ICountryController
{
    function index();
    function store(CountryRequest $request);
}
