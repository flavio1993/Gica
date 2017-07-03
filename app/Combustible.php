<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    protected $tabla= 'combustibles';

    protected $primaryKey = 'combustible_id';

    public $timestamps=false;

    protected $fillable=[
    	'combustible_id',
    	'cost_id',
    	'condition_id',
    	'tipo_combustible',
    	'value'

    ];

    protected $guarded=[

    ];
}
