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

public function mapToDto()
{
    $country = $this->country;
    
    return new CityDTO(
        $this->name,
        $this->country_id,
        $this->id,
        $this->created_at,
        $this->updated_at,
        $country ? $country->mapToDto() : null
    );
}

public static function mapCollectionToDto($cities)
{
    return $cities->map(function ($city) {
        return $city->mapToDto();
    });
}
}
