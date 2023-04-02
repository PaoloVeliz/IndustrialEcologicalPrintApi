<?php

namespace App\Http\Controllers;

use App\Models\ElectricalEnergy;
use Illuminate\Http\Request;

class ElectricalEnergyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ElectricalEnergy::get();
    }
    public function monthEnergy($month){
        $admin_result = ElectricalEnergy::whereMonth('date',$month)->where("responsable_team","administrativo")->sum('amount') ;
        $logistic_result = ElectricalEnergy::whereMonth('date',$month)->where("responsable_team","logistico")->sum('amount');
        $operational_result = ElectricalEnergy::whereMonth('date',$month)->where("responsable_team","operacion")->sum('amount');
        $total = $admin_result + $logistic_result + $operational_result;
        return ["data"=>
        [
            "administrativo"=>($admin_result/$total)*100,
            "logistico"=>($logistic_result/$total)*100,
            "operacion"=>($operational_result/$total)*100,
        
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
        // $data = new ElectricalEnergy($request->all());
        $electricalEnergy = new ElectricalEnergy();
        $electricalEnergy->create($request->all());
        if ($electricalEnergy) {
            return "data saved successfully";
        }else {
            return "something gone wrong";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectricalEnergy $electricalEnergy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectricalEnergy $electricalEnergy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ElectricalEnergy $electricalEnergy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectricalEnergy $electricalEnergy)
    {
        //
    }
}
