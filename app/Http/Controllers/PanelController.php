<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;

class PanelController extends Controller
{
    public function index()
    {
        return view('management.management');
    }

    public function countries()
    {
        $countries = Country::all();
        $countries = Country::mapCollectionToDto($countries);
        return view('management.management_countries')->with('countries', $countries);
    }

    public function cities()
    {
        $cities = City::all();
        $cities = City::mapCollectionToDto($cities);
        return view('management.management_cities')->with('cities', $cities);
    }
}
