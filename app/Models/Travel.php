<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dtos\TravelDTO;
use App\Models\Travel;

class Travel extends Model
{
    use HasFactory;
    protected $table = 'travels';

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
}
