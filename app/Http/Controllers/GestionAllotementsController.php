<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Fiche_clientsPostRequest;
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
use App\Models\gestion_vole_retour;
use App\Models\gestion_programmes;
use Illuminate\Support\Facades\Validator;

class GestionAllotementsController extends Controller
{

    //Lister
    public function index(Request $request)
    {

        $page = $request->page ?? 0;

        $villes = Villes::get();
        $Gestion_compagnies = Compagnies::get();
        $Gestion_parcours = Gestion_parcours::get();
        $Gestion_type_programmes = Gestion_type_programmes::get();
        $Hotel_transports = Hotel_transports::get();
        $Hotel_t = Hotel_transports::all();
        $liste_regime = Gestion_regimes::all();
        $liste_type_chambres = Gestion_type_chambres::all();
        $liste_chambres = Gestion_chambres::get();
        $liste_itineraires = Gestion_itineraires::all();

        $Gestion_type_chambres = Gestion_type_chambres::get();
        $Gestion_regimes = Gestion_regimes::get();
        $Gestion_chambres = Gestion_chambres::get();
        $Gestion_itineraires = Gestion_itineraires::get();
        $Gestion_vole_departs = gestion_vole_departs::get();
        $Gestion_vole_retour = gestion_vole_retour::get();
        $liste_allotemet = gestion_Allotement::where('gestion__allotement.deleted_at', '=', NULL)
            ->orderBy("id", "desc")->get();
        $liste_programmes = gestion_programmes::select('gestion__programmes.*','gestion__programmes.id as idprg','gestion_dossier.*','gestion_dossier.nom_dossier as nom_dossier')
        ->join('gestion_dossier', 'gestion__programmes.FK_dossier', '=', 'gestion_dossier.id')
        ->where('gestion__programmes.deleted_at', '=', NULL)
        ->where('gestion__programmes.FK_dossier', $request->id)
        ->orderBy("idprg", "desc")->first();
        // $liste_programmes = gestion_programmes::where('gestion__programmes.deleted_at', '=', NULL)
        //     ->orderBy("id", "desc")->get();
        // dd($liste_programmes->nom_dossier);
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_programme/create_programme', [
            'page' => $page,
            'pagination' => $pagination ?? 20,
            'villes' => $villes,
            'Gestion_compagnies' => $Gestion_compagnies,
            'Gestion_parcours' => $Gestion_parcours,
            'Hotel_t' => $Hotel_t,
            'liste_regimes' => $liste_regime,
            'liste_type_chambres' => $liste_type_chambres,
            'liste_chambres' => $liste_chambres,
            'Gestion_type_programmes' => $Gestion_type_programmes,
            'Hotel_transports' => $Hotel_transports,
            'Gestion_type_chambres' => $Gestion_type_chambres,
            'Gestion_regimes' => $Gestion_regimes,
            'Gestion_chambres' => $Gestion_chambres,
            'Gestion_itineraires' => $Gestion_itineraires,
            'liste_itineraires' => $liste_itineraires,
            'liste_vole_departs' => $Gestion_vole_departs,
            'liste_vole_retour' => $Gestion_vole_retour,
            'liste_allotemet' => $liste_allotemet,
            'liste_programmes' => $liste_programmes,
        ])
            ->with($request->all());
    }
    // increment
    public function liste_prg_FK_dossier(Request $request)
    {

        $liste_gestion_programmes = gestion_programmes::where('gestion__programmes.deleted_at', '=', NULL)
            ->where('gestion__programmes.FK_dossier', $request->id)
            ->orderBy("id", "desc")->get();

        return response()->json([
            'liste_prg_FK_dossier' => $liste_gestion_programmes
        ]);
    }

    
    // test
    public function programmes_info(Request $request)
    {
        $Gestion_compagnies = Compagnies::get();
        $Gestion_parcours = Gestion_parcours::get();
        $villes = Villes::get();
        $Gestion_regimes = Gestion_regimes::get();
        $Hotel_transports = Hotel_transports::get();
        $Gestion_type_chambres = Gestion_type_chambres::get();
        $Gestion_chambres = Gestion_chambres::get();
        $Gestion_itineraires = Gestion_itineraires::get();
        $liste_itineraires = Gestion_itineraires::all();
        $Hotel_t = Hotel_transports::all();
        $liste_regime = Gestion_regimes::all();
        $liste_chambres = Gestion_chambres::get();
        $liste_type_chambres = Gestion_type_chambres::all();

        $liste_programmes = gestion_programmes::where('gestion__programmes.deleted_at', '=', NULL)
            ->where('gestion__programmes.id', $request->id)
            ->orderBy("id", "desc")->get();
        session()->put('session_id_liste_prg',  $request->FK_dossier);
        return view('gestion_programme/create_programme', [
            'Gestion_compagnies' => $Gestion_compagnies,
            'Gestion_parcours' => $Gestion_parcours,
            'villes' => $villes,
            'Gestion_regimes' => $Gestion_regimes,
            'Hotel_transports' => $Hotel_transports,
            'Gestion_chambres' => $Gestion_chambres,
            'Gestion_itineraires' => $Gestion_itineraires,
            'liste_itineraires' => $liste_itineraires,
            'Hotel_t' => $Hotel_t,
            'liste_chambres' => $liste_chambres,
            'liste_type_chambres' => $liste_type_chambres,
            'liste_regimes' => $liste_regime,
            'Gestion_type_chambres' => $Gestion_type_chambres,
            'liste_programmes' => $liste_programmes
        ]);
    }
   
}
