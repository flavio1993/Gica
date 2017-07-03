<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($id)
    {
    	$price = Price::where('price_id',$id)->get();

    	return response()->json(['price'=>$price]);
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


        $price = Price::findOrFail($id);
        $price->fill($request->all());
        $price->save();

        return response()->json([
                "mensaje"=>"Datos editado correctamente"
            ]); 
    }
}
