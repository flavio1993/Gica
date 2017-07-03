<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $tabla= 'prices';

    protected $primaryKey = 'price_id';

    public $timestamps=false;

    protected $fillable=[
    	'price_id',
    	'description',
    	'value'
    ];

    protected $guarded=[

    ];
}
