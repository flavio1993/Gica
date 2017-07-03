<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\Characteristic;
use App\Operator;

class MercadoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($value='')
    {
    	return view("maquinaria.mercado");
    }


    public function listarPrecios($value='')
    {
    	$precios = Price::all();

    	return response()->json(array('prices'=> $precios), 200);
    }

    public function listarCaracteristicas($value='')
    {
    	$caracteristicas = Characteristic::all();

    	return response()->json(array('caracteristicas'=> $caracteristicas), 200);
    }


    public function listarOperador($value='')
    {
    	$operador = Operator::join('types', 'operators.type_id', '=', 'types.type_id')
            ->select('types.description','operators.value','operators.operator_id')->get();

    	return response()->json(array('operador'=> $operador), 200);
    }
}
