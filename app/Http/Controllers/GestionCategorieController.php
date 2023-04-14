<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\gestion_Categorie;
use App\Models\gestion_type_categories;

class GestionCategorieController extends Controller
{
    // public function store(Request $request)
    // {
    //     dd($request);
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'num_categorie' => 'required',
    //             'nom_categorie' => 'required',
    //             'nbr_pax' => 'required',
    //             'remis' => 'required',
    //             'date_categorie' => 'required',
    //             'type' => 'required',
    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 400,
    //                 'errors' => $validator->messages(),
    //             ]);
    //         } else {
    //             $store_Categorie = new gestion_Categorie();
    //             $store_Categorie->num_categorie = $request->input('num_categorie');
    //             $store_Categorie->nom_categorie = $request->input('nom_categorie');
    //             $store_Categorie->Nbre_pax = $request->input('nbr_pax');
    //             $store_Categorie->remis = $request->input('remis');
    //             $store_Categorie->date = $request->input('date_categorie');
    //             $store_Categorie->FK_type  = $request->input('type');
    //             $store_Categorie->save();

    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Votre demande a été bien envoyée.',
    //             ]);
    //         }
    //     } catch (\Exception $e) {

    //         return redirect()
    //             ->back()
    //             ->with('danger', 'Merci de vérifier la connexion internet, si non email_clienter le service IT')
    //             ->withInput();
    //     }
    // }

    
}
