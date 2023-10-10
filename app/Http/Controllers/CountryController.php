<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Models\Dtos\CountryDTO;
use App\Http\Services\CountryService;
use App\Http\Controllers\Interfaces\ICountryController;

class CountryController extends Controller implements ICountryController
{
    private CountryService $service;

    public function __construct()
    {
        $this->service = new CountryService();
    }

    public function index()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    public function store(CountryRequest $request)
    {
        $country = new CountryDTO(ucfirst(strtolower($request->name)));
        $this->service->create($country);
    }
}
