<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dtos\CountryDTO;
use App\Models\City;

class Country extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }

    public static function mapFromDto(CountryDTO $dto)
    {
        $country = new Country();
        
        $country->name = $dto->name;

        if(!is_null($dto->id)) {
            $country->id = $dto->id;
        }
        if(!is_null($dto->created_at)) {
            $country->created_at = $dto->created_at;
        }
        if(!is_null($dto->updated_at)) {
            $country->updated_at = $dto->updated_at;
        }
        
        return $country;
    }
}
