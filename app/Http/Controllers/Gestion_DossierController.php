<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Fiche_clientsPostRequest;
use App\Models\gestion_dossiers;
use App\Models\Villes;
use Illuminate\Support\Facades\Validator;
use App\Models\gestion_programmes;

class Gestion_DossierController extends Controller
{
    public function index(Request $request)
    {
        return view('gestion_dossier/create_dossier');
    }
    //  info gestion dossier
    public function liste_gestion_dossier()
    {
        $niveaux = gestion_dossiers::get();
        if ($niveaux != null) {
            return response()->json([
                'liste_gestion_dossier' => $niveaux,
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
    public function recherche_dossier(Request $request)
    {

        $nom_dossier = $request->get('Rech_nom_dossier');
        $hijri_date = $request->get('Rech_hijri_date');
        $Date_debut = $request->get('Rech_date_debut');
        $Date_fin = $request->get('Rech_date_fin');
        // ----------------------------------------index & search gestion dossiers-----------------------------------
        $Liste_gestion_dossiers = gestion_dossiers::where('gestion_dossier.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($hijri_date, $nom_dossier, $Date_debut, $Date_fin) {
                if (!empty($hijri_date)) {
                    $query->where('gestion_dossier.hijri_date', 'LIKE', $hijri_date . '%');
                }
                if (!empty($nom_dossier)) {
                    $query->where('gestion_dossier.nom_dossier', 'LIKE', $nom_dossier . '%');
                }
                if (!empty($Date_debut)) {
                    $query->where('gestion_dossier.Date_debut', 'LIKE', $Date_debut . '%');
                }
                if (!empty($Date_fin)) {
                    $query->where('gestion_dossier.Date_fin', 'LIKE', $Date_fin . '%');
                }
            });
        if ($Liste_gestion_dossiers != null) {
            return response()->json([
                'pagination' => $pagination ?? 20,
                'Rech_gestion_dossiers' => $Liste_gestion_dossiers,
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
    // list prg
    // public function list_prg($id)
    // {
    //     $gestion_programmes = gestion_programmes::where('FK_dossier', $id)->get();
    //     return view('gestion_dossier/liste_prog');
    //     // if ($gestion_programmes != null) {
    //     //     return response()->json([
    //     //         'liste_programmes' => $gestion_programmes,
    //     //         'status' => 200,
    //     //         'message' => 'Existe',
    //     //     ]);
    //     // } else {
    //     //     return response()->json([
    //     //         'status' => 400,
    //     //         'errors' => 'N\éxiste pas',
    //     //     ]);
    //     // }
    // }

    // public function liste_pro_data($id)
    // {
    //     $gestion_programmes = gestion_programmes::where('FK_dossier', $id)->get();
    //     if ($gestion_programmes != null) {
    //         return response()->json([
    //             'liste_programmes' => $gestion_programmes,
    //             'status' => 200,
    //             'message' => 'Existe',
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 400,
    //             'errors' => 'N\éxiste pas',
    //         ]);
    //     }
    // }
    //Affiche le formulaire de creation de gestion_dossiers
    public function create()
    {

        $Liste_Fiche_client = gestion_dossiers::all();
        return view('gestion_dossier/create_dossier', [
            'countListeFiche_client' => $Liste_Fiche_client->count(),
            'listes_Fiche_client' => $Liste_Fiche_client
        ]);
        // return view('gestion_dossier.create');
    }
    //Enregister gestion_dossiers
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nom_dossier' => 'required',
                'hijri_date' => 'required',
                'date_debut' => 'required',
                'date_fin' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $gestion_dossiers = new gestion_dossiers();
                $gestion_dossiers->nom_dossier = $request->input('nom_dossier');
                $gestion_dossiers->hijri_date = $request->input('hijri_date');
                // $gestion_dossiers->Date_debut = explode('-', $request->input('date_dossier'))[0];
                // $gestion_dossiers->Date_fin = explode('-', $request->input('date_dossier'))[1];
                $gestion_dossiers->Date_debut = $request->input('date_debut');
                $gestion_dossiers->Date_fin = $request->input('date_fin');
                $gestion_dossiers->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Votre demande a été bien envoyée.',
                ]);
            }
            //    dd( explode('-',$request->input('date_dossier'))[1]);

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non email_clienter le service IT')
                ->withInput();
        }
    }
    // info for updatingthe dossier
    public function info_update_dossier($id)
    {
        $dossier = gestion_dossiers::where('id', $id)->get();
        if ($dossier != null) {
            return response()->json([
                'dossier' => $dossier,
                'status' => 200,
                'message' => 'dossier existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'dossier n\existe pas',
            ]);
        }
    }

    //permet de récupérer un gestion_dossiers
    public function edit()
    {
    }
    // permet de modifier gestion_dossiers
    public function update(Request $request)
    {
        try {
            $Gestion_dossier_update = gestion_dossiers::where('id', $request->up_id_dossier)->first();
            $Gestion_dossier_update->nom_dossier = $request->up_nom_dossier;
            $Gestion_dossier_update->hijri_date = $request->up_hijri_date;
            $Gestion_dossier_update->Date_debut = $request->up_date_debut;
            $Gestion_dossier_update->Date_fin = $request->up_date_fin;
            $Gestion_dossier_update->save();
            return response()->json([
                'status' => 200,
                'message' => 'Modification avec succès',
            ]);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non Contacter le service IT')
                ->withInput();
        }
    }
    // permet de supprimer gestion_dossiers
    public function destroy(Request  $request)
    {
        try {
            $check = gestion_dossiers::where('id', $request->delet_id_dossier)->first();
            if ($check != null) {
                $niveauurgence = gestion_dossiers::find($request->delet_id_dossier);
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
}
