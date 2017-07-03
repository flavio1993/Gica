<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $tabla= 'characteristics';

    protected $primaryKey = 'characteristic_id';

    public $timestamps=false;

    protected $fillable=[
    	'characteristic_id',
    	'description',
    	'value'
    ];

    protected $guarded=[

    ];
}
