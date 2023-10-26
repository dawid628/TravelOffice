<?php

namespace App\Models\Dtos;

class TravelDTO
{
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

    public function __construct($name, $description, $city_id, $photo_path = null, $date_from, $date_to, $places, $price, $last_minute, $all_inclusive)
    {
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
    }
    
}