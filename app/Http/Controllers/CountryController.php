<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Models\Dtos\CountryDTO;
use App\Http\Services\CountryService;
use App\Http\Controllers\Interfaces\ICountryController;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCountryRequest;

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
        $msg = 'Kraj został utworzony pomyślnie.';
        $this->service->create($country);
        return redirect()->route('index')->with('success', $msg);
    }

    public function create()
    {
        return view('create-country');
    }

    public function destroy(int $id)
    {
        $country = Country::find($id);
    
        if (!$country) {
            return redirect()->route('management')->with('error', 'Kraj nie istnieje.');
        }
    
        $country->delete();
        return redirect()->route('management')->with('success', 'Kraj został usunięty pomyślnie.');
    }
    
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $country = $country->mapToDto();
        return view('edit-country', compact('country'));
    }
    
    public function update(UpdateCountryRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->update($request->all());
    
        return redirect()->route('management')->with('success', 'Kraj został zaktualizowany pomyślnie.');
    }
    
}
