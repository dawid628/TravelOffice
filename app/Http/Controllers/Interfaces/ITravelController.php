<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\TravelRequest;
use Illuminate\Models\Travely;
use App\Models\Dtos\TravelDTO;

interface ITravelController
{
    function index();
    function store(TravelRequest $request);
    function create();
}
