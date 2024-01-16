<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Travel;
use App\Http\Services\UserService;
use App\Models\User;

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

    public function changeRole(Request $request, $userId)
    {
        $userService = new UserService();
        $userService->changeRole(User::find($userId), $request->role);
        
        return redirect()->route('management')->with('success', 'Rola została zmieniona pomyślnie.');
    }
}
