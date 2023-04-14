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
use App\Models\gestion_datail_services_progs;
use App\Models\gestion_datail_itineraire_programmes;
use App\Models\datail_hotel_programmes;
use App\Models\gestion_programmes;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Validator;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Psy\Readline\Hoa\Console;
use Symfony\Contracts\Service\Attribute\Required;

class Gestion_ProgrammeController extends Controller
{
    public function index_hotel()
    {
    }
    // update prg chambre
    public function updat_prg_chamb(Request $request)
    {

        $liste_prg = datail_hotel_programmes::where('id', $request->id)->first();


        $liste_prg->num_chambre = $request->num_chambre;

        $liste_prg->save();

        return response()->json([
            'status' => 200,
            'message' => 'Ajouté avec succès',
        ]);
    }
    // ----------------**Gestion Programme
    //Ajouter Pogramme
    public function store_Programme(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'ref_programme' => 'required',
            // 'nom_programme' => 'required',
            // 'type_programme' => 'required',
            // 'nbr_nuitee_prog_mdina' => 'required',
            // 'nbr_nuitee_prog_maka' => 'required',
            // // 'num_vole_dep' => 'required',
            // 'nbr_place_aller' => 'required',
            // 'nbr_reserver_dep' => 'required',
            // // 'num_vole_retour' => 'required',
            // 'nbr_place_retour' => 'required',
            // 'nbr_reserver_retour' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $Ajouter_programme = new gestion_programmes();
            $Ajouter_programme->ref_programme = $request->input('ref_programme');
            $Ajouter_programme->nom_programme = $request->input('nom_programme');
            $Ajouter_programme->type_programme = $request->input('type_programme');
            $Ajouter_programme->nbr_nuitee_prog_mdina = $request->input('nbr_nuitee_prog_mdina');
            $Ajouter_programme->nbr_nuitee_prog_maka = $request->input('nbr_nuitee_prog_maka');
            $Ajouter_programme->FK_Num_vole_depart  = $request->input('num_vole_dep');
            $Ajouter_programme->Nbr_place_aller = $request->input('nbr_place_aller');
            $Ajouter_programme->Nbr_reserver_depart = $request->input('nbr_reserver_dep');
            $Ajouter_programme->FK_Num_vole_retour   = $request->input('num_vole_retour');
            $Ajouter_programme->Nbr_place_retour = $request->input('nbr_place_retour');
            $Ajouter_programme->Nbr_reserver_retour = $request->input('nbr_reserver_retour');
            $Ajouter_programme->FK_dossier = $request->FK_dossier;
            $Ajouter_programme->save();

            $update_gestion_prg = gestion_programmes::where('ref_programme', $request->input('ref_programme'))
                ->where('FK_dossier', $request->FK_dossier)
                ->get();

            // dd($update_gestion_prg);
            return response()->json([
                'update_gestion_prg' => $update_gestion_prg,
                'status' => 200,
                'message' => 'Ajouter avec succès',
            ]);
        }
    }
    // ----------------**Gestion Programme
    // Ajouter hotel programme
    public function store_hotels(Request $request)
    {

        $nbr_Chambre = $request->input('bnr_chambre');
     

        $validator = Validator::make($request->all(), [
            'ref_Hotels_prog' => 'required',
            'ville_Hotel_prg' => 'required',
            'date_depar_hotel' => 'required',
            'date_retour_hotel' => 'required',
            'hotel_prg' => 'required',
            'bnr_nuits_prg' => 'required',
            'regime_prg' => 'required',
            'type_chambre_prg' => 'required',
            'chambre_prg' => 'required',
            'prix_achat_prg' => 'required',
            'prix_vente_prg' => 'required',
            'prix_prg' => 'required',
            'bnr_chambre' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            for ($i = 1; $i <= $nbr_Chambre; $i++) {
                $Ajouter_hotels = new datail_hotel_programmes();
                $Ajouter_hotels->ref_Hotels_prog = $request->input('ref_Hotels_prog');
                $Ajouter_hotels->ville_Hotel_prg = $request->input('ville_Hotel_prg');
                $Ajouter_hotels->date_depar_hotel = $request->input('date_depar_hotel');
                $Ajouter_hotels->date_retour_hotel = $request->input('date_retour_hotel');
                $Ajouter_hotels->hotel_prg = $request->input('hotel_prg');
                $Ajouter_hotels->bnr_nuits_prg = $request->input('bnr_nuits_prg');
                $Ajouter_hotels->regime_prg = $request->input('regime_prg');
                $Ajouter_hotels->type_chambre_prg = $request->input('type_chambre_prg');
                $Ajouter_hotels->chambre_prg = $request->input('chambre_prg');
                $Ajouter_hotels->prix_achat_prg = $request->input('prix_achat_prg');
                $Ajouter_hotels->prix_vente_prg = $request->input('prix_vente_prg');
                $Ajouter_hotels->prix_prg = $request->input('prix_prg');
                $Ajouter_hotels->FK_programme = $request->input('ref_programme');
                $Ajouter_hotels->bnr_chambre = $request->input('bnr_chambre');
                $Ajouter_hotels->Totale_place = $request->input('Totale_place');
                $Ajouter_hotels->save();
            }

            return response()->json([
                'status' => 200,
                'message' => 'Ajouter avec succès',
            ]);
        }
    }
    //update type chambre in liste 
    public function update_type_chambre(Request $request)
    {
        $update_type_chambre =  datail_hotel_programmes::where('id', $request->id)->first();
        $update_type_chambre->type_chambre_prg = $request->value;
        $update_type_chambre->save();

        return response()->json([
            'status' => 200,
            'message' => 'Ajouter avec succès',
        ]);
    }
    // info prog
    public function infos_hotel_prog($id,$fkdossier)
    {

        // table('users')
        // ->join('posts', 'users.id', '=', 'posts.user_id')
        // ->select('users.name', 'posts.title')
        // ->get();
        // $niveaux = gestion_programmes::join('gestion_datail_hotel_programmes', 'gestion__programmes.id', '=', 'gestion_datail_hotel_programmes.FK_programme')
        //     ->where('gestion__programmes.id', $id)
        //     ->where('gestion__programmes.FK_dossier', $FKprg)
        //     ->get();
        // $info_prg = gestion_programmes::where('FK_dossier', $FKprg)
        //     ->where('id', $id)
        //     ->get();

        // if ($niveaux != null) {
        //     return response()->json([
        //         'liste_programmes' => $niveaux,
        //         'info_prg' => $info_prg,
        //         'status' => 200,
        //         'message' => 'Programme existe',
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => 'Programme n\existe pas',
        //     ]);
        // }
        $niveaux = gestion_programmes::join('gestion_datail_hotel_programmes', 'gestion__programmes.id', '=', 'gestion_datail_hotel_programmes.FK_programme')
            ->where('gestion__programmes.id', $id)
            ->where('gestion__programmes.FK_dossier', $fkdossier)
            ->where('gestion_datail_hotel_programmes.deleted_at', '=', NULL)
            // ->where('gestion__programmes.ref_programme', $ref_prg)
            ->get();
        // $niveaux = datail_hotel_programmes::where('FK_programme', $id)->get();
        if ($niveaux != null) {
            return response()->json([
                'infos_hotel_prog' => $niveaux,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\éxiste pas',
            ]);
        }
    }
    //  info hotel & transport
    public function liste_hotel_transport()
    {
        $niveaux = Hotel_transports::get();
        if ($niveaux != null) {
            return response()->json([
                'liste_hotel_transport' => $niveaux,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\éxiste pas',
            ]);
        }
    }
    //liste hotel transport
    public function Hotel_transports(Request $request)
    {
        $listehotelTransport = Hotel_transports::where('id', $request->id)->first();
        return response()->json([
            'listehotelTransport' => $listehotelTransport
        ]);
    }
    //liste Hotel prg
    public function index_hotel_prg(Request $request)
    {
        $liste_hotel_prg = datail_hotel_programmes::where('gestion_datail_hotel_programmes.deleted_at', '=', NULL)
            ->orderBy("id", "desc")->get();
        return response()->json([
            'liste_hotel_prg' => $liste_hotel_prg
        ]);
    }
    // info update
    public function infos_Hotel(Request $request)
    {
        
        $infos_hotel = datail_hotel_programmes::where('id', $request->id)->first();
       
        return response()->json([
            'infos_hotel' => $infos_hotel
        ]);
    }

    // update hotel
    public function update_hotel(Request $request)
    {
        try {
            $Vole_retour_update = datail_hotel_programmes::where('id', $request->up_id_hotel)->first();
            $Vole_retour_update->ref_Hotels_prog = $request->up_ref_Hotels_prog_;
            $Vole_retour_update->ville_Hotel_prg = $request->up_ville_Hotel_prg_;
            $Vole_retour_update->date_retour_hotel = $request->up_date_retour_hotel_;
            $Vole_retour_update->date_depar_hotel = $request->up_date_depart_hotel_;
            $Vole_retour_update->hotel_prg = $request->up_hotel_prg_;
            $Vole_retour_update->bnr_nuits_prg = $request->up_bnr_nuits_prg_;
            $Vole_retour_update->regime_prg = $request->up_regime_prg_;
            $Vole_retour_update->chambre_prg = $request->up_type_chambre_prg_;
            $Vole_retour_update->type_chambre_prg = $request->up_chambre_prg_;
            $Vole_retour_update->prix_achat_prg = $request->up_prix_achat_prg_;
            $Vole_retour_update->prix_vente_prg = $request->up_prix_vente_prg_;
            $Vole_retour_update->prix_prg = $request->up_prix_prg_;
            $Vole_retour_update->save();

            return response()->json([
                'status' => 200,
                'message' => 'Modification avec succès',
            ]);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    //    delete hotel
    public function destroy_hotel(Request  $request)
    {
        $check = datail_hotel_programmes::where('id', $request->id_delet_hotel)->first();
        if ($check != null) {
            $niveauurgence = datail_hotel_programmes::find($request->id_delet_hotel);
            $niveauurgence->delete();
            return response()->json([
                'status' => 200,
                'message' => 'La suppression avec succès',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Contacter le service IT',
            ]);
        }
    }
    // ********Gestion itineraire
    // Ajouter Itinerair
    public function store_Itinerair(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_retour_Itineraire' => 'required',
            'ville_Itineraire' => 'required',
            'Transport_Itineraire' => 'required',
            'itineraire_programme' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $Ajouter_itineraire = new gestion_datail_itineraire_programmes();
            $Ajouter_itineraire->date_retour_Itineraire = $request->input('date_retour_Itineraire');
            $Ajouter_itineraire->ville_Itineraire = $request->input('ville_Itineraire');
            $Ajouter_itineraire->Transport_Itineraire = $request->input('Transport_Itineraire');
            $Ajouter_itineraire->itineraire_programme = $request->input('itineraire_programme');
            $Ajouter_itineraire->FK_programme = $request->input('ref_programme');
            $Ajouter_itineraire->save();
            return response()->json([
                'status' => 200,
                'message' => 'Ajouter avec succès',
            ]);
        }
    }
    // up info itineraire
    public function up_info_itineraire(Request $request)
    {
        $infos_itineraire = gestion_datail_itineraire_programmes::where('id', $request->id)->first();
        return response()->json([
            'infos_itineraire' => $infos_itineraire
        ]);
    }

    //liste itineraire
    public function index_Itinerair(Request $request)
    {
        $liste_itineraire = gestion_datail_itineraire_programmes::get();
        return response()->json([
            'liste_itineraire' => $liste_itineraire
        ]);
    }
    // update Itinerair
    public function update_Itinerair(Request $request)
    {
        try {
            $Vole_retour_update = gestion_datail_itineraire_programmes::where('id', $request->up_id_Itineraire)->first();
            $Vole_retour_update->date_retour_Itineraire = $request->up_date_retour_Itineraire_;
            $Vole_retour_update->ville_Itineraire = $request->up_ville_Itineraire_;
            $Vole_retour_update->Transport_Itineraire = $request->up_Transport_Itineraire_;
            $Vole_retour_update->itineraire_programme = $request->up_itineraire_programme_;
            $Vole_retour_update->save();

            return response()->json([
                'status' => 200,
                'message' => 'Modification avec succès',
            ]);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    //    delete hotel
    public function destroy_Itineraire(Request  $request)
    {
        $check = gestion_datail_itineraire_programmes::where('id', $request->id_delet_itineraire)->first();
        if ($check != null) {
            $niveauurgence = gestion_datail_itineraire_programmes::find($request->id_delet_itineraire);
            $niveauurgence->delete();
            return response()->json([
                'status' => 200,
                'message' => 'La suppression avec succès',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Contacter le service IT',
            ]);
        }
    }
    // info update
    public function infos_Itineraire($id)
    {
        $infos_Itinerair = gestion_datail_itineraire_programmes::where('FK_programme', $id)->get();
        if ($infos_Itinerair != null) {
            return response()->json([
                'infos_Itinerair' => $infos_Itinerair,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\éxiste pas',
            ]);
        }
    }
    // info vole  gestion programmes
    public function infos_Programme($id,$fkdossier)
    {
        $niveaux = gestion_programmes::where('gestion__programmes.id', $id)
        ->where('gestion__programmes.FK_dossier', $fkdossier)
        ->get();
        if ($niveaux != null) {
            return response()->json([
                'liste_programmes' => $niveaux,
                'status' => 200,
                'message' => 'Programme existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Programme n\existe pas',
            ]);
        }
    }
    public function Programme_info($id, $fkdossier)
    {
        $niveaux = gestion_programmes::select('gestion_datail_hotel_programmes.*','gestion__programmes.*','gestion__programmes.id as id_prgm')
        ->join('gestion_datail_hotel_programmes', 'gestion__programmes.id', '=', 'gestion_datail_hotel_programmes.FK_programme')
            ->where('gestion__programmes.id', $id)
            ->where('gestion__programmes.FK_dossier', $fkdossier)
            ->where('gestion__programmes.deleted_at', '=', NULL)
            ->get();
        if ($niveaux != null) {
            return response()->json([
                'liste_programme' => $niveaux,
                'status' => 200,
                'message' => 'Programme existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Programme n\existe pas',
            ]);
        }
    }

    // increment
    public function liste_gestion_programmes(Request $request)
    {
        // ref_programme
        // dd( $request->id)
        $liste_gestion_programmes = gestion_programmes::where('gestion__programmes.deleted_at', '=', NULL)
            ->where('gestion__programmes.id', $request->id)
            ->orderBy("id", "desc")->get();
        return response()->json([
            'liste_gestion_programmes' => $liste_gestion_programmes
        ]);
    }
    // FK_dossier
    public function liste_prg_FKdossier(Request $request)
    {

        $liste_prg_FKdossier = gestion_programmes::where('gestion__programmes.deleted_at', '=', NULL)
            ->where('gestion__programmes.FK_dossier', $request->id)
            ->orderBy("id", "desc")->get();
        return response()->json([
            'liste_prg_FKdossier' => $liste_prg_FKdossier
        ]);
    }
    //************** */ Gestion serve ************
    public function Service_Stores(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ville_service' => 'required',
            'Transport_Itineraire' => 'required',
            'service_prog' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $Ajouter_Service_Stores = new gestion_datail_services_progs();
            $Ajouter_Service_Stores->villes = $request->input('ville_service');
            $Ajouter_Service_Stores->hotel_fournisseur = $request->input('Transport_Itineraire');
            $Ajouter_Service_Stores->Service = $request->input('service_prog');
            $Ajouter_Service_Stores->nbr_etoile = $request->input('nbr_etoile');
            $Ajouter_Service_Stores->FK_programme =  $request->input('ref_programme');
            $Ajouter_Service_Stores->save();
            return response()->json([
                'status' => 200,
                'message' => 'Ajouter avec succès',
            ]);
        }
    }
    // up info service
    public function infos_service($id)
    {
        $infos_Itinerair = gestion_datail_services_progs::where('FK_programme', $id)->get();
        if ($infos_Itinerair != null) {
            return response()->json([
                'infos_service' => $infos_Itinerair,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\éxiste pas',
            ]);
        }
    }
    // up info itineraire
    public function up_info_service(Request $request)
    {
        $infos_service = gestion_datail_services_progs::where('id', $request->id)->first();
        return response()->json([
            'infos_service' => $infos_service
        ]);
    }
    //    delete service
    public function destroy_service(Request  $request)
    {
        $check = gestion_datail_services_progs::where('id', $request->id_delet_service)->first();
        if ($check != null) {
            $niveauurgence = gestion_datail_services_progs::find($request->id_delet_service);
            $niveauurgence->delete();
            return response()->json([
                'status' => 200,
                'message' => 'La suppression avec succès',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'Contacter le service IT',
            ]);
        }
    }
    public function update_service(Request $request)
    {
        try {
            $service_update = gestion_datail_services_progs::where('id', $request->up_id_service)->first();
            $service_update->hotel_fournisseur = $request->Transport_Itineraire;
            $service_update->villes = $request->up_ville_service;
            $service_update->Service = $request->up_service_prog;
            $service_update->save();

            return response()->json([
                'status' => 200,
                'message' => 'Modification avec succès',
            ]);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    //liste type programme
    public function index_type_prg(Request $request)
    {
        $liste_type_prg = Gestion_type_programmes::where('gestion_type_programme.deleted_at', '=', NULL)
            ->orderBy("id", "desc")->get();
        return response()->json([
            'liste_type_prg' => $liste_type_prg
        ]);
    }
}
