<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Interfaces\ITravelController;
use App\Models\Travel;
use App\Models\Dtos\TravelDTO;
use App\Http\Services\TravelService;
use App\Http\Requests\TravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use App\Models\City;

class TravelController extends Controller implements ITravelController
{
    private TravelService $service;

    public function __construct()
    {
        $this->service = new TravelService();
    }

    public function index(Request $request)
    {
        $travels = $this->service->getFilteredTravels($request);
        return view('welcome')->with('travels', $travels);
    }

    public function store(TravelRequest $request)
    {
        if (strtotime($request->date_to) < strtotime($request->date_from)) {
            return redirect()->route('index')->with('error', "Data powrotu nie moze byc wczesniejsza niz data wyjazdu!");
        }

        if ($request->hasFile('file')) {
            $photo = $request->file('file');
            $photoName = uniqid() . '_' . $photo->getClientOriginalName();
            $photoPath = $photo->storeAs('public/uploads', $photoName);
        } else {
            $photoPath = null; 
        }

        $travel = new TravelDTO(
            null,
            ucfirst(strtolower($request->name)),
            $request->description,
            $request->city_id,
            $photoPath,
            $request->date_from,
            $request->date_to,
            $request->places,
            $request->price,
            $request->last_minute,
            $request->all_inclusive
        );
        $this->service->create($travel);

        $msg = 'Oferta podrozy została utworzona pomyślnie.';
        return redirect()->route('management_travels')->with('success', $msg);
    }

    public function create()
    {
        return view('create-travel');
    }    

    public function edit($id)
    {
        $travel = Travel::find($id);
        $travel = $travel->mapToDto();

        if (!$travel) {
            return redirect()->route('management')->with('error', 'Podróz nie istnieje.');
        }
    
        return view('edit-travel', compact('travel'));
    }    

    public function update(UpdateTravelRequest $request, $id)
    {
        $travel = Travel::find($id);
    
        if (!$travel) {
            return redirect()->route('management')->with('error', 'Podróz nie istnieje.');
        }
    
        $this->service->updateTravelData($request, $travel);
    
        return redirect()->route('management')->with('success', 'Podróz została zaktualizowana pomyślnie.');
    }    

    public function destroy(int $id)
    {
        $travel = Travel::find($id);
    
        if (!$travel) {
            return redirect()->route('management')->with('error', 'Podróz nie istnieje.');
        }
    
        $travel->delete();
        return redirect()->route('management')->with('success', 'Podróz została usunięta pomyślnie.');
    }
}
