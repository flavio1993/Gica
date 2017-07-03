<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cost;
use App\Neumatic;
use App\Oil;
use App\Combustible;
use App\Machine;
use App\Veconomic;
use App\Price;
use App\Characteristic;
use App\Operator;
use Auth;

class CostController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$maquinarias = Machine::orderBy('machine')->get();
    	return view("costos.index", compact("maquinarias"));
    }

    public function show($value='')
    {

        $tipo_cambio = Characteristic::findOrFail(1);
        $tipo = $tipo_cambio->value;

        if ($value === 'listar') {
            $costs = Cost::join('veconomics', 'costs.cost_id', '=', 'veconomics.cost_id')
            ->join('machines', 'costs.machine_id', '=', 'machines.machine_id')
            ->join('oils', 'costs.cost_id', '=', 'oils.cost_id')
            ->join('combustibles', 'costs.cost_id', '=', 'combustibles.cost_id')
            ->join('neumatics', 'costs.cost_id', '=', 'neumatics.cost_id')
            ->select('costs.cost_id','machines.code','machines.machine','machines.potencia','machines.capacidad', 'machines.peso')->where('costs.user_id',Auth::user()->id)->get();

            return view("costos.listar", compact('costs','tipo'));
        }else{

            $exite = Cost::where('cost_id',$value)->where('user_id',Auth::user()->id)->count();
            if ($exite === 1) {

                $cost = Cost::join('veconomics', 'costs.cost_id', '=', 'veconomics.cost_id')
                ->join('machines', 'costs.machine_id', '=', 'machines.machine_id')
                ->join('oils', 'costs.cost_id', '=', 'oils.cost_id')
                ->join('combustibles', 'costs.cost_id', '=', 'combustibles.cost_id')
                ->join('neumatics', 'costs.cost_id', '=', 'neumatics.cost_id')
                ->join('types','machines.type_id','=','types.type_id')
                ->join('operators','types.type_id','=','operators.type_id')
                ->select('costs.cost_id','machines.code','machines.machine','machines.potencia','machines.image','machines.capacidad', 'machines.peso','veconomics.vida_anios','machines.type_id','veconomics.vida_horas','costs.mr', 'combustibles.tipo_combustible', 'combustibles.value as comb_value', 'oils.aceitem','oils.aceiteh','oils.aceitet','oils.grasa','neumatics.vida_util','neumatics.precio','neumatics.unit_id as unidad_neum','costs.value_machine', 'costs.unit_id as costs_unidades','costs.coef_rescate','types.description','operators.value')->where('costs.cost_id',$value)->get();

                return view("costos.detalles", compact("cost",'tipo'));
            }else{
                return view('errors.503');
            }
        }
         
    	
    	
    }


    public function store(Request $request)
    {

    	
    	$this->validate($request, 
    		[
    			'c_maquinaria' => 'required',
    			'c_valor_maq' => 'required|numeric',
    			'c_unid_valor_maq' => 'required',
    			'c_ve_anios' => 'required|numeric',
    			'c_ve_horas' => 'required|numeric',
    			'c_mr' => 'required',
    			'c_comb' => 'required',
    			'c_tipo_comb' => 'required',
    			'c_ace_m' => 'required|numeric',
    			'c_ace_h' => 'required|numeric',
    			'c_ace_t' => 'required|numeric',
    			'c_grasa' => 'required|numeric',
    			'c_vu_neum' => 'required|numeric',
    			'c_precio_neum' => 'required|numeric',
    			'c_unid_precio_neum'=> 'required',
    			'c_coef_rescate' => 'required|numeric',
    			'c_condiciones'=> 'required',
    		],
    		[
	    		'c_maquinaria.required' => 'Seleccione la máquinaria',
    			'c_valor_maq.required' => 'Introduzaca el valor de la máquinaria',
    			'c_valor_maq.numeric' => 'El valor de la maquinaria es una magnitud numerica',
    			'c_unid_valor_maq.required' => 'required',
    			'c_ve_anios.required' => 'Ingrese la vida económica en años',
    			'c_ve_anios.numeric' => 'La vida económica en años es una magnitud numerica',
    			'c_ve_horas.required' => 'Ingrese la vida económica en horas/año',
    			'c_ve_horas.numeric' => 'La vida económica en horas/año es una magnitud numerica',
    			'c_mr.required' => 'Ingrese el MR %',
    			'c_comb.required' => 'Ingrese el rendimiento del combustible',
    			'c_tipo_comb.required' => 'Seleccione el tipo del combustible',
    			'c_ace_m.required' => 'Ingrese el consumo de aceite (Motor) gl/hr',
    			'c_ace_m.numeric' => 'El consumo de aceite (Motor) gl/hrm es una magnitud numerica',
    			'c_ace_h.required' => 'Ingrese el consumo de aceite (Hidraúlico) gl/hr',
    			'c_ace_h.numeric' => 'El consumo de aceite (Hidraúlico) gl/hrm es una magnitud numerica',
    			'c_ace_t.required' => 'Ingrese el consumo de aceite (Transmisión) gl/hr',
    			'c_ace_t.numeric' => 'El consumo de aceite (Transmisión) gl/hrm es una magnitud numerica',
    			'c_grasa.required' => 'Ingrese el consumo de grasa lib/hr',
    			'c_grasa.numeric' => 'El consumo de grasa lib/hr es una magnitud numerica',
    			'c_vu_neum.required' => 'Ingrese la vida útil del neumático en horas',
    			'c_precio_neum.required' => 'Ingrese el precio del neumático',
    			'c_coef_rescate.required' => 'Ingrese el coeficiente de rescate %',
    			'c_condiciones.required' => 'Seleccione las condiciones del análisis',
    		]
    	);
    	
    	

    	$costo = new Cost;
    	$costo->machine_id = $request->c_maquinaria;
    	$costo->mr = $request->c_mr;
    	$costo->value_machine = $request->c_valor_maq;
    	$costo->unit_id = $request->c_unid_valor_maq;
        $costo->coef_rescate = $request->c_coef_rescate;
        $costo->user_id =Auth::user()->id;
    	$costo->save();
    	

    	//$cost_id = Cost::count();

    	$ultimo = Cost::all('cost_id')->last();
    	$cost_id = $ultimo['cost_id'];
    	//dd($cost_id);

    	

    	$combustible = new Combustible;
    	$combustible->cost_id = $cost_id;
    	$combustible->condition_id = $request->c_condiciones;
    	$combustible->tipo_combustible = $request->c_tipo_comb;
    	$combustible->value = $request->c_comb;
    	$combustible->save();

    	$neumatico = new Neumatic;
    	$neumatico->cost_id = $cost_id;
    	$neumatico->vida_util = $request->c_vu_neum;
    	$neumatico->condition_id = $request->c_condiciones;
    	$neumatico->precio = $request->c_precio_neum;
    	$neumatico->unit_id = $request->c_unid_precio_neum;
    	$neumatico->save();


    	$aceite = new Oil;
    	$aceite->cost_id = $cost_id;
    	$aceite->aceitem = $request->c_ace_m;
    	$aceite->aceiteh = $request->c_ace_h;
    	$aceite->aceitet = $request->c_ace_t;
    	$aceite->grasa = $request->c_grasa;
    	$aceite->save();
    	

    	$veconomic = new Veconomic;
    	$veconomic->cost_id = $cost_id;
    	$veconomic->vida_anios = $request->c_ve_anios;
    	$veconomic->vida_horas = $request->c_ve_horas;
    	$veconomic->save();


        $request->session()->flash('success', 'El registro de la maquinaría a analizar se realizó correctamente!');
    	return redirect()->back();

        //$maquinarias = Machine::all();
        //return view("costos.index", compact("maquinarias"));
       
    }
}
