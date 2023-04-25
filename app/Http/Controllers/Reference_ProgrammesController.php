<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference_Programmes;
use App\Models\Types;

class Reference_ProgrammesController extends Controller
{
    //Lister les Fiche_client
    public function index(Request $request)
    {
        $Types = Types::all();
        

        $page = $request->page ?? 0;
        $N_programme = $request->get('_N_programme');
        $nom_programme = $request->get('_nom_programme');
        $type = $request->get('_type');
        $nbre_nuitees = $request->get('_nbre_nuitees');
        $ref_programme = $request->get('_ref_programme');
        $transfert = $request->get('_transfert');
        $compagnie = $request->get('compagnie__');
        
        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
        $Liste_reference_programmes = Reference_Programmes::where('reference_programmes.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($N_programme, $nom_programme, $type, $nbre_nuitees, $ref_programme, $compagnie, $transfert) {
                if (!empty($N_programme)) {
                    $query->where('reference_programmes.N_programme', 'LIKE', $N_programme . '%');
                }
                if (!empty($nom_programme)) {
                    $query->where('reference_programmes.nom_programme', 'LIKE', $nom_programme . '%');
                }
                if (!empty($type)) {
                    $query->where('reference_programmes.type', 'LIKE', $type . '%');
                }
                if (!empty($nbre_nuitees)) {
                    $query->where('reference_programmes.nbre_nuitees', 'LIKE', $nbre_nuitees . '%');
                }
                if (!empty($ref_programme)) {
                    $query->where('reference_programmes.ref_programme', 'LIKE', $ref_programme . '%');
                }
                if (!empty($compagnie)) {
                    $query->where('reference_programmes.compagnie', 'LIKE', $compagnie . '%');
                }
                if (!empty($transfert)) {
                    $query->where('reference_programmes.transfert', 'LIKE', $transfert . '%');
                }
             
            });
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_reference_programmes/create_reference_programmes', [
            'page' => $page,
            'pagination' => $pagination ?? 20,
            'countListe_reference_programmes' => $Liste_reference_programmes->count(),
            'listes_reference_programmes' => $Liste_reference_programmes->paginate($pagination ?? 20),

        ])
            ->with($request->all());


    }
    //Affiche le formulaire de creation de reference_programmes
    public function create()
    {

        $Liste_reference_programmes = Reference_Programmes::all();
        return view('gestion_reference_programmes/create_reference_programmes', [
            'countListe_reference_programmes' => $Liste_reference_programmes->count(),
            'listes_reference_programmes' => $Liste_reference_programmes
        ]);
      
    }
    //Enregister reference_programmes
    public function store(Request $request)
    {

        try {

            $reference_programmes = new Reference_Programmes();
            $reference_programmes->N_programme = $request->input('N_programme');
            $reference_programmes->nom_programme = $request->input('nom_programme');
            $reference_programmes->type = $request->input('type');
            $reference_programmes->nbre_nuitees = $request->input('nbre_nuitees');
            $reference_programmes->ref_programme = $request->input('ref_programme');
            $reference_programmes->compagnie = $request->input('compagnie');
            $reference_programmes->transfert = $request->input('transfert');
            $reference_programmes->save();

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
    // 
    public function infos(Request $request)
    {
        $niveaux = Reference_Programmes::where('id', $request->id)->first();
        return response()->json([
            'Reference_Programmes' => $niveaux
        ]);
    }

    //permet de récupérer un Reference_Programmes
    public function edit()
    {
    }
    // permet de modifier Reference_Programmes
    public function update(Request $request)
    {

        try {

            $Reference_Programmes_update = Reference_Programmes::where('id', $request->id_)->first();

            $Reference_Programmes_update->N_programme = $request->N_programme__;
            $Reference_Programmes_update->nom_programme = $request->nom_programme__;
            $Reference_Programmes_update->type = $request->type___;
            $Reference_Programmes_update->nbre_nuitees = $request->nbre_nuitees__;
            $Reference_Programmes_update->ref_programme = $request->ref_programme_;
            $Reference_Programmes_update->compagnie = $request->compagnie__;
            $Reference_Programmes_update->transfert = $request->transfert__;
            $Reference_Programmes_update->save();
            session()->flash('success', 'Reference Programmes a été bien modifiée');
            return back();
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non email_clienter le service IT')
                ->withInput();
        }
    }
    // permet de supprimer Reference_Programmes
    public function destroy(Request  $request)
    {

        $check = Reference_Programmes::where('id', $request->__id)->first();
        if ($check != null) {
            $niveauurgence = Reference_Programmes::find($request->__id);
            $niveauurgence->delete();
            return redirect()->back()->with([
                session()->flash('success', 'suppression avec succès'),
            ]);
        } else {
            session()->flash('danger', 'Error');
            return back();
        }
    }
}
