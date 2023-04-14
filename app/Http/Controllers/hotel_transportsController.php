<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel_transports;
use App\Http\Requests\hotelTransportsPostRequest;
use App\Models\Villes;
use App\Models\Types;


class hotel_transportsController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $villes = Villes::get();
        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------

        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_Hotel_transports/create_hotel_transports', [
            'villes' => $villes,

        ])
            ->with($request->all());
    }
    //Lister les Hotel_transports
    public function indexs(Request $request)
    {

        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_Hotel_transports/create_hotel_transports');


        // $Liste_Hotel_transports= Hotel_transports::all();
        // return view('gestion_Hotel_transports.index',[
        //     'listes_Hotel_transports'=>$Liste_Hotel_transports
        //     ]);
    }
    //Affiche le formulaire de creation de Hotel_transports
    public function create()
    {

        $Liste_Hotel_transports = Hotel_transports::all();

        return view('gestion_Hotel_transports/create_hotel_transports', [
            'countListeHotel_transports' => $Liste_Hotel_transports->count(),
            'listes_Hotel_transports' => $Liste_Hotel_transports,

        ]);
        // return view('gestion_Hotel_transports/create_hotel_transports');
    }
    public function liste()
    {
        $Liste_Hotel_fournisseur = Hotel_transports::select('hotel_transports.*', 'villes.nom as nom_ville', 'types.type as nom_type')
            ->where('hotel_transports.deleted_at', '=', NULL)
            ->join('villes', 'hotel_transports.FK_ville', 'villes.id')
            ->join('types', 'hotel_transports.FK_type', 'types.id')
            ->orderBy("id", "desc")->get();
        $liste_types = Types::all();
        $Liste_ville = Villes::all();
        return response()->json([
            'Liste_Hotel_fournisseur' => $Liste_Hotel_fournisseur,
            'countListeListe_Hotel_fournisseur' => $Liste_Hotel_fournisseur->count(),
            'liste_types' => $liste_types,
            'Liste_ville' => $Liste_ville,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    //Enregister hotelTransportsPostRequest
    public function store(Request $request)
    {

        try {

            $Hotel_transports = new Hotel_transports();
            $Hotel_transports->code = $request->input('code');
            $Hotel_transports->nom = $request->input('nom');
            $Hotel_transports->FK_ville = $request->input('ville');
            $Hotel_transports->emplacement = $request->input('emplacement');
            $Hotel_transports->telephone = $request->input('telephone');
            $Hotel_transports->fax = $request->input('fax');
            $Hotel_transports->site = $request->input('site');
            $Hotel_transports->compte_comptable_ramadan = $request->input('compte_comptable_ramadan');
            $Hotel_transports->compte_comptable_mouloud = $request->input('compte_comptable_mouloud');
            $Hotel_transports->contact = $request->input('contact');
            $Hotel_transports->email = $request->input('email');
            $Hotel_transports->categorie = $request->input('categorie');
            $Hotel_transports->nom_en_arabe = $request->input('nom_en_arabe');
            $Hotel_transports->FK_type = $request->input('type');
            $Hotel_transports->save();



            return response()->json([
                'status' => 200,
                'message' => 'Votre demande a été bien envoyée.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'errors' => 'Merci de vérifier la connexion internet, si non le service IT',
            ]);
        }
    }
    // 
    public function infos($id)
    {
        $Hotel_transports = Hotel_transports::where('id', $id)->get();

        if ($Hotel_transports != null) {
            return response()->json([
                'Hotel_transports' => $Hotel_transports,
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


    //permet de récupérer un Hotel_transports
    public function edit()
    {
    }
    // permet de modifier Hotel_transports
    public function update(Request $request)
    {

        try {

            $Hotel_transports_update = Hotel_transports::where('id', $request->update_id)->first();

            $Hotel_transports_update->code = $request->up_code;
            $Hotel_transports_update->nom = $request->up_nom;
            $Hotel_transports_update->FK_ville = $request->up_ville;
            $Hotel_transports_update->fax = $request->up_fax;
            $Hotel_transports_update->telephone = $request->up_telephone;
            $Hotel_transports_update->emplacement = $request->up_emplacement;
            $Hotel_transports_update->site = $request->up_site;
            $Hotel_transports_update->nom_en_arabe = $request->up_nom_en_arabe;
            $Hotel_transports_update->compte_comptable_ramadan = $request->up_compte_comptable_ramadan;
            $Hotel_transports_update->compte_comptable_mouloud = $request->up_compte_comptable_mouloud;
            $Hotel_transports_update->email = $request->up_email;
            $Hotel_transports_update->categorie = $request->up_categorie;
            $Hotel_transports_update->FK_type = $request->up_type;
            $Hotel_transports_update->save();
            return response()->json([
                'status' => 200,
                'message' => 'Modification avec succès',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 200,
                'message' => 'Merci de vérifier la connexion internet, si non email_clienter le service IT',
            ]);
        }
    }
    // permet de supprimer Hotel_transports
    public function destroy(Request  $request)
    {
        try {
            $check = Hotel_transports::where('id', $request->id_delete_hotel)->first();
            if ($check != null) {
                $niveauurgence = Hotel_transports::find($request->id_delete_hotel);
                $niveauurgence->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Suppression avec succès',
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'errors' => 'Vérifier votre connection internet',
                ]);
            }
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }

    //Lister les Hotel_transports
    public function Recherche_Hotel_transports(Request $request)
    {
        $page = $request->page ?? 0;
        $code = $request->get('code_1');
        $nom = $request->get('nom_1');
        $ville = $request->get('ville_1');
        $emplacement = $request->get('emplacement_1');
        $telephone = $request->get('telephone_1');
        $fax = $request->get('fax_1');
        $site = $request->get('site_1');
        $compte_comptable_ramadan = $request->get('compte_comptable_ramadan_1');
        $compte_comptable_mouloud = $request->get('compte_comptable_mouloud_1');
        $contact = $request->get('contact_1');
        $email = $request->get('email_1');
        $categorie = $request->get('categorie_1');
        $nom_en_arabe = $request->get('nom_en_arabe_1');
        $type = $request->get('type_1');
        $villes = Villes::get();

        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
        $Liste_Hotel_transports = Hotel_transports::where('Hotel_transports.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($code, $nom, $fax, $ville, $telephone, $emplacement, $site, $nom_en_arabe, $compte_comptable_ramadan, $compte_comptable_mouloud, $contact, $email, $categorie, $type) {
                if (!empty($code)) {
                    $query->where('hotel_transports.code', 'LIKE', $code . '%');
                }
                if (!empty($nom)) {
                    $query->where('hotel_transports.nom', 'LIKE', $nom . '%');
                }
                if (!empty($fax)) {
                    $query->where('hotel_transports.fax', 'LIKE', $fax . '%');
                }
                if (!empty($ville)) {
                    $query->where('hotel_transports.ville', 'LIKE', $ville . '%');
                }
                if (!empty($emplacement)) {
                    $query->where('hotel_transports.emplacement', 'LIKE', $emplacement . '%');
                }
                if (!empty($telephone)) {
                    $query->where('hotel_transports.telephone', 'LIKE', $telephone . '%');
                }
                if (!empty($site)) {
                    $query->where('hotel_transports.site', 'LIKE', $site . '%');
                }
                if (!empty($nom_en_arabe)) {
                    $query->where('hotel_transports.nom_en_arabe', 'LIKE', $nom_en_arabe . '%');
                }
                if (!empty($compte_comptable_ramadan)) {
                    $query->where('hotel_transports.compte_comptable_ramadan', 'LIKE', $compte_comptable_ramadan . '%');
                }
                if (!empty($compte_comptable_mouloud)) {
                    $query->where('hotel_transports.compte_comptable_mouloud', 'LIKE', $compte_comptable_mouloud . '%');
                }
                if (!empty($contact)) {
                    $query->where('hotel_transports.contact', 'LIKE', $contact . '%');
                }
                if (!empty($email)) {
                    $query->where('hotel_transports.email', 'LIKE', $email . '%');
                }
                if (!empty($categorie)) {
                    $query->where('hotel_transports.categorie', 'LIKE', $categorie . '%');
                }
                if (!empty($categorie)) {
                    $query->where('hotel_transports.type', 'LIKE', $type . '%');
                }
            });
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_Hotel_transports/create_hotel_transports', [
            'page' => $page,
            'pagination' => $pagination ?? 20,
            'countListeHotel_transports' => $Liste_Hotel_transports->count(),
            'listes_Hotel_transports' => $Liste_Hotel_transports->paginate($pagination ?? 20),

        ])
            ->with($request->all());
    }
}
