<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pmachine extends Model
{
    protected $tabla= 'pmachines';

    protected $primaryKey = 'pmachine_id';

    public $timestamps=false;

    protected $fillable=[
    	'pmachine_id',
    	'cost_id',
    	'machine_id',
    	'capacidad',
    	'tiempo_ciclo',
    	'factor_llenado',
        'eficiencia',
        'densidad_insitu',
        'factor_esponj'
    ];

    protected $guarded=[

    ];
}
