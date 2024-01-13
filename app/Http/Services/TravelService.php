<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\ITravelService;
use App\Models\Dtos\TravelDTO;
use App\Models\Travel;
use App\Http\Requests\UpdateTravelRequest;

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
}