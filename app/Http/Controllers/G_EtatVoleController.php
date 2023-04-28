<?php

namespace App\Http\Controllers;
use App\Models\Compagnies;

use App\Models\gestion_Allotement;
use Illuminate\Http\Request;

class G_EtatVoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    
         return view('gestion_Etat/create_Etat_perode');
      
    }
    public function list_Allotement (Request $request)
    {    
        $start_date=$request->input('start_date');
        $end_date=$request->input('end_date');
        $compagnie=$request->input('compagnies');
        $numroVol=$request->input('num_vol');
    
        $liste_allotemet = gestion_Allotement::select('gestion__allotement.*')
        ->join('gestion_vole__deeparts', 'gestion__allotement.id', '=', 'gestion_vole__deeparts.FK_allotement')
        ->where('gestion__allotement.deleted_at', '=', NULL)
        ->whereBetween('gestion_vole__deeparts.date_depart', [ $start_date,  $end_date])
        ->where('gestion__allotement.FK_compagnie','=', $compagnie)
        ->where('gestion_vole__deeparts.num_vol', $numroVol)
        ->get();
        
        return response()->json([
            'liste_allotemet'=>$liste_allotemet,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    public function liste_compagnies()
    {
        $Liste_Compagnies = Compagnies::select('Compagnies.*')
        ->where('Compagnies.deleted_at', '=', NULL)
        ->orderBy("id", "desc")
        ->get(); 
       
        return response()->json([
            'Liste_Compagnies'=> $Liste_Compagnies,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
