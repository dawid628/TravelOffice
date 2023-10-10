<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Dtos\CityDTO;

class City extends Model
{
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public static function mapFromDto(CityDTO $dto)
    {
        $city = new City();
        
        $city->name = $dto->name;
        $city->country_id = $dto->country_id;

        if(!is_null($dto->id)) {
            $city->id = $dto->id;
        }
        if(!is_null($dto->created_at)) {
            $city->created_at = $dto->created_at;
        }
        if(!is_null($dto->updated_at)) {
            $city->updated_at = $dto->updated_at;
        }
        
        return $city;
    }
}
