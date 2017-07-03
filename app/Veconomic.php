<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veconomic extends Model
{
    protected $tabla= 'veconomics';

    protected $primaryKey = 'veconomic_id';

    public $timestamps=false;

    protected $fillable=[
    	'life_id',
    	'cost_id',
    	'vida_anios',
    	'vida_horas'
    ];

    protected $guarded=[

    ];
}
