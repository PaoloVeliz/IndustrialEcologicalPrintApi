<?php

namespace App\Http\Controllers;

use App\Models\Travels;
use Illuminate\Http\Request;

class TravelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Travel::get();
    }

    public function salesVsAdmin($month){
        $sales_result = Travels::whereMonth('date',$month)->where("team","ventas")->sum('amount');
        $admin_result = Travels::whereMonth('date',$month)->where("team","administrativo")->sum('amount');
        return ["data"=>
        [
            "ventas"=>$admin_result,
            "administracion"=>$admin_result
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
        $travel = new Travels();
        $travel->create($request->all());
        if ($travel) {
            return "data saved successfully";
        }else {
            return "something gone wrong";
        }
    }

    public function storeSale(Request $request)
    {
        $data = new Travels($request->all());
        $travel = new Travels();
        $data->team = "ventas";
        $travel->create($data->toArray());
        if ($travel) {
            return "data saved successfully";
        }else {
            return "something gone wrong";
        }
    }

    
    
    public function storeAdmin(Request $request)
    {
        $data = new Travels($request->all());
        $travels = new Travels();
        $data->team = "administrativo";
        $travels->create($data->toArray());
        if ($travels) {
            return "data saved successfully";
        }else {
            return "something gone wrong";
        }
    }

    
    
    

    /**
     * Display the specified resource.
     */
    public function show(Travels $travels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travels $travels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Travels $travels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travels $travels)
    {
        //
    }
}
