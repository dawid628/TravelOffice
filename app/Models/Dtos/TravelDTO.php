<?php

namespace App\Models\Dtos;

class TravelDTO
{
    public $id;
    public $name;
    public $description;
    public $city_id;
    public $photo_path;
    public $date_from;
    public $date_to;
    public $places;
    public $price;
    public $last_minute;
    public $all_inclusive;
    public $city;

    public function __construct($id = null, $name, $description, $city_id, $photo_path = null, $date_from, $date_to, 
    $places, $price, $last_minute, $all_inclusive, $created_at = null, $updated_at = null, $city = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->city_id = $city_id;
        $this->photo_path = $photo_path;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->places = $places;
        $this->price = $price;
        $this->last_minute = $last_minute;
        $this->all_inclusive = $all_inclusive;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->city = $city;
    }
    
}