<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Interfaces\ITravelController;
use App\Models\Travel;
use App\Models\Dtos\TravelDTO;
use App\Http\Services\TravelService;
use App\Http\Requests\TravelRequest;
use App\Http\Requests\UpdateTravelRequest;

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
    return redirect()->route('index')->with('success', $msg);
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
    
        $travel->name = $request->input('name');
        $travel->city_id = $request->input('city_id');
        $travel->description = $request->input('description');
        
        if ($request->hasFile('file')) {
            $photo = $request->file('file');
            if (!$photo->isValid()) {
                dd('Błąd podczas przesyłania pliku');
            }
        
            $photoName = uniqid() . '_' . $photo->getClientOriginalName();
            $travel->photo_path = $photo->storeAs('public/uploads', $photoName);
        }

        $travel->date_from = $request->input('date_from');
        $travel->date_to = $request->input('date_to');
        $travel->places = $request->input('places');
        $travel->price = $request->input('price');
        $travel->last_minute = $request->input('last_minute');
        $travel->all_inclusive = $request->input('all_inclusive');
        $travel->save();
    
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
