<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $tabla= 'machines';

    protected $primaryKey = 'machine_id';

    public $timestamps=false;

    protected $fillable=[
    	'machine_id',
    	'code',
    	'machine',
    	'potencia',
    	'capacidad',
    	'peso',
    	'type_id'

    ];

    protected $guarded=[

    ];
}
