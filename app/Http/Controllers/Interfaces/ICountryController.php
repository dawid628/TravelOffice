<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\CountryRequest;
use Illuminate\Models\Country;
use App\Models\Dtos\CountryDTO;
use App\Http\Services\CountryService;
use App\Http\Requests\UpdateCountryRequest;

interface ICountryController
{
    function index();
    function store(CountryRequest $request);
    function create();
    function destroy(int $id);
    function edit($id);
    function update(UpdateCountryRequest $request, $id);
}
