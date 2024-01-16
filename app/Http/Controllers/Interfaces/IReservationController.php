<?php

namespace App\Http\Controllers\Interfaces;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest; 
use App\Models\Travel;
use Auth;

interface IReservationController
{

    function index();
    function store(StoreReservationRequest $request);
    function pay(int $id);
    function delete(int $id);
}