<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Travel;

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

    public function travels()
    {
        $travels = Travel::all();
        $travels = Travel::mapCollectionToDto($travels);
        return view('management.management_travels')->with('travels', $travels);
    }
}
