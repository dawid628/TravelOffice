<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dtos\CountryDTO;
use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

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

    public function mapToDto()
    {
        return new CountryDTO(
            $this->name,
            $this->id,
            $this->created_at,
            $this->updated_at
        );
    }
    

    public static function mapCollectionToDto(Collection $countries)
    {
        $countryDtos = [];

        foreach ($countries as $country) {
            $countryDtos[] = $country->mapToDto();
        }

        return $countryDtos;
    }

}
