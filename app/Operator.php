<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $tabla= 'operators';

    protected $primaryKey = 'operator_id';

    public $timestamps=false;

    protected $fillable=[
    	'operator_id',
    	'type_id',
    	'value',
    	'unit_id'
    ];

    protected $guarded=[

    ];
}
