<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Characteristic;

class CharacteristicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
    	$characteristic = Characteristic::where('characteristic_id',$id)->get();

    	return response()->json(['characteristic'=>$characteristic]);
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


        $caract = Characteristic::findOrFail($id);
        $caract->fill($request->all());
        $caract->save();

        return response()->json([
            "mensaje"=>"Datos editado correctamente"
            ]); 
    }
}
