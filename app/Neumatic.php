<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neumatic extends Model
{
    protected $tabla= 'neumatics';

    protected $primaryKey = 'neumatic_id';

    public $timestamps=false;

    protected $fillable=[
    	'neumatic_id',
    	'cost_id',
    	'vida_util',
    	'condition_id',
    	'precio',
    	'unit_id'

    ];

    protected $guarded=[

    ];
}
