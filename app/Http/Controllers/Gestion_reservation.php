<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villes;
use App\Models\Compagnies;
use App\Models\gestion_Allotement;
use App\Models\Gestion_parcours;
use App\Models\Gestion_type_programmes;
use App\Models\Hotel_transports;
use App\Models\Gestion_type_chambres;
use App\Models\Gestion_regimes;
use App\Models\Gestion_chambres;
use App\Models\Gestion_itineraires;
use App\Models\gestion_vole_departs;
use App\Models\datail_hotel_programmes;
use App\Models\gestion_programmes;
use App\Models\gestion_dossiers;
use Illuminate\Support\Facades\Validator;

class Gestion_reservation extends Controller
{
    public function index()
    {
        return view('gestion_dossier/liste_reservation');
    }

    public function Liste_Reservation(Request $request)
    {

        $Dossier = gestion_dossiers::where('id', $request->id_dossier)->get();

         $liste_info = gestion_programmes::select('gestion__programmes.*', 'gestion_dossier.*')
            ->join('gestion_dossier', 'gestion__programmes.FK_dossier', '=', 'gestion_dossier.id')
            ->where('gestion__programmes.id', $request->id_prg)
            ->where('gestion__programmes.deleted_at', '=', NULL)
            ->get();
            
        $liste_reservation = gestion_programmes::select('gestion__programmes.*','gestion__programmes.id as id_progrmme_', 'gestion_datail_hotel_programmes.*', 'gestion_datail_hotel_programmes.id as id_detail_hotel_prg')
            ->join('gestion_datail_hotel_programmes', 'gestion__programmes.id', '=', 'gestion_datail_hotel_programmes.FK_programme')
            // ->join('gestion_datail_services_prog', 'gestion__programmes.id', '=', 'gestion_datail_services_prog.FK_programme')
            // ->join('gestion_datail_itineraire_programmes', 'gestion__programmes.id', '=', 'gestion_datail_itineraire_programmes.FK_programme')
            ->where('gestion__programmes.id', $request->id_prg)
            ->where('gestion_datail_hotel_programmes.deleted_at', '=', NULL)
            ->get();
      
        return response()->json([
            'liste_reservation' => $liste_reservation,
            'liste_info' => $liste_info,
            'Dossier' => $Dossier,
        ]);
    }

    public function Add_gender(Request $request)
    {
        // dd($request->value);
        $Ajouter_hotels =  datail_hotel_programmes::where('id', $request->id)->first();

        $Ajouter_hotels->Genre = $request->value;
        $Ajouter_hotels->save();
        return response()->json([
            'status' => 200,
            'message' => 'Ajouter avec succès',
        ]);
    }
}
