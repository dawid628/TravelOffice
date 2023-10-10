<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\CityRequest;

interface ICityController
{
    function index();
    function store(CityRequest $request);
}