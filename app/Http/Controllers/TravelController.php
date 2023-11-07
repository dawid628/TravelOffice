<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Interfaces\ITravelController;
use App\Models\Travel;
use App\Models\Dtos\TravelDTO;
use App\Http\Services\TravelService;
use App\Http\Requests\TravelRequest;

class TravelController extends Controller implements ITravelController
{
    private TravelService $service;

    public function __construct()
    {
        $this->service = new TravelService();
    }

    public function index()
    {
        return csrf_token();
        $travels = Travel::all();
        return response()->json($travels);
    }

    public function store(TravelRequest $request)
    {
        // najpierw zapisywanie pliku i wtedy utworzyc photo_path
        list($name, $description, $city_id, $date_from, $date_to, $places, $price, $last_minute, $all_inclusive) = $request->parameters;
        $travel = new TravelDTO(ucfirst(strtolower($request->name)), $request->description, $request->city_id, 
        $photo_path, $request->date_from, $request->date_to, $request->places, $request->price, $request->last_minute, $request->all_inclusive);
        $this->service->create($travel);
    }

    public function create()
    {
        return view('create-travel');
    }    
}
