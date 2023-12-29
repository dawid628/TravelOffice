<?php
namespace App\Models\Dtos;

class CityDTO
{
    public $name;
    public $country_id;
    public $country; // Dodaj właściwość country
    public $id;
    public $created_at;
    public $updated_at;

    public function __construct($name, $country_id, $id = null, $created_at = null, $updated_at = null, $country = null)
    {
        $this->name = $name;
        $this->country_id = $country_id;
        $this->country = $country;
        $this->id = $id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
