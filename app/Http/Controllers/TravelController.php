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
    if ($request->hasFile('file')) {
        $photo = $request->file('file');
        $photoName = uniqid() . '_' . $photo->getClientOriginalName();
        $photoPath = $photo->storeAs('uploads', $photoName);
    } else {
        $photoPath = null; 
    }

    $travel = new TravelDTO(
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
}
