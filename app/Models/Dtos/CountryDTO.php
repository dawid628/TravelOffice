<?php

namespace App\Models\Dtos;

class CountryDTO
{
    public $name;
    public $id;
    public $created_at;
    public $updated_at;

    public function __construct($name, $id = null, $created_at = null, $updated_at = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}