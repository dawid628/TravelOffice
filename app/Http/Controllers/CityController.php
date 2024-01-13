<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Interfaces\ICityController;
use App\Http\Services\CityService;
use App\Models\City;
use App\Models\Dtos\CityDTO;    
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller implements ICityController
{
    private CityService $service;

    public function __construct()
    {
        $this->service = new CityService();
    }

    public function index()
    {
        $cities = City::with('country')->get();
        return response()->json($cities);
    }

    public function store(CityRequest $request)
    {
        $city = new CityDTO(ucfirst(mb_strtolower($request->name, 'UTF-8')), $request->country_id);
        $msg = 'Miasto zostało utworzone pomyślnie.';

        $this->service->create($city);
        return redirect()->route('index')->with('success', $msg);
    }

    public function update(UpdateCityRequest $request, $id)
    {
        $city = City::find($id);
    
        if (!$city) {
            return redirect()->route('management')->with('error', 'Miasto nie istnieje.');
        }
    
        $city->name = $request->input('name');
        $city->country_id = $request->input('country_id');
        $city->save();
    
        return redirect()->route('management')->with('success', 'Miasto zostało zaktualizowane pomyślnie.');
    }
       

    public function create()
    {
        return view('create-city');
    }

    public function edit($id)
    {
        $city = City::find($id);
        $city = $city->mapToDto();

        if (!$city) {
            return redirect()->route('management')->with('error', 'Miasto nie istnieje.');
        }
    
        return view('edit-city', compact('city'));
    }    

    public function destroy(int $id)
    {
        $city = City::find($id);
    
        if (!$city) {
            return redirect()->route('management')->with('error', 'Miasto nie istnieje.');
        }
    
        $city->delete();
        return redirect()->route('management')->with('success', 'Miasto zostało usunięte pomyślnie.');
    }

}
