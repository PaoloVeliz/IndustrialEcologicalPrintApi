<?php

namespace App\Http\Controllers;

use App\Models\PetroleumDerivates;
use App\Models\ElectricalEnergy;
use Illuminate\Http\Request;
use ElectricalEnergyController;
use Carbon\Carbon;
class PetroleumDerivatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PetroleumDerivates::get();    
    }

    public function anualCombustible($year){
        $admin_result = PetroleumDerivates::whereYear('date',$year)->where([["responsable_team","administrativo"],["name","combustible"]])->sum('amount') ;
        $logistic_result = PetroleumDerivates::whereYear('date',$year)->where([["responsable_team","logistico"],["name","combustible"]])->sum('amount');
        $operational_result = PetroleumDerivates::whereYear('date',$year)->where([["responsable_team","operacion"],["name","combustible"]])->sum('amount');
        $total = $admin_result + $logistic_result + $operational_result;
        return ["data"=>
        [
            "administrativo"=>round(($admin_result/$total)*100,2),
            "logistico"=>round(($logistic_result/$total)*100,2),
            "operacion"=>round(($operational_result/$total)*100,2),
            
        ]];
    }
    public function monthCombustible($month){
        $admin_result = PetroleumDerivates::whereMonth('date',$month)->where([["responsable_team","administrativo"],["name","combustible"]])->avg('amount');
        $logistic_result = PetroleumDerivates::whereMonth('date',$month)->where([["responsable_team","logistico"],["name","combustible"]])->avg('amount');
        $operational_result = PetroleumDerivates::whereMonth('date',$month)->where([["responsable_team","operacion"],["name","combustible"]])->avg('amount');
        return ["data"=>
        [
            "administrativo"=>$admin_result,
            "logistico"=>$logistic_result,
            "operacion"=>$operational_result,
        
        ]];
    }

    public function ratedConsumer()
    {
        $admin_result = PetroleumDerivates::where([["responsable_team","administrativo"],["name","combustible"]])->sum('amount') ;
        $logistic_result = PetroleumDerivates::where([["responsable_team","logistico"],["name","combustible"]])->sum('amount');
        $operational_result = PetroleumDerivates::where([["responsable_team","operacion"],["name","combustible"]])->sum('amount');
        
        
        $total = $admin_result + $logistic_result + $operational_result;
        if ($admin_result > $logistic_result and $admin_result > $operational_result){
            return ["data"=>"administrativo"]; 
        }
        if ($logistic_result > $admin_result and $logistic_result > $operational_result){
            return ["data"=>"logistico"]; 
        }
        if ($operational_result > $admin_result and  $operational_result > $logistic_result){
            return ["data"=>"operacion"]; 
        }
    }

    public function petrolDerivates($month){
        $combustible_result = PetroleumDerivates::whereMonth('date',$month)->where("name","combustible")->sum('amount');
        $oil_result = PetroleumDerivates::whereMonth('date',$month)->where("name","aceite")->sum('amount');
        $other_result = PetroleumDerivates::whereMonth('date',$month)->whereNotIn("name",["aceite","combustible"])->sum('amount');
        
        
        $total = $combustible_result + $oil_result + $other_result;
        return ["data"=>
        [
            "combustible"=>round(($combustible_result/$total)*100,2),
            "aceite"=>round(($oil_result/$total)*100,2),
            "otros"=>round(($other_result/$total)*100,2)     
        ]];
    }

    public function oilData($month) {
        $admin_result = PetroleumDerivates::whereMonth('date',$month)->where([["responsable_team","administrativo"],["name","aceite"]])->sum('amount');
        $logistic_result = PetroleumDerivates::whereMonth('date',$month)->where([["responsable_team","logistico"],["name","aceite"]])->sum('amount');
        $operational_result = PetroleumDerivates::whereMonth('date',$month)->where([["responsable_team","operacion"],["name","aceite"]])->sum('amount');
        return ["data"=>
        [
            "administrativo"=>$admin_result,
            "logistico"=>$logistic_result,
            "operacion"=>$operational_result,
        
        ]];
    }

    public function lessRefrigerant($month) {
        $data = PetroleumDerivates::where("name","refrigerante")->orderBy('date','ASC')->get()[0];
        return Carbon::parse($data->date)->format('M');
    }
    public function moreVsLessCombustible() {
        $lessMonth = PetroleumDerivates::where("name","combustible")->orderBy('date','ASC')->get()[0];
        $moreMonth = PetroleumDerivates::where("name","combustible")->orderBy('date','DESC')->get()[0];
        return ["data"=>
        [
            "menos_gasto"=>Carbon::parse($lessMonth->date)->format('M'),
            "mas_gasto"=>Carbon::parse($moreMonth->date)->format('M'),
        ]];
    }


    public function electricalVsCombustible($month){
        $admin_result_com = PetroleumDerivates::whereMonth('date',$month)->where("responsable_team","administrativo")->where("name","combustible")->sum('amount') ;
        
        $logistic_result_com = PetroleumDerivates::whereMonth('date',$month)->where("responsable_team","logistico")->where("name","combustible")->sum('amount');
       
        $operational_result_com = PetroleumDerivates::whereMonth('date',$month)->where("responsable_team","operacion")->where("name","combustible")->sum('amount');
        $total_com = $admin_result_com + $logistic_result_com + $operational_result_com;
        $admin_result_ene = ElectricalEnergy::whereMonth('date',$month)->where("responsable_team","administrativo")->sum('amount') ;
        $logistic_result_ene = ElectricalEnergy::whereMonth('date',$month)->where("responsable_team","logistico")->sum('amount');
        $operational_result_ene = ElectricalEnergy::whereMonth('date',$month)->where("responsable_team","operacion")->sum('amount');
        $total_ene = $admin_result_ene + $logistic_result_ene + $operational_result_ene;
        
        return ["data"=>
        [
            "administrativo"=>[
                "combustible"=>round(($admin_result_com/$total_com)*100,2),
                "electricidad"=>round(($admin_result_ene/$total_ene)*100,2),
            ],
            "logistico"=>[
                "combustible"=>round(($logistic_result_com/$total_com)*100,2),
                "electricidad"=>round(($logistic_result_ene/$total_ene)*100,2),
            ],
            "operacion"=>[
                "combustible"=>round(($operational_result_com/$total_com)*100,2),
                "electricidad"=>round(($operational_result_ene/$total_ene)*100,2),
            ],
        ]];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $petroleumDerivates = new PetroleumDerivates();
        $petroleumDerivates->create($request->all());
        if ($petroleumDerivates) {
            return "data saved successfully";
        }else {
            return "something gone wrong";
        }
    }

    public function storeOil(Request $request) {
        $data = new PetroleumDerivates($request->all());
        $petroleumDerivates = new PetroleumDerivates();
        $data->name = "aceite";
        $petroleumDerivates->create($data->toArray());
        if ($petroleumDerivates) {
            return "data saved successfully";
        }else {
            return "something gone wrong";
        }
    }

    public function storeCombustible(Request $request){
        $data = new PetroleumDerivates($request->all());
        $petroleumDerivates = new PetroleumDerivates();
        $data->name = "combustible";
        $petroleumDerivates->create($data->toArray());
        if ($petroleumDerivates) {
            return "data saved successfully";
        }else {
            return "something gone wrong";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PetroleumDerivates $petroleumDerivates)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PetroleumDerivates $petroleumDerivates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // return PetroleumDerivates::get();

        $petroleumDerivates = PetroleumDerivates::find($request->id);
        // return response()->json($petroleumDerivates);
        $data = $petroleumDerivates;
        $data->amount = $request->amount;
        $petroleumDerivates->update($data->toArray());
        if ($petroleumDerivates) {
            return "data updated successfully";
        }else {
            return "something gone wrong";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PetroleumDerivates $petroleumDerivates)
    {
        //
    }
}
