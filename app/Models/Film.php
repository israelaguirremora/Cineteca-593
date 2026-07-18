<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film'; //esto le dice a laravel el nombre de la tabla que debe buscar
    protected $primaryKey = 'film_id'; //Esto le dice a laravel que debe buscar el id de la tabla film
    public $timestamps = false;

    protected $fillable = [
    'title',
    'description',
    'release_year',
    'language_id',
    'rental_duration',
    'rental_rate',
    'length',
    'replacement_cost',
    'rating',
];
}

