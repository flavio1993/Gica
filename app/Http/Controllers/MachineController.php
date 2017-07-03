<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Machine;

class MachineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	
    	return view("maquinaria.index");
        //return response()->json(['maquinarias'=>$maquinarias]);

    }


    public function store(Request $request)
    {
        
    	$this->validate($request, [
    		'code' => 'required',
    		'machine' => 'required',
    		'potencia' => 'required|numeric',
    		'capacidad' => 'required|numeric',
    		'peso' => 'required|numeric',
    		'type_id' => 'required',
    		],
    		[
                'code.required' => 'El Código es obligatorio y único',
                'machine.required' => 'Describa la maquinaría',
                'potencia.required' => 'Especifique la potencia de la maquinaría',
                'potencia.numeric' => 'La potencia es una magnitud numerica',
                'capacidad.required' => 'Especifique la capacidad de la maquinaría',
                'capacidad.numeric' => 'La capacidad es una magnitud numerica',
                'peso.required' => 'Especifique el peso de la maquinaría',
                'peso.numeric' => 'El peso es una magnitud numerica',
                'type_id.required' => 'Seleccione le tipo de la maquinaría',
            ]
    	);
    
    
        if ($request->ajax()) {
            Machine::create($request->all());
            return response()->json([
                "mensaje"=>"Datos Generales Registrados Correctamente"
            ]);        
        }   
        
        
    }

    public function show($value='')
    {
        # code...
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'code' => 'required',
            'machine' => 'required',
            'potencia' => 'required|numeric',
            'capacidad' => 'required|numeric',
            'peso' => 'required|numeric',
            'type_id' => 'required',
            ],
            [
                'code.required' => 'El Código es obligatorio y único',
                'machine.required' => 'Describa la maquinaría',
                'potencia.required' => 'Especifique la potencia de la maquinaría',
                'potencia.numeric' => 'La potencia es una magnitud numerica',
                'capacidad.required' => 'Especifique la capacidad de la maquinaría',
                'capacidad.numeric' => 'La capacidad es una magnitud numerica',
                'peso.required' => 'Especifique el peso de la maquinaría',
                'peso.numeric' => 'El peso es una magnitud numerica',
                'type_id.required' => 'Seleccione le tipo de la maquinaría',
            ]
        );


        $machine = Machine::findOrFail($id);
        $machine->fill($request->all());
        $machine->save();

        return response()->json([
                "mensaje"=>"Datos Generales editados correctamente"
            ]); 


    }

    public function listar($value='')
    {
        $maquinarias = Machine::join('types','machines.type_id','=','types.type_id')
        ->select('machines.machine_id', 'machines.code','machines.machine','machines.potencia','machines.capacidad','machines.peso','machines.type_id','types.description')->get();
        //return view("maquinaria.index",compact('maquinarias'));
        return response()->json(['maquinarias'=>$maquinarias]);
    }
}