<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $tabla= 'costs';

    protected $primaryKey = 'cost_id';

    public $timestamps=false;

    protected $fillable=[
    	'cost_id',
    	'machine_id',
    	'mr',
    	'value_machine',
    	'unit_id'

    ];

    protected $guarded=[

    ];
}
