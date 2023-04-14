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
use App\Models\gestion_vole_retour;
use App\Models\gestion_programmes;
use Illuminate\Support\Facades\Validator;

class Gestion_AllotementController extends Controller
{
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
            ->where('gestion__allotement.id', $request->id)->get();
        $liste_programmes = gestion_programmes::where('gestion__programmes.deleted_at', '=', NULL)
            ->orderBy("id", "desc")->get();

        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_allotement/create_allotement', [
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
    public function select_liste_allotemet(Request $request)
    {
      
        $liste_allotemet = gestion_Allotement::select('gestion__allotement.*', 'compagnies.compagnie')
            ->where('gestion__allotement.deleted_at', '=', NULL)
            ->join('compagnies', 'gestion__allotement.FK_compagnie', '=', 'compagnies.id')
            ->where('gestion__allotement.FK_dossier', $request->id)->get();
          
        return response()->json([
            'liste_allotemet1' => $liste_allotemet
        ]);
    }

    public function Allotement_id(Request $request)
    {
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
            ->where('gestion__allotement.id', $request->id)->get();

        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_allotement/create_allotement', [
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
        ]);
    }
    // increment
    public function liste_gestion_allot(Request $request)
    {
        // ref_programme
        // dd( $request->id)
        $liste_gestion_allo = gestion_Allotement::where('gestion__allotement.deleted_at', '=', NULL)
            ->where('gestion__allotement.id', $request->id)
            ->orderBy("id", "desc")->get();
        return response()->json([
            'liste_gestion_allo' => $liste_gestion_allo
        ]);
    }

    // ________________Gestion Vole deprt
    // Store vole depart
    public function store_vole_depart(Request $request)
    {

        // 'num_allot' => 'required',
        // dd($request->num_allot);
        $validator = Validator::make($request->all(), [
            'date_depart_allotement' => 'required',
            'num_vol_depart_allotement' => 'required',
            'parcours_depart_allotement' => 'required',
            'total_accorde_depart_allotement' => 'required',
            'heure_depart_allotement' => 'required',
            'heure_arrivee_depart_allotement' => 'required',
            'prix_Achat_dep' => 'required',
            'prix_vente_dep' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $Ajouter_vole_depat = new gestion_vole_departs();
            $Ajouter_vole_depat->date_depart = $request->input('date_depart_allotement');
            $Ajouter_vole_depat->num_vol = $request->input('num_vol_depart_allotement');
            $Ajouter_vole_depat->FK_parcours = $request->input('parcours_depart_allotement');
            $Ajouter_vole_depat->total_accorde = $request->input('total_accorde_depart_allotement');
            $Ajouter_vole_depat->heure_depart = $request->input('heure_depart_allotement');
            $Ajouter_vole_depat->heure_arrivee = $request->input('heure_arrivee_depart_allotement');
            $Ajouter_vole_depat->prix_Achat_dep = $request->input('prix_Achat_dep');
            $Ajouter_vole_depat->prix_vente_dep = $request->input('prix_vente_dep');
            $Ajouter_vole_depat->FK_allotement =  $request->id_allotement;
            $Ajouter_vole_depat->save();
            return response()->json([
                'status' => 200,
                'message' => 'Ajouté avec succès',
            ]);
        }
    }
    public function indexVoledeapart(Request $request)
    {
        $Gestion_vole_depart = gestion_vole_departs::get();
        return response()->json([
            'jsonlisteVoledepart' => $Gestion_vole_depart
        ]);
    }
    // compagnie
    public function indexcompagnie()
    {
        $Gestion_compagnie = Compagnies::get();
        return response()->json([
            'compagnies' => $Gestion_compagnie
        ]);
    }
    public function specifiVoledeapart(Request $request, $id)
    {
        // dd($id);
        $specifiVoledeapart = gestion_vole_departs::where('FK_allotement', $id)
            // ->join('gestion__allotement', 'gestion_dossier.id', '=', 'gestion__allotement.FK_dossier')
            ->get();
        if ($specifiVoledeapart != null) {
            return response()->json([
                'specifiVoledeapart' => $specifiVoledeapart,
                'status' => 200,
                'message' => 'Vole depart existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Vole depart n\existe pas',
            ]);
        }
    }
    // store vole vole retour
    public function store_vole_retour(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date_vole_retour_allotemet' => 'required',
            'num_vol_retour_allotemet' => 'required',
            'parcours_retour_allotement' => 'required',
            'total_accorde_retour_allotement' => 'required',
            'heure_depart_vol_retour_allot' => 'required',
            'heure_arrivee_vole_retour_allot' => 'required',
            'prix_Achat_retour' => 'required',
            'prix_vente_retour' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $Ajouter_vol_retour = new gestion_vole_retour();
            $Ajouter_vol_retour->date_retour = $request->input('date_vole_retour_allotemet');
            $Ajouter_vol_retour->num_vol = $request->input('num_vol_retour_allotemet');
            $Ajouter_vol_retour->FK_parcours = $request->input('parcours_retour_allotement');
            $Ajouter_vol_retour->total_accorde = $request->input('total_accorde_retour_allotement');
            $Ajouter_vol_retour->heure_depart = $request->input('heure_depart_vol_retour_allot');
            $Ajouter_vol_retour->heure_arrivee = $request->input('heure_arrivee_vole_retour_allot');
            $Ajouter_vol_retour->FK_allotement  =  $request->id_allotement;
            $Ajouter_vol_retour->prix_Achat_retour  = $request->input('prix_Achat_retour');
            $Ajouter_vol_retour->prix_vente_retour  = $request->input('prix_vente_retour');
            $Ajouter_vol_retour->save();
            return response()->json([
                'status' => 200,
                'message' => 'Ajouter Vole retour avec succès',
            ]);
        }
    }
    //liste vole retour
    public function indexVoleRetour(Request $request)
    {
        $Gestion_vole_retour = gestion_vole_retour::get();
        return response()->json([
            'jsonlisteVoleRetour' => $Gestion_vole_retour
        ]);
    }
    // specifique vole retour
    public function specifiVoleretour(Request $request, $id)
    {
        $specifiVoleretour = gestion_vole_retour::where('FK_allotement', $id)->get();
        if ($specifiVoleretour != null) {
            return response()->json([
                'specifiVoleretour' => $specifiVoleretour,
                'status' => 200,
                'message' => 'Vole depart existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Vole depart n\existe pas',
            ]);
        }
    }
    // info vole depart allotement
    public function infosVoleRetourAllot(Request $request, $id)
    {
        $niveaux = gestion_vole_retour::where('FK_allotement', $id)->get();
        if ($niveaux != null) {
            return response()->json([
                'infosVoleRetourAllot' => $niveaux,
                'status' => 200,
                'message' => 'Vole retour existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Vole retour n\existe pas',
            ]);
        }
    }
    //Enregister gestion_Allotement
    public function store(Request $request)
    {

        $Ajouter_allot = new gestion_Allotement();
        $Ajouter_allot->num_allotement = $request->input('num_allot');
        $Ajouter_allot->nom_allotement = $request->input('nom_allot');
        $Ajouter_allot->compagnie = $request->input('compagnie_allot');
        $Ajouter_allot->totale_accorde = $request->input('total_accorde_allot');
        $Ajouter_allot->totale_occupe = $request->input('total_occupe_allot');
        $Ajouter_allot->totale_reliquat = $request->input('reliquat_allot');

        if ($request->input('Ajouter_depat_allotement') == "Ajouter_depat_allotement") {
            $validator = Validator::make($request->all(), [
                'date_depart_allotement' => 'required',
                'num_vol_depart_allotement' => 'required',
                'parcours_depart_allotement' => 'required',
                'total_accorde_depart_allotement' => 'required',
                'heure_depart_allotement' => 'required',
                'heure_arrivee_depart_allotement' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $Ajouter_vole_depat = new gestion_vole_departs();
                $Ajouter_vole_depat->date_depart = $request->input('date_depart_allotement');
                $Ajouter_vole_depat->num_vol = $request->input('num_vol_depart_allotement');
                $Ajouter_vole_depat->FK_parcours = $request->input('parcours_depart_allotement');
                $Ajouter_vole_depat->total_accorde = $request->input('total_accorde_depart_allotement');
                $Ajouter_vole_depat->heure_depart = $request->input('heure_depart_allotement');
                $Ajouter_vole_depat->heure_arrivee = $request->input('heure_arrivee_depart_allotement');
                $Ajouter_vole_depat->save();
                // allotement ajouter FK vole depart :
                $Ajouter_allot->vole_departs_id  = $Ajouter_vole_depat->id;
                return response()->json([
                    'status' => 200,
                    'message' => 'ajouter avec succes',
                ]);
            }
        }
        if ($request->input('ajouter_vol_retour_allot') == "ajouter_vol_retour_allot") {
            $Ajouter_vol_retour = new gestion_vole_retour();
            $Ajouter_vol_retour->date_retour = $request->input('date_vole_retour_allotemet');
            $Ajouter_vol_retour->num_vol = $request->input('num_vol_retour_allotemet');
            $Ajouter_vol_retour->FK_parcours = $request->input('parcours_retour_allotement');
            $Ajouter_vol_retour->total_accorde = $request->input('total_accorde_retour_allotement');
            $Ajouter_vol_retour->heure_depart = $request->input('heure_depart_vol_retour_allot');
            $Ajouter_vol_retour->heure_arrivee = $request->input('heure_arrivee_vole_retour_allot');
            $Ajouter_vol_retour->save();
            $Ajouter_allot->vole_retours_id  = $Ajouter_vol_retour->id;
        }
        $Ajouter_allot->save();
        try {
            return redirect()
                ->back()
                ->with('success', 'Votre demande a été bien envoyée.')
                ->withInput();
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non email_clienter le service IT')
                ->withInput();
        }
    }
    // ------------> gestion vole retour <-----------
    //    delete vole départ
    public function destroy_vole_retour(Request  $request)
    {
        $check = gestion_vole_retour::where('id', $request->id_vole_retour)->first();
        if ($check != null) {
            $niveauurgence = gestion_vole_retour::find($request->id_vole_retour);
            $niveauurgence->delete();
            return response()->json([
                'message' => 'Suppression avec succès',
            ]);
        } else {
            return response()->json([
                'errors' => 'Suppression avec Error',
            ]);
        }
    }
    // info update
    public function infos_vole_retour(Request $request)
    {
        $niveaux = gestion_vole_retour::where('id', $request->id)->first();
        return response()->json([
            'info_vole_retour' => $niveaux

        ]);
    }
    // permet de modifier vole retour
    public function update_vole_retour(Request $request)
    {
        try {
            $Vole_retour_update = gestion_vole_retour::where('id', $request->id_vole_retour_up)->first();

            $Vole_retour_update->date_retour = $request->date_vole_retour_allotemet_up;
            $Vole_retour_update->num_vol = $request->num_vol_retour_allotemet_up;
            $Vole_retour_update->FK_parcours = $request->parcours_retour_allotement_up;
            $Vole_retour_update->total_accorde = $request->total_accorde_retour_allotement_up;
            $Vole_retour_update->heure_depart = $request->heure_depart_vol_retour_allot_up;
            $Vole_retour_update->heure_arrivee = $request->heure_arrivee_vole_retour_allot_up;
            $Vole_retour_update->save();
            return response()->json([
                'message' => 'Modification avec succès',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Merci de vérifier la connexion internet, si non email_clienter le service IT',
            ]);
            // return redirect()
            //     ->back()
            //     ->with('danger', 'Merci de vérifier la connexion internet, si non email_clienter le service IT')
            //     ->withInput();
        }
    }
    // ________________depart__________________________
    //    delete vole départ
    public function destroy_vole_depart(Request  $request)
    {
        $check = gestion_vole_departs::where('id', $request->_id_vole_depart)->first();
        if ($check != null) {
            $niveauurgence = gestion_vole_departs::find($request->_id_vole_depart);
            $niveauurgence->delete();
            return response()->json([
                'status' => 200,
                'message' => 'La suppression avec succès',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => '',
            ]);
        }
    }
    // info update depart
    public function infos_vole_depart(Request $request, $id)
    {
        $niveaux = gestion_vole_departs::where('id', $id)->first();
        return response()->json([
            'info_vole_depart' => $niveaux
        ]);
    }
    // info vole depart allotement
    public function infosVoleDepartAllot(Request $request, $id)
    {
        $niveaux = gestion_vole_departs::where('FK_allotement', $id)->get();
        if ($niveaux != null) {
            return response()->json([
                'infosVoleDepartAllot' => $niveaux,
                'status' => 200,
                'message' => 'Vole départ existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Vole départ n\existe pas',
            ]);
        }
    }
    // permet de modifier vole retour
    public function update_vole_depart(Request $request)
    {
        try {
            $Vole_client_update = gestion_vole_departs::where('id', $request->id_vole_depart_up)->first();
            $Vole_client_update->date_depart = $request->vole_depart_allotemet_Dt_depart;
            $Vole_client_update->num_vol = $request->num_vol_depart_allotemet_up;
            $Vole_client_update->FK_parcours = $request->parcours_vol_depart_allotement_up;
            $Vole_client_update->total_accorde = $request->total_accorde_vol_depart_allot_up;
            $Vole_client_update->heure_depart = $request->heure_depart_vol_retour_allot_up;
            $Vole_client_update->heure_arrivee = $request->heure_arrivee_vole_depart_allot_up;
            $Vole_client_update->save();
            return response()->json([
                'status' => 200,
                'message' => 'La modification avec succès de vole départ',
            ]);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    // ----------------**Gestion allotement
    //Ajouter allotement
    public function store_allotement(Request $request)
    {

        // if (!empty($update_allotement)) {
        // dd("ok");
        // try {
        //     $update_allotement->num_allotement = $request->input('num_allot');
        //     $update_allotement->nom_allotement = $request->input('nom_allot');
        //     $update_allotement->compagnie = $request->input('compagnie_allot');
        //     $update_allotement->totale_accorde = $request->input('total_accorde_allot');
        //     $update_allotement->totale_occupe = $request->input('total_occupe_allot');
        //     $update_allotement->totale_reliquat = $request->input('reliquat_allot');
        //     $update_allotement->save();
        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'La modification avec succès',
        //     ]);
        // } catch (\Exception $e) {

        //     return redirect()
        //         ->back()
        //         ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
        //         ->withInput();
        // }
        // }

        $validator = Validator::make($request->all(), [
            'num_allot' => 'required',
            'nom_allot' => 'required',
            'compagnie_allot' => 'required',
            'total_accorde_allot' => 'required',
            'total_occupe_allot' => 'required',
            'reliquat_allot' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            // update allotement
            $value_exi = gestion_Allotement::where('num_allotement', $request->input('num_allot'))->first();
            if (!empty($value_exi)) {
                try {
                    $update_allotement = new gestion_Allotement();
                    $update_allotement->num_allotement = $request->num_allot;
                    $update_allotement->nom_allotement = $request->nom_allot;
                    $update_allotement->FK_compagnie  = $request->compagnie_allot;
                    $update_allotement->totale_accorde = $request->total_accorde_allot;
                    $update_allotement->totale_occupe = $request->total_occupe_allot;
                    $update_allotement->totale_reliquat = $request->reliquat_allot;
                    $update_allotement->FK_dossier = $request->FK_dossier;
                    $update_allotement->save();

                   
                    $update_gestion_allot = gestion_Allotement::where('num_allotement', $request->input('num_allot'))
                    ->where('FK_dossier', $request->FK_dossier)
                    ->get();

                    return response()->json([
                        'status' => 200,
                        'update_gestion_allot' => $update_gestion_allot,
                        'message' => 'La modification avec succès',
                    ]);
                } catch (\Exception $e) {

                    return redirect()
                        ->back()
                        ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                        ->withInput();
                }
            } else {
                if (empty($value_exi)) {
                    try {
                        $Ajouter_allotement = new gestion_Allotement();
                        $Ajouter_allotement->num_allotement = $request->input('num_allot');
                        $Ajouter_allotement->nom_allotement = $request->input('nom_allot');
                        $Ajouter_allotement->FK_compagnie  = $request->input('compagnie_allot');
                        $Ajouter_allotement->totale_accorde = $request->input('total_accorde_allot');
                        $Ajouter_allotement->totale_occupe = $request->input('total_occupe_allot');
                        $Ajouter_allotement->totale_reliquat = $request->input('reliquat_allot');
                        $Ajouter_allotement->FK_dossier = $request->FK_dossier;
                        $Ajouter_allotement->save();

                        $update_gestion_allot = gestion_Allotement::where('num_allotement', $request->input('num_allot'))
                            ->where('FK_dossier', $request->FK_dossier)
                            ->get();
                        // dd($test);

                        return response()->json([
                            'status' => 200,
                            'update_gestion_allot' => $update_gestion_allot,
                            'message' => 'Ajouter Allotement avec succès',
                        ]);
                    } catch (\Exception $e) {

                        return redirect()
                            ->back()
                            ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                            ->withInput();
                    }
                }
            }
        }
    }
    // update allotement
    public function update_allotement(Request $request)
    {
        try {
            $Allotement_update = gestion_Allotement::where('id', $request->id_Allotement)->first();
            $Allotement_update->nom_allotement = $request->nom_allot_up;
            $Allotement_update->totale_accorde = $request->total_accorde_allot_up;
            $Allotement_update->totale_occupe = $request->total_occupe_allot_up;
            $Allotement_update->totale_reliquat = $request->reliquat_allot_up;
            $Allotement_update->FK_compagnie  = $request->compagnie_allot_up;
            $Allotement_update->save();
            return response()->json([
                'status' => 200,
                'message' => 'La modification avec succès.',
            ]);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    // delete allotement
    public function destroy_allotement(Request $request)
    {

        $check = gestion_Allotement::where('id', $request->delet_id_allot)->first();
        if ($check != null) {
            $niveauurgence = gestion_Allotement::find($request->delet_id_allot);
            $niveauurgence->delete();
            return response()->json([
                'message' => 'Suppression avec succès',
            ]);
        } else {
            return response()->json([
                'errors' => 'Suppression avec Error',
            ]);
        }
    }
    // info vole  allotement
    public function infos_allotement(Request $request, $id)
    {
        $niveaux = gestion_Allotement::where('id', $id)->get();
        if ($niveaux != null) {
            return response()->json([
                'infosAllot' => $niveaux,
                'status' => 200,
                'message' => 'Allotement existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Allotement n\existe pas',
            ]);
        }
    }
}
