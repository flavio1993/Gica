<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oil extends Model
{
    protected $tabla= 'oils';

    protected $primaryKey = 'oil_id';

    public $timestamps=false;

    protected $fillable=[
    	'oil_id',
    	'cost_id',
    	'aceitem',
    	'aceiteh',
    	'aceitet',
    	'grasa'

    ];

    protected $guarded=[

    ];
}
