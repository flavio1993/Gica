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
use App\Pmachine;
use Auth;

class PruebaController extends Controller
{
    public function index($value='')
    {

        $tipo_cambio = Characteristic::findOrFail(1);
        echo $tipo_cambio->value;

    	//$ultimo = Cost::all('cost_id')->last();
    	//echo $ultimo['cost_id'];
    	//$costs = Cost::all();
        /*
    	$cost = Cost::join('veconomics', 'costs.cost_id', '=', 'veconomics.cost_id')
            ->join('machines', 'costs.machine_id', '=', 'machines.machine_id')
            ->join('oils', 'costs.cost_id', '=', 'oils.cost_id')
            ->join('combustibles', 'costs.cost_id', '=', 'combustibles.cost_id')
            ->join('neumatics', 'costs.cost_id', '=', 'neumatics.cost_id')
            ->join('types','machines.type_id','=','types.type_id')
            ->join('operators','types.type_id','=','operators.type_id')
            ->select('costs.cost_id','machines.code','machines.machine','machines.potencia','machines.capacidad', 'machines.peso','veconomics.vida_anios','machines.type_id','veconomics.vida_horas','costs.mr', 'combustibles.tipo_combustible', 'combustibles.value as comb_value', 'oils.aceitem','oils.aceiteh','oils.aceitet','oils.grasa','neumatics.vida_util','neumatics.precio','neumatics.unit_id as unid_neumaticos','costs.value_machine', 'costs.unit_id as costs_unidades','costs.coef_rescate','types.description','operators.value')->where('costs.cost_id',7)->get();

         $prices = Price::all();  
         $caracteristicas = Characteristic::all();  
         $operador = Operator::join('types', 'operators.type_id', '=', 'types.type_id')
            ->select('types.description','operators.value')->get();
               
    	//echo $cost[0]['cost_id'];
    	//echo $prices[0]['value'];

  



    	$tipo_cambio =  $caracteristicas[0]['value'];
    	$interes =  $caracteristicas[1]['value'];
    	$seguro =  $caracteristicas[2]['value'];
    	$igv =  $caracteristicas[3]['value'];

    	$precio_comb =  $prices[0]['value'];
    	$precio_aceitem= $prices[1]['value'];
    	$precio_aceiteh= $prices[2]['value'];
    	$precio_aceitet= $prices[3]['value'];
    	$precio_grasa= $prices[4]['value'];





    	if($cost[0]['costs_unidades']===1)
    		$valor_maq_nacional = $cost[0]['value_machine']/$tipo_cambio;
    	else
    		$valor_maq_nacional = $cost[0]['value_machine'];
    	$igv_maquinaria = ($igv*$valor_maq_nacional)/100;
    	$valor_adquisicion = $valor_maq_nacional+$igv_maquinaria;
    	$valor_rescate = ( $cost[0]['coef_rescate']*$valor_adquisicion)/100;





    	$comb = $cost[0]['comb_value']*$precio_comb;
    	$acem = $cost[0]['aceitem']*$precio_aceitem;
    	$aceh = $cost[0]['aceiteh']*$precio_aceiteh;
    	$acet = $cost[0]['aceitet']*$precio_aceitet;
    	$gras = $cost[0]['grasa']*$precio_grasa;

    	$total_com_lub = $comb+$acem+$aceh+$acet;
    	$filtros = 0.2*$total_com_lub;


    	if($cost[0]['unid_neumaticos']===1)
    		$valor_neuma = $cost[0]['value_machine']/$tipo_cambio;
    	else
    		$valor_neuma = $cost[0]['value_machine'];

    	$neumaticos = $valor_neuma/$cost[0]['vida_util'];


    	$ve_horas_total = $cost[0]['vida_anios']*$cost[0]['vida_horas'];

    	$costo_hh = $cost[0]['value'];

    	$costo_mantenimiento = ($cost[0]['mr']*$valor_adquisicion)/100;
    	$costo_mano_obra = (0.25*($costo_mantenimiento))/$ve_horas_total;
    	$costo_repuestos = (0.75*($costo_mantenimiento))/$ve_horas_total;

    	$costo_mano_obra_rep = $costo_mano_obra+$costo_repuestos;

    	





    	//depreciacion
    	$depreciacion_cal = ($valor_adquisicion-$valor_rescate)/$ve_horas_total;
    	$ima = (($valor_adquisicion*($cost[0]['vida_anios']+1))+($valor_rescate*($cost[0]['vida_anios']-1)))/(2*$cost[0]['vida_anios']);

    	//intereses
    	$interes_cal = ($ima*$interes)/($cost[0]['vida_horas']*100);

    	$factor_k = (($cost[0]['vida_anios']*($cost[0]['vida_anios']+1))/(2*$cost[0]['vida_anios']))/$ve_horas_total;

    	//seguros
    	$seguros_cal = ($valor_adquisicion*$seguro*$factor_k)/100;


    	//costo de la maquinaria sin operar
    	$total_sin_operar = $depreciacion_cal+$interes_cal+$seguros_cal;





  
    	echo $costo_mano_obra_rep;
        */
        //echo Auth::user()->id;

        
        /*

        $cost = Cost::join('veconomics', 'costs.cost_id', '=', 'veconomics.cost_id')
            ->join('machines', 'costs.machine_id', '=', 'machines.machine_id')
            ->join('oils', 'costs.cost_id', '=', 'oils.cost_id')
            ->join('combustibles', 'costs.cost_id', '=', 'combustibles.cost_id')
            ->join('neumatics', 'costs.cost_id', '=', 'neumatics.cost_id')
            ->join('types','machines.type_id','=','types.type_id')
            ->join('operators','types.type_id','=','operators.type_id')
            ->select('costs.cost_id','machines.code','machines.machine','machines.potencia','machines.capacidad', 'machines.peso','veconomics.vida_anios','machines.type_id','veconomics.vida_horas','costs.mr', 'combustibles.tipo_combustible', 'combustibles.value as comb_value', 'oils.aceitem','oils.aceiteh','oils.aceitet','oils.grasa','neumatics.vida_util','neumatics.precio','neumatics.unit_id as unid_neumaticos','costs.value_machine', 'costs.unit_id as costs_unidades','costs.coef_rescate','types.description','operators.value')->where('costs.cost_id','9')->get();


        $prices = Price::all();  
        $caracteristicas = Characteristic::all();  
        $operador = Operator::join('types', 'operators.type_id', '=', 'types.type_id')
            ->select('types.description','operators.value')->get();
               
        $tipo_cambio =  $caracteristicas[0]['value'];
        $interes =  $caracteristicas[1]['value'];
        $seguro =  $caracteristicas[2]['value'];
        $igv =  $caracteristicas[3]['value'];

        $precio_comb =  $prices[0]['value'];
        $precio_aceitem= $prices[1]['value'];
        $precio_aceiteh= $prices[2]['value'];
        $precio_aceitet= $prices[3]['value'];
        $precio_grasa= $prices[4]['value'];


        if($cost[0]['costs_unidades']===1)
            $valor_maq_nacional = $cost[0]['value_machine']/$tipo_cambio;
        else
            $valor_maq_nacional = $cost[0]['value_machine'];
        $igv_maquinaria = ($igv*$valor_maq_nacional)/100;
        $valor_adquisicion = $valor_maq_nacional+$igv_maquinaria;
        $valor_rescate = ( $cost[0]['coef_rescate']*$valor_adquisicion)/100;


        $comb = $cost[0]['comb_value']*$precio_comb;
        $acem = $cost[0]['aceitem']*$precio_aceitem;
        $aceh = $cost[0]['aceiteh']*$precio_aceiteh;
        $acet = $cost[0]['aceitet']*$precio_aceitet;
        $gras = $cost[0]['grasa']*$precio_grasa;

        $total_com_lub = $comb+$acem+$aceh+$acet;
        $lubricantes = $acem+$aceh+$acet;
        $filtros = 0.2*$total_com_lub;

        if($cost[0]['unid_neumaticos']===1)
            $valor_neuma = $cost[0]['precio']/$tipo_cambio;
        else
            $valor_neuma = $cost[0]['precio'];

        $neumaticos = $valor_neuma/$cost[0]['vida_util'];

        $ve_horas_total = $cost[0]['vida_anios']*$cost[0]['vida_horas'];

        $costo_hh = $cost[0]['value'];
        $costo_mantenimiento = ($cost[0]['mr']*$valor_adquisicion)/100;
        $costo_mano_obra = (0.25*($costo_mantenimiento))/$ve_horas_total;
        $costo_repuestos = (0.75*($costo_mantenimiento))/$ve_horas_total;

        $costo_mano_obra_rep = $costo_mano_obra+$costo_repuestos;

        $total_operar = $costo_mano_obra_rep+$comb+$filtros+$lubricantes+$gras+$neumaticos+$costo_hh;

        //depreciacion
        $depreciacion_cal = ($valor_adquisicion-$valor_rescate)/$ve_horas_total;
        $ima = (($valor_adquisicion*($cost[0]['vida_anios']+1))+($valor_rescate*($cost[0]['vida_anios']-1)))/(2*$cost[0]['vida_anios']);

        //intereses
        $interes_cal = ($ima*$interes)/($cost[0]['vida_horas']*100);

        $factor_k = (($cost[0]['vida_anios']*($cost[0]['vida_anios']+1))/(2*$cost[0]['vida_anios']))/$ve_horas_total;

        //seguros
        $seguros_cal = ($valor_adquisicion*$seguro*$factor_k)/100;

        //costo de la maquinaria sin operar
        $total_sin_operar = $depreciacion_cal+$interes_cal+$seguros_cal;


        $costo_horario = $total_sin_operar+$total_operar;    

        echo $costo_horario;
        */
    }
}
