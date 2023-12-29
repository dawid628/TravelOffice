<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\CityRequest;
use App\Http\Requests\UpdateCityRequest;

interface ICityController
{
    function index();
    function store(CityRequest $request);
    function update(UpdateCityRequest $request, $id);
    function create();
    function edit($id);
    function destroy(int $id);
}