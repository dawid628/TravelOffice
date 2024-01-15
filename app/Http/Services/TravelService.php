<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\ITravelService;
use App\Models\Dtos\TravelDTO;
use App\Models\Travel;
use App\Http\Requests\UpdateTravelRequest;
use Illuminate\Http\Request;

class TravelService implements ITravelService
{
    public function create(TravelDTO $dto)
    {
        $obj = Travel::mapFromDto($dto);
        return $obj->save();
    }

    public function updateTravelData(UpdateTravelRequest $request, $travel): void
    {
        $travel->name = $request->input('name');
        $travel->city_id = $request->input('city_id');
        $travel->description = $request->input('description');
        $travel->date_from = $request->input('date_from');
        $travel->date_to = $request->input('date_to');
        $travel->places = $request->input('places');
        $travel->price = $request->input('price');
        $travel->last_minute = $request->input('last_minute');
        $travel->all_inclusive = $request->input('all_inclusive');
        $this->handlePhotoUpload($request, $travel);
        $travel->save();
    }

    private function handlePhotoUpload($request, $travel)
    {
        if ($request->hasFile('file')) {
            $photo = $request->file('file');
            if (!$photo->isValid()) {
                dd('Błąd podczas przesyłania pliku');
            }
    
            $photoName = uniqid() . '_' . $photo->getClientOriginalName();
            $travel->photo_path = $photo->storeAs('public/uploads', $photoName);
        }
    }

    public function getFilteredTravels(Request $request)
    {
        $query = Travel::query();
        $this->filterQuery($query, $request);

        return Travel::mapCollectionToDto($query->get());
    }

    private function filterQuery($query, $request)
    {
        if ($request->has('country_id') && !$request->city_id && $request->country_id) {
            $cityIds = City::where('country_id', $request->country_id)->pluck('id')->toArray();
            $query->whereIn('city_id', $cityIds);
        }

        if ($request->has('city_id') && $request->city_id) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->has('places') && $request->places) {
            $query->where('places', '>=', $request->places);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('date_from', '>=', $request->date_from);
        }

        if ($request->has('last_minute')) {
            $query->where('last_minute', $request->last_minute);
        }

        if ($request->has('all_inclusive')) {
            $query->where('all_inclusive', $request->all_inclusive);
        }

        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'date_from_nearest':
                    $query->orderBy('date_from', 'asc');
                    break;
                case 'date_from_farthest':
                    $query->orderBy('date_from', 'desc');
                    break;
            }
        }
        return $query;
    }
}