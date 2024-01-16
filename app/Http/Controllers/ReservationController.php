<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest; 
use App\Models\Travel;
use Auth;
use App\Http\Services\ReservationService;
use App\Http\Services\TravelService;

class ReservationController extends Controller
{

    private ReservationService $service;
    private TravelService $travelService;

    public function __construct()
    {
        $this->service = new ReservationService();
        $this->travelService = new TravelService();
    }

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        return view('reservations.index', compact('reservations'));
    }

    public function store(StoreReservationRequest $request)
    {
        $validated = $request->validated();
        $travel = Travel::find($validated['travel_id']);
        
        $reservation = new Reservation();
        $reservation->travel_id = $validated['travel_id'];
        $reservation->user_id = Auth::id();
        $reservation->headcount = $validated['headcount'];
        $reservation->total = $travel->price * $validated['headcount'];
        $reservation->paid = 0;
        $travel->places = $travel->places - $validated['headcount'];
        
        $travel->save();
        $reservation->save();
        return redirect()->route('index')->with('success', 'Rezerwacja pomyślna.');
    }

    public function pay(int $id)
    {
        $this->service->pay($id);
        return redirect()->route('reservations')->with('success', 'Opłacono rezerwację.');
    }

    public function delete(int $id)
    {
        $reservation = Reservation::find($id);
        $this->travelService->updatePlaces($reservation->travel_id, $reservation->headcount);
        $reservation->delete();

        return redirect()->route('reservations')->with('success', 'Anulowano rezerwację.');   
    }
}
