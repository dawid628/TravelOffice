<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dtos\TravelDTO;
use App\Models\Travel;
use App\Models\City;

class Travel extends Model
{
    use HasFactory;
    protected $table = 'travels';

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public static function mapFromDto(TravelDTO $dto)
    {
        $travel = new Travel();
        
        $travel->name = $dto->name;
        $travel->description = $dto->description;
        $travel->city_id = (int)$dto->city_id;
        $travel->photo_path = $dto->photo_path;
        $travel->date_from = $dto->date_from;
        $travel->date_to = $dto->date_to;
        $travel->places = $dto->places;
        $travel->price = $dto->price;
        $travel->last_minute = $dto->last_minute;
        $travel->all_inclusive = $dto->all_inclusive;
        
        return $travel;
    }

    public function mapToDto()
    {
        $city = $this->city;
        return new TravelDTO(
            $this->id,
            $this->name,
            $this->description,
            $this->city_id,
            $this->photo_path,
            $this->date_from,
            $this->date_to,
            $this->places,
            $this->price,
            $this->last_minute,
            $this->all_inclusive,
            $this->created_at,
            $this->updated_at,
            $city ? $city->mapToDto() : null
        );
    }

    public static function mapCollectionToDto($travels)
    {
        return $travels->map(function ($travel) {
            return $travel->mapToDto();
        });
    }
}
