<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Fiche_clientsPostRequest;
use App\Models\Fiche_client;
use App\Models\Villes;
use App\Models\Factures;
use App\Models\Reglement;
use Illuminate\Support\Facades\Validator;
use App\Models\lettrage_fact;
use Carbon\Carbon;

class Fiche_clientsController extends Controller
{
    //Lister les Fiche_client
    public function index(Request $request)
    {
        $villes = Villes::get();
        $code_client=$this->Code_client();
        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
        $Liste_Fiche_client = Fiche_client::where('fiche_clients.deleted_at', '=', NULL)
            ->orderBy("id", "desc");
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_Fiche_Client/create_fiche_client', [
            'pagination' => $pagination ?? 20,
            'countListeFiche_client' => $Liste_Fiche_client->count(),
            'listes_Fiche_client' => $Liste_Fiche_client->paginate($pagination ?? 20),
            'villes' => $villes,
            'code_client'=>$code_client
        ])
            ->with($request->all());
    }
    // rechercher fiche client
    public function rechercher_fiche(Request $request)
    {
        $page = $request->page ?? 0;
        $compte = $request->get('compte__');
        $nom = $request->get('nom__');
        $adresse = $request->get('adresse__');
        $C_postal = $request->get('C_postal__');
        $contact_commercial = $request->get('contact_commercial__');
        $telephone_commercial = $request->get('telephone_commercial__');
        $mobile_commercial = $request->get('mobile_commercial__');
        $ville_client = $request->get('ville_client__');
        $tele_client = $request->get('tele_client__');
        $email_client = $request->get('email_client__');
        $pays_client = $request->get('pays_client__');
        $fax_client = $request->get('fax_client__');
        $marge_client = $request->get('marge_client__');
        $Remarques = $request->get('Remarques__');
        $Liste_Fiche_client = Fiche_client::where('fiche_clients.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($compte, $nom, $adresse, $C_postal, $contact_commercial, $telephone_commercial, $mobile_commercial, $ville_client, $tele_client, $email_client, $pays_client, $fax_client, $marge_client, $Remarques) {
                if (!empty($compte)) {
                    $query->where('fiche_clients.compte', 'LIKE', $compte . '%');
                }
                if (!empty($nom)) {
                    $query->where('fiche_clients.nom', 'LIKE', $nom . '%');
                }
                if (!empty($adresse)) {
                    $query->where('fiche_clients.adresse', 'LIKE', $adresse . '%');
                }
                if (!empty($C_postal)) {
                    $query->where('fiche_clients.C_postal', 'LIKE', $C_postal . '%');
                }
                if (!empty($contact_commercial)) {
                    $query->where('fiche_clients.contact_commercial', 'LIKE', $contact_commercial . '%');
                }
                if (!empty($telephone_commercial)) {
                    $query->where('fiche_clients.telephone_commercial', 'LIKE', $telephone_commercial . '%');
                }
                if (!empty($mobile_commercial)) {
                    $query->where('fiche_clients.mobile_commercial', 'LIKE', $mobile_commercial . '%');
                }
                if (!empty($ville_client)) {
                    $query->where('fiche_clients.ville_client', 'LIKE', $ville_client . '%');
                }
                if (!empty($tele_client)) {
                    $query->where('fiche_clients.tele_client', 'LIKE', $tele_client . '%');
                }
                if (!empty($email_client)) {
                    $query->where('fiche_clients.email_client', 'LIKE', $email_client . '%');
                }
                if (!empty($pays_client)) {
                    $query->where('V.fiche_clients', 'LIKE', $pays_client . '%');
                }
                if (!empty($fax_client)) {
                    $query->where('fiche_clients.fax_client', 'LIKE', $fax_client . '%');
                }
                if (!empty($marge_client)) {
                    $query->where('fiche_clients.marge_client', 'LIKE', $marge_client . '%');
                }
                if (!empty($Remarques)) {
                    $query->where('fiche_clients.Remarques', 'LIKE', $Remarques . '%');
                }
            });
        if ($Liste_Fiche_client != null) {
            return response()->json([
                'page' => $page,
                'pagination' => $pagination ?? 20,
                'countListeFiche_client' => $Liste_Fiche_client->count(),
                'listes_Fiche_client' => $Liste_Fiche_client,
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
    //Affiche le formulaire de creation de Fiche_client
    public function liste_Fiche_client()
    {
        $Liste_Fiche_client = Fiche_client::all();
        if ($Liste_Fiche_client != null) {
            return response()->json([
                'Liste_Fiche_client' => $Liste_Fiche_client,
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
    private function Code_client()
    {
        $lastRecord = Fiche_client::latest('id')->first();
       
        if($lastRecord!=null)
        {
        $num=$lastRecord->Code_client;
        $conteur = intval(substr($num,4));
        $conteur += 1;
        $result = sprintf('%04d', $conteur);
       $code= '3421'.$result;
       return $code;
        }
        else
        {
            return '3421'.'0001';
        }

    }
    //Enregister Fiche_client
    public function store(Fiche_clientsPostRequest $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'compte' => 'required',
                'nom' => 'required',
                'adresse' => 'required',
                'C_postal' => 'required',
                'contact_commercial' => 'required',
                'telephone_commercial' => 'required',
                'mobile_commercial' => 'required',
                'ville_client' => 'required',
                'tele_client' => 'required',
                'email_client' => 'required',
                'pays_client' => 'required',
                'fax_client' => 'required',
                'marge_client' => 'required',
                'Remarques' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $code_client=$this->Code_client();
                $Fiche_client = new Fiche_client();
                $Fiche_client->compte = $request->input('compte');
                $Fiche_client->nom = $request->input('nom');
                $Fiche_client->Code_client = $code_client;
                $Fiche_client->adresse = $request->input('adresse');
                $Fiche_client->C_postal = $request->input('C_postal');
                $Fiche_client->contact_commercial = $request->input('contact_commercial');
                $Fiche_client->telephone_commercial = $request->input('telephone_commercial');
                $Fiche_client->mobile_commercial = $request->input('mobile_commercial');
                $Fiche_client->ville_client = $request->input('ville_client');
                $Fiche_client->tele_client = $request->input('tele_client');
                $Fiche_client->email_client = $request->input('email_client');
                $Fiche_client->pays_client = $request->input('pays_client');
                $Fiche_client->fax_client = $request->input('fax_client');
                $Fiche_client->marge_client = $request->input('marge_client');
                $Fiche_client->Remarques = $request->input('Remarques');
                $Fiche_client->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Votre demande a été bien envoyée.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 200,
                'errors' => 'Merci de vérifier la connexion internet, si non le service IT.',
            ]);
        }
    }
    // 
    public function infos(Request $request)
    {
        $niveaux = Fiche_client::where('id', $request->id)->first();
        return response()->json([
            'Hotel_transports' => $niveaux
        ]);
    }

    //permet de récupérer un Fiche_client
    public function situation_client($id)
    {
        $facture=Factures::where('factures.Code_client',$id)
        ->where('factures.deleted_at', '=', NULL)
        ->get();
        $lettrage=lettrage_fact::where('lettrage_fact.deleted_at', '=', NULL)
        ->where('lettrage_fact.num_factures',$facture->numero_facture)->get();

        return response()->json([
            'facture' => $facture,
            'lettrage' => $lettrage,
            'status' => 200,
        ]);

    }
    // permet de modifier Fiche_client
    public function update(Request $request)
    {
        try {

            $Fiche_client_update = Fiche_client::where('id', $request->_id_)->first();
            $Fiche_client_update->compte = $request->_compte;
            $Fiche_client_update->nom = $request->_nom;
            $Fiche_client_update->adresse = $request->_adresse;
            $Fiche_client_update->C_postal = $request->_C_postal;
            $Fiche_client_update->contact_commercial = $request->_contact_commercial;
            $Fiche_client_update->telephone_commercial = $request->_telephone_commercial;
            $Fiche_client_update->mobile_commercial = $request->_mobile_commercial;
            $Fiche_client_update->ville_client = $request->_ville_client;
            $Fiche_client_update->tele_client = $request->_tele_client;
            $Fiche_client_update->email_client = $request->_email_client;
            $Fiche_client_update->pays_client = $request->_pays_client;
            $Fiche_client_update->fax_client = $request->_fax_client;
            $Fiche_client_update->marge_client = $request->_marge_client;
            $Fiche_client_update->Remarques = $request->_Remarques;
            $Fiche_client_update->save();
            return response()->json([
                'status' => 200,
                'message' => 'Modification avec succès.',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 200,
                'errors' => 'Merci de vérifier la connexion internet, si non le service IT.',
            ]);
        }
    }
    // permet de supprimer Fiche_client
    public function destroy(Request  $request)
    {
        try {
            $check = Fiche_client::where('id', $request->__id)->first();

            if ($check != null) {
                $niveauurgence = Fiche_client::find($request->__id);
                $niveauurgence->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'suppression avec succès.',
                ]);
            } else {
                return response()->json([
                    'status' => 200,
                    'Error' => 'Verifier votre données.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 200,
                'errors' => 'Merci de vérifier la connexion internet, si non le service IT.',
            ]);
        }
    }
}
