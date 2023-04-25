<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TosPostRequests;
use App\Models\Tos;
use App\Models\Villes;

class TosController extends Controller
{
    //Lister les Tos
    public function index(Request $request)
    {
        $page = $request->page ?? 0;
        $code = $request->get('__code__');
        $nom = $request->get('__nom__');
        $telephone = $request->get('__telephone__');
        $fax = $request->get('__fax__');
        $ville = $request->get('__ville__');
        $villes = Villes::get();

        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
        $Liste_Tos = Tos::where('tos.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($code, $nom, $telephone, $fax, $ville) {
                if (!empty($code)) {
                    $query->where('tos.code', 'LIKE', $code . '%');
                }
                if (!empty($nom)) {
                    $query->where('tos.nom', 'LIKE', $nom . '%');
                }
                if (!empty($telephone)) {
                    $query->where('tos.telephone', 'LIKE', $telephone . '%');
                }
                if (!empty($fax)) {
                    $query->where('tos.fax', 'LIKE', $fax . '%');
                }
                if (!empty($ville)) {
                    $query->where('tos.ville', 'LIKE', $ville . '%');
                }
            });
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_To/create_To', [
            'page' => $page,
            'pagination' => $pagination ?? 20,
            'countListeTos' => $Liste_Tos->count(),
            'listes_Tos' => $Liste_Tos->paginate($pagination ?? 20),
            'villes' => $villes

        ])
            ->with($request->all());
    }
    //Affiche le formulaire de creation de Tos
    public function liste()
    {
        $Liste_Tos = Tos::select('tos.*','villes.nom as nom_Ville')
        ->where('tos.deleted_at', '=', NULL)
             ->join('villes', 'tos.FK_ville', 'villes.id')
            ->orderBy("id", "desc")->get();
           
        return response()->json([
            'Liste_Tos' => $Liste_Tos,
            'countListeTos' => $Liste_Tos->count(),
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);

    }
    //Enregister Tos
    public function store(TosPostRequests $request)
    {

        try {

            $Tos = new Tos();
            $Tos->code = $request->input('code');
            $Tos->nom = $request->input('nom');
            $Tos->telephone = $request->input('telephone');
            $Tos->fax = $request->input('fax');
            $Tos->FK_ville = $request->input('ville');

            $Tos->save();

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
    public function infos(Request $request)
    {
        $niveaux = Tos::where('id', $request->id)->first();
        return response()->json([
            'to_s' => $niveaux
        ]);
    }

    //permet de récupérer un Tos
    public function edit()
    {
    }
    // permet de modifier Tos
    public function update(Request $request)
    {

        try {

            $Tos_update = Tos::where('id', $request->up_id_to)->first();

            $Tos_update->code = $request->up_code_to;
            $Tos_update->nom = $request->up_nom_to;
            $Tos_update->telephone = $request->up_telephone_to;
            $Tos_update->fax = $request->up_fax_to;
            $Tos_update->FK_ville = $request->up_ville_to;

            $Tos_update->save();

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
    // permet de supprimer Tos
    public function destroy(Request  $request)
    {
        try {
            $check = Tos::where('id', $request->id_TOs)->first();
            if ($check != null) {
                $niveauurgence = Tos::find($request->id_TOs);
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
                ->with('danger', 'Merci de vérifier la connexion internet, si non email_clienter le service IT')
                ->withInput();
        }
    }

    // info for updatingthe dossier
    public function info_To($id)
    {
        $info_To = Tos::where('id', $id)->get();
        if ($info_To != null) {
            return response()->json([
                'info_To' => $info_To,
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
}
