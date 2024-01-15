<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\TravelRequest;
use Illuminate\Models\Travely;
use App\Models\Dtos\TravelDTO;
use Illuminate\Http\Request;

interface ITravelController
{
    function index(Request $request);
    function store(TravelRequest $request);
    function create();
}
