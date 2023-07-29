<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mojarra
 *
 * @property $id
 * @property $nombre
 * @property $calorias
 * @property $imagen
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Mojarra extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'calorias' => 'required',
		'imagen' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','calorias','imagen'];



}
