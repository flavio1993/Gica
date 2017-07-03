<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operator;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
		$operador = Operator::where('operator_id',$id)->get();

    	return response()->json(['operador'=>$operador]);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'value' => 'required|numeric'
            ],
            [
                'value.required' => 'El valor es requerido',
                'value.numeric' => 'El valor es numerico',

            ]
        );


        $operador = Operator::findOrFail($id);
        $operador->fill($request->all());
        $operador->save();

        return response()->json([
                "mensaje"=>"Datos editado correctamente"
            ]); 
    }
}
