<?php

namespace App\Http\Controllers;
use App\Models\gestion_Allotement;
use App\Models\datail_hotel_programmes;
use App\Models\Gestion_detail_fiches_inscriptions;
use App\Models\Compagnies;
use Illuminate\Http\Request;

class G_EtalhotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestion_Etat/create_Etat_hotel');
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
    public function liste_hotel()
    {
        $Liste_Hotel = datail_hotel_programmes::select('gestion_datail_hotel_programmes.hotel_prg')
        
        ->where('gestion_datail_hotel_programmes.deleted_at', '=', NULL)
    
        ->groupBy('gestion_datail_hotel_programmes.hotel_prg')->get(); 

        return response()->json([
            'Liste_Hotel'=> $Liste_Hotel,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    
    }
   
    public function list_Allotement (Request $request)
    {
        $start_date=$request->input('start_date');
        $end_date=$request->input('end_date');
    
        $hotel=$request->input('hotel');
    
        $liste_detail_hotel = Gestion_detail_fiches_inscriptions::select('gestion_datail_hotel_programmes.type_chambre_prg','gestion_detail_fiches_inscriptions.*')
        ->join('gestion__programmes', 'gestion_detail_fiches_inscriptions.FK_programme', '=', 'gestion__programmes.id')
        ->join('gestion_datail_hotel_programmes', 'gestion__programmes.id', '=', 'gestion_datail_hotel_programmes.FK_programme')
        ->join('gestion_vole__deeparts', 'gestion__programmes.FK_Num_vole_depart', '=', 'gestion_vole__deeparts.id')
         ->where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
         ->whereBetween('gestion_vole__deeparts.date_depart', [$start_date, $end_date])
        //  ->where('gestion_datail_hotel_programmes.hotel_prg', $hotel)
        //  ->distinct('gestion_detail_fiches_inscriptions.id')
        ->get();
        return response()->json([
            'liste_detail_hotel'=>$liste_detail_hotel,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
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
