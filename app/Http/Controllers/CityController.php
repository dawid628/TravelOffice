<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Interfaces\ICityController;
use App\Http\Services\CityService;
use App\Models\City;
use App\Models\Dtos\CityDTO;    

class CityController extends Controller implements ICityController
{
    private CityService $service;

    public function __construct()
    {
        $this->service = new CityService();
    }

    public function index()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    public function store(CityRequest $request)
    {
        $city = new CityDTO(ucfirst(strtolower($request->name)), $request->country_id);
        $this->service->create($city);
    }
}
