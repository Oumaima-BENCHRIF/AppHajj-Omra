<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\gestion_fiches_inscription;
use App\Models\gestion_programmes;
use App\Models\gestion_type_visa;
use App\Models\gestion_Categorie;
use App\Models\Fiche_client;
use App\Models\Gestion_type_chambres;
use App\Models\Accompagnateurs;
use App\Models\Gestion_chambres;
use App\Models\Gestion_inclus;
use App\Models\Gestion_detail_fiches_inscriptions;
use App\Models\datail_hotel_programmes;
use App\Models\Factures;
use Barryvdh\DomPDF\Facade\Pdf;

// use Illuminate\Http\Input;
class GestionFichesInscriptionController extends Controller
{
    public function index()
    {
        $Detail_Fiche_Insc = Gestion_detail_fiches_inscriptions::where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
            ->get();

        return view('gestion_fiches_inscription/create_fiche_inscription', [
            'Detail_Fiche_Insc' => $Detail_Fiche_Insc
        ]);
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'num_fichier' => 'required',
                'date_fiche_inscription' => 'required',
                'num_prg_inscription' => 'required',
                'code_societe' => 'required',
                'nom_societe' => 'required',
                'bon_commande' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $gestion_dossiers = new gestion_fiches_inscription();
                $gestion_dossiers->num_fichier = $request->input('num_fichier');
                $gestion_dossiers->date_fiche_inscription = $request->input('date_fiche_inscription');
                $gestion_dossiers->FK_programme  = $request->input('num_prg_inscription');
                $gestion_dossiers->FK_societe  = $request->input('code_societe');
                $gestion_dossiers->nom_societe  = $request->input('nom_societe');
                $gestion_dossiers->bon_commande  = $request->input('bon_commande');
                $gestion_dossiers->save();
              
                $update_fiche_insc = gestion_fiches_inscription::where('num_fichier', $request->input('num_fichier'))
                ->where('id', $gestion_dossiers->id)
                ->where('FK_programme', $request->input('num_prg_inscription'))
                ->get();


                return response()->json([
                    'status' => 200,
                    'update_fiche_insc' => $update_fiche_insc ,
                    'message' => 'Votre demande a été bien envoyée.',
                ]);
            }
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non le service IT')
                ->withInput();
        }
    }
    public function Trajet_Dossier(Request $request)
    {

        $Trajet_Dossier = gestion_programmes::join('gestion_dossier', 'gestion__programmes.FK_dossier', 'gestion_dossier.id', 'gestion_datail_hotel_programmes.*')
            ->join('gestion_datail_hotel_programmes', 'gestion__programmes.id', 'gestion_datail_hotel_programmes.FK_programme')
            ->where('gestion__programmes.FK_dossier', $request->id_dossier)
            ->where('gestion_datail_hotel_programmes.id', $request->id_detail_hotel)
            ->where('gestion__programmes.id', $request->id_prg)
            ->get();
        if ($Trajet_Dossier != null) {
            return response()->json([

                'Trajet_Dossier' => $Trajet_Dossier,
                'status' => 200,
                'message' => 'Vole retour existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }
    // info prg
    public function info_prg()
    {
        $niveaux = gestion_programmes::all();
        if ($niveaux != null) {
            return response()->json([
                'inf_prg' => $niveaux,
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
    
    public function print(Request $request){
        $data=new Factures;
        $data->Code_client= $request->input('num_fichier');
    
       $data->numero_facture= $request->input('num_fichier');
       $data->Numero_dossier=  $request->id_dossier;
       $data->bon_commande= $request->input('bon_commande');
       $data->date=$request->input('date_fiche_inscription');
    //    $data->Vos_ref= $request->input('num_fichier');
    //    $data->Nom_client= $request->input('num_fichier');
    //    $data->adresse= $request->input('num_fichier');
    //    $data->ville= $request->input('num_fichier');
    //    $data->Total= $request->input('num_fichier');
       
        $pdf = PDF::loadView('myPDF',
        ['data'=>$data ]);

        return $pdf->download('facture.pdf');
    
    }

    // info fiche inscription
    public function info_fiche_insc(Request $request, $id_prg, $id_detail_hotel)
    {

        $niveaux = Gestion_detail_fiches_inscriptions::where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
            ->orderBy("id", "desc")->get();

        $info_fiche_insc = gestion_fiches_inscription::select('gestion_fiches_inscriptions.id as id_fiche_ins', 'gestion_fiches_inscriptions.*')
            ->join('gestion_detail_fiches_inscriptions', 'gestion_detail_fiches_inscriptions.Fk_fiche_inscription', 'gestion_fiches_inscriptions.id')
            ->where('gestion_fiches_inscriptions.deleted_at', '=', NULL)
            ->where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
            ->where('gestion_detail_fiches_inscriptions.FK_programme', $id_prg)
            ->where('gestion_detail_fiches_inscriptions.FK_detail_hotel_prg', $id_detail_hotel)
            ->groupBy('id_fiche_ins')
            ->get();

        if ($niveaux != null) {
            return response()->json([
                'inf_fiche_insc' => $niveaux,
                'info_fiche' => $info_fiche_insc,
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
    public function affiche_fiche_insc($id_prg)
    {
        $fiche_insc = gestion_fiches_inscription::where('gestion_fiches_inscriptions.deleted_at', '=', NULL)
            ->where('gestion_fiches_inscriptions.FK_programme', $id_prg)
            ->orderBy("id", "desc")->get();
        if ($fiche_insc != null) {
            return response()->json([
                'fiche_insc' => $fiche_insc,
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
    public function Detail_Fiche_Insc(Request $request, $Fk_fiche, $id_prg, $id_hotel)
    {

        $Detail_Fiche_Insc = Gestion_detail_fiches_inscriptions::where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
            ->where('gestion_detail_fiches_inscriptions.Fk_fiche_inscription', $Fk_fiche)
            ->where('gestion_detail_fiches_inscriptions.FK_programme', $id_prg)
            ->where('gestion_detail_fiches_inscriptions.FK_detail_hotel_prg', $id_hotel)
            ->get();

          
          
        if ($Detail_Fiche_Insc != null) {
            return response()->json([
                'Detail_Fiche_Insc' => $Detail_Fiche_Insc,
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
    public function information_client(Request $request)
    {
        $info_client = Gestion_detail_fiches_inscriptions::where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
            ->where('gestion_detail_fiches_inscriptions.id', $request->Fk_fiche)
            ->get();
        if ($info_client != null) {
            return response()->json([
                'info_client' => $info_client,
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
    public function info_GFiche_Insc($id)
    {
      
        $info_GFiche_Insc = Gestion_detail_fiches_inscriptions::where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
            ->where('gestion_detail_fiches_inscriptions.id', $id)->get();


        $info_fiche_Insc = gestion_fiches_inscription::select('gestion_fiches_inscriptions.*', 'fiche_clients.id as compte')
            ->where('gestion_fiches_inscriptions.deleted_at', '=', NULL)
            ->where('gestion_fiches_inscriptions.id', $id)
            ->join('fiche_clients', 'gestion_fiches_inscriptions.FK_societe', '=', 'fiche_clients.id')
            ->get();


        if ($info_fiche_Insc != null) {
            return response()->json([
                'info_GFiche_Insc' => $info_GFiche_Insc,
                'info_fiche_Insc' => $info_fiche_Insc,
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
    public function update(Request $request)
    {

        try {

            $up_fiche_insc = Gestion_detail_fiches_inscriptions::where('id', $request->update_id_client)->first();

            $up_fiche_insc->num_ligne = $request->up_num_ligne;
            $up_fiche_insc->nom_client = $request->up_nom_client;
            $up_fiche_insc->prenom_client = $request->up_prenom_client;
            $up_fiche_insc->nom_arabe = $request->up_nom_arabe;
            $up_fiche_insc->prenom_arabe = $request->up_prenom_arabe;

            if ($request->hasFile('up_blah')) {
                $file = $request->file('up_blah');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $up_fiche_insc->upload_img = $filename;
            }

            $up_fiche_insc->num_GSM = $request->up_num_GSM;
            $up_fiche_insc->num_CIN = $request->up_num_CIN;
            $up_fiche_insc->Email = $request->up_Email;
            $up_fiche_insc->prix = $request->up_prix;
            $up_fiche_insc->genre = $request->up_genre;
            $up_fiche_insc->num_passeport = $request->up_num_passeport;
            $up_fiche_insc->date_naissance = $request->up_date_naissance;
            $up_fiche_insc->adresse = $request->up_adresse;
            $up_fiche_insc->date_expiration = $request->up_date_expiration;
            $up_fiche_insc->situation_familiale = $request->up_situation_familiale;
            $up_fiche_insc->telephone = $request->up_telephone;
            $up_fiche_insc->date_obtention_visa = $request->up_date_expiration_visa;
            $up_fiche_insc->num_visa = $request->up_Type_visa;
            $up_fiche_insc->date_delivrance = $request->up_Lieu_delivrance;
            $up_fiche_insc->Province = $request->up_Province;
            $up_fiche_insc->date_expiration_visa = $request->up_date_obtention_visa;
            $up_fiche_insc->etat_passeport = $request->up_etat_passeport;
            $up_fiche_insc->Num_Inscription = $request->up_Num_Inscription;
            $up_fiche_insc->Type_visa = $request->up_num_visa;
            $up_fiche_insc->type_passport = $request->up_type_passport;
            $up_fiche_insc->Lieu_delivrance = $request->up_date_delivrance;

            if ($request->hasFile('up_img_passp')) {
                $file = $request->file('up_img_passp');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $up_fiche_insc->img_pass = $filename;
            }

            $up_fiche_insc->FK_programme = $request->up_Fk_prg;
            $up_fiche_insc->FK_type_chambre  = $request->up_type_chambre_medina;
            $up_fiche_insc->Fk_chambre_medina  = $request->up_chambre_medina;
            $up_fiche_insc->FK_accompagnateurs = $request->up_num_Accompagnateur;
            $up_fiche_insc->FK_detail_hotel_prg  = $request->up_Fk_hotel;
            $up_fiche_insc->FK_type_chambre_makka  = $request->up_type_chambre_makka;
            $up_fiche_insc->FK_chambre_makka  = $request->up_chambre_makka;
            $up_fiche_insc->save();

            return response()->json([
                'status' => 200,
                'messages' => 'Modification avec succès',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 200,
                'Error' => 'Merci de vérifier la connexion internet, si non email_clienter le service IT',
            ]);
        }
    }

    public function destroy(Request  $request)
    {

        try {
            $check = Gestion_detail_fiches_inscriptions::where('id', $request->delete_id_client)->first();
            if ($check != null) {
                $niveauurgence = Gestion_detail_fiches_inscriptions::find($request->delete_id_client);
                $niveauurgence->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Suppression avec succès',
                ]);
            } else {
                return response()->json([
                    'status' => 200,
                    'error' => 'Vérifiez votre données',
                ]);
            }
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non Contacter le service IT')
                ->withInput();
        }
    }
    public function store_categorie(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'num_categorie' => 'required',
                'nom_categorie' => 'required',
                'nbr_pax' => 'required',
                'remis' => 'required',
                'date_categorie' => 'required',
                'type_prg' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $store_Categorie = new gestion_Categorie();
                $store_Categorie->num_categorie = $request->input('num_categorie');
                $store_Categorie->nom_categorie = $request->input('nom_categorie');
                $store_Categorie->Nbre_pax = $request->input('nbr_pax');
                $store_Categorie->remis = $request->input('remis');
                $store_Categorie->date = $request->input('date_categorie');
                $store_Categorie->FK_type  = $request->input('type_prg');
                $store_Categorie->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Votre demande a été bien envoyée.',
                ]);
            }
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non le service IT')
                ->withInput();
        }
    }

    // info categorie
    public function info_categorie()
    {
        $niveaux = gestion_Categorie::where('gestion__categories.deleted_at', '=', NULL)
            ->orderBy("id", "desc")->get();
        if ($niveaux != null) {
            return response()->json([
                'inf_Categorie' => $niveaux,
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

    public function search_categorie($id)
    {
        $niveaux = gestion_Categorie::where('id', $id)->get();
        if ($niveaux != null) {
            return response()->json([
                'info_categorie' => $niveaux,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }

    public function search_societe()
    {
        $niveaux = Fiche_client::where('fiche_clients.deleted_at', '=', NULL)->get();
        if ($niveaux != null) {
            return response()->json([
                'societe_info' => $niveaux,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }
    public function search_societe_info($id)
    {
        $niveaux = Fiche_client::where('id', $id)->where('fiche_clients.deleted_at', '=', NULL)
            ->get();
        if ($niveaux != null) {
            return response()->json([
                'societe_info' => $niveaux,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }

    public function type_chambre()
    {
        $Gestion_chambres = Gestion_chambres::get();
        $niveaux = Gestion_type_chambres::where('gestion_type_chambre.deleted_at', '=', NULL)->get();
        if ($niveaux != null) {
            return response()->json([
                'type_chambre_info' => $niveaux,
                'Gestion_chambres' => $Gestion_chambres,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }

    public function accompagnateur_info()
    {
        $niveaux = Accompagnateurs::where('accompagnateurs.deleted_at', '=', NULL)->get();
        if ($niveaux != null) {
            return response()->json([
                'accomp_info' => $niveaux,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }

    public function type_visa()
    {
        $niveaux = gestion_type_visa::where('gestion_type_visas.deleted_at', '=', NULL)->get();
        if ($niveaux != null) {
            return response()->json([
                'type_visa_info' => $niveaux,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }

    // inscription Store
    public function inscription_Store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [

                // 'num_ligne' => 'required',
                // 'nom_client' => 'required',
                // 'prenom_client' => 'required',
                // 'num_GSM' => 'required',
                // 'type_chambre' => 'required',
                // 'nom_arabe' => 'required',
                // 'prenom_arabe' => 'required',
                // 'num_CIN' => 'required',
                // 'Email' => 'required',
                // 'chambre' => 'required',
                // 'genre' => 'required',
                // 'date_naissance' => 'required',
                // 'adresse' => 'required',
                // 'num_Accompagnateur' => 'required',
                // 'prix' => 'required',
                // 'date_expiration' => 'required',
                // 'situation_familiale' => 'required',
                // 'telephone' => 'required',
                // 'num_prg_inscription' => 'required',
                // 'imgInp' => 'required',
                // 'num_passeport' => 'required',
                // 'date_obtention_visa' => 'required',
                // 'num_visa' => 'required',
                // 'date_delivrance' => 'required',
                // 'etat_passeport' => 'required',
                // 'Province' => 'required',
                // 'date_expiration_visa' => 'required',
                // 'Num_Inscription' => 'required',
                // 'Type_visa' => 'required',
                // 'Lieu_delivrance' => 'required',
                // 'num_agence' => 'required',
                // 'type_passport' => 'required',
                // 'photo' => 'required',
                /* -----------------------------------Inclus */
                // 'Billetcheq'=>'required',
                // 'Reduction_Billet'=>'required',
                // 'raison_billet'=>'required',

                // 'Transportcheq'=>'required',
                // 'Reduction_Transport'=>'required',
                // 'raison_Transport'=>'required',

                // 'hotel_meedinacheq'=>'required',
                // 'Reduction_Hotel_Meedina'=>'required',
                // 'raison_hotel_medina'=>'required',

                // 'hotel_makkacheq'=>'required',
                // 'Reduction_Hotel_Makka'=>'required',
                // 'raison_hotel_makka'=>'required',

                // 'Visacheq'=>'required',
                // 'Reduction_Visa'=>'required',
                // 'raison_visa'=>'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $update_type_chambre =  datail_hotel_programmes::where('id', $request->detail_hotel_prg)->first();


                if ($update_type_chambre != null) {
                    $detail_hotel_prg = datail_hotel_programmes::find($request->detail_hotel_prg);
                    if ($detail_hotel_prg->Totale_place > 0) {
                          /* subtraction  Totale chambre ----------------------------------------------- */
                        $detail_hotel_prg->Totale_place = $detail_hotel_prg->Totale_place - 1;
                        $detail_hotel_prg->Totale_place_reserver = $detail_hotel_prg->Totale_place_reserver + 1;
                        $detail_hotel_prg->save();

                        /* Add Fiche Insc ----------------------------------------------- */
                        $Gestion_detail_fiches_inscriptions = new Gestion_detail_fiches_inscriptions();
                        $Gestion_detail_fiches_inscriptions->num_ligne = $request->input('num_ligne');
                        $Gestion_detail_fiches_inscriptions->nom_client = $request->input('nom_client');
                        $Gestion_detail_fiches_inscriptions->prenom_client = $request->input('prenom_client');
                        $Gestion_detail_fiches_inscriptions->nom_arabe = $request->input('nom_arabe');
                        $Gestion_detail_fiches_inscriptions->prenom_arabe = $request->input('prenom_arabe');

                        if ($request->hasFile('imgInp')) {
                            $file = $request->file('imgInp');
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('uploads'), $filename);
                            $Gestion_detail_fiches_inscriptions->upload_img = $filename;
                        }
                        $Gestion_detail_fiches_inscriptions->num_GSM = $request->input('num_GSM');
                        $Gestion_detail_fiches_inscriptions->num_CIN = $request->input('num_CIN');
                        $Gestion_detail_fiches_inscriptions->Email = $request->input('Email');
                        $Gestion_detail_fiches_inscriptions->prix = $request->input('prix');
                        $Gestion_detail_fiches_inscriptions->genre = $request->input('genre');
                        $Gestion_detail_fiches_inscriptions->num_passeport = $request->input('num_passeport');
                        $Gestion_detail_fiches_inscriptions->date_naissance = $request->input('date_naissance');
                        $Gestion_detail_fiches_inscriptions->adresse = $request->input('adresse');
                        $Gestion_detail_fiches_inscriptions->date_expiration = $request->input('date_expiration');
                        $Gestion_detail_fiches_inscriptions->situation_familiale = $request->input('situation_familiale');
                        $Gestion_detail_fiches_inscriptions->telephone = $request->input('telephone');
                        $Gestion_detail_fiches_inscriptions->date_obtention_visa = $request->input('date_obtention_visa');
                        $Gestion_detail_fiches_inscriptions->num_visa = $request->input('num_visa');
                        $Gestion_detail_fiches_inscriptions->date_delivrance = $request->input('date_delivrance');
                        $Gestion_detail_fiches_inscriptions->Province = $request->input('Province');
                        $Gestion_detail_fiches_inscriptions->date_expiration_visa = $request->input('date_expiration_visa');
                        $Gestion_detail_fiches_inscriptions->etat_passeport = $request->input('etat_passeport');
                        $Gestion_detail_fiches_inscriptions->Num_Inscription = $request->input('Num_Inscription');
                        $Gestion_detail_fiches_inscriptions->Type_visa = $request->input('Type_visa');
                        $Gestion_detail_fiches_inscriptions->type_passport = $request->input('type_passport');
                        $Gestion_detail_fiches_inscriptions->Lieu_delivrance = $request->input('Lieu_delivrance');
                        $Gestion_detail_fiches_inscriptions->num_agence = $request->input('num_agence');


                        if ($request->hasFile('photo')) {
                            $file = $request->file('photo');
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('uploads'), $filename);
                            $Gestion_detail_fiches_inscriptions->img_pass = $filename;
                        }
                        $Gestion_detail_fiches_inscriptions->FK_programme = $request->input('id_prg');
                        $Gestion_detail_fiches_inscriptions->Fk_fiche_inscription  = $request->input('num_fichier');
                        $Gestion_detail_fiches_inscriptions->FK_type_chambre  = $request->input('type_chambre_medina');
                        $Gestion_detail_fiches_inscriptions->Fk_chambre_medina  = $request->input('chambre_medina');
                        $Gestion_detail_fiches_inscriptions->FK_accompagnateurs = $request->input('num_Accompagnateur');
                        $Gestion_detail_fiches_inscriptions->FK_detail_hotel_prg  = $request->input('detail_hotel_prg');

                        $Gestion_detail_fiches_inscriptions->FK_type_chambre_makka  = $request->input('type_chambre_makka');
                        $Gestion_detail_fiches_inscriptions->FK_chambre_makka  = $request->input('chambre_makka');

                        $Gestion_detail_fiches_inscriptions->save();
                        return response()->json([
                            'status' => 200,
                            'messages' => 'Votre demande a été bien Enregistrer.',
                        ]);

                    } else {
                        return response()->json([
                            'status' => 400,
                            'errors' => 'Aucune chambre n\'est disponible, car elles sont toutes déjà réservées.',
                        ]);
                    }
                }



                // $Gestion_information_clients->num_agence = $request->input('num_agence')

                // $Gestion_information_clients->num_prg_inscription = $request->input('num_prg_inscription');



                // $Gestion_inclus = new Gestion_inclus();
                /* ************** checkPost Billet*/
                // $Gestion_inclus->exclu_Billet = $request->Billetcheq;
                // $Gestion_inclus->Reduction_Billet = $request->Reduction_Billet;
                // $Gestion_inclus->Raison_Billet = $request->raison_billet;

                /* ************** checkPost Transport*/
                // $Gestion_inclus->exclu_Transport = $request->Transportcheq;
                // $Gestion_inclus->Reduction_Transport = $request->Reduction_Transport;
                // $Gestion_inclus->Raison_Transport = $request->raison_Transport;

                /* ************** checkPost Hotel Meedina*/
                // $Gestion_inclus->exclu_Hotel_Meedina = $request->hotel_meedinacheq;
                // $Gestion_inclus->Reduction_Hotel_Meedina = $request->Reduction_Hotel_Meedina;
                // $Gestion_inclus->Raison_Hotel_Meedina = $request->raison_hotel_medina;

                /* ************** checkPost Hotel Makka*/
                // $Gestion_inclus->exclu_Hotel_Makka = $request->hotel_makkacheq;
                // $Gestion_inclus->Reduction_Hotel_Makka = $request->Reduction_Hotel_Makka;
                // $Gestion_inclus->Raison_Hotel_Makka = $request->raison_hotel_makka;

                /* ************** checkPost Hotel Makka*/
                // $Gestion_inclus->exclu_Visa = $request->Visacheq;
                // $Gestion_inclus->Reduction_Visa = $request->Reduction_Visa;
                // $Gestion_inclus->Raison_Visa = $request->raison_visa;

                // Ajouter inclus
                // $Gestion_inclus->save();

                // $Gestion_information_clients->FK_inclus = $Gestion_inclus->id;

                // Ajouter a fiche d'inscription



            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'errors' => 'Merci de vérifier la connexion internet, si non  le service IT',
            ]);
        }
    }
}
