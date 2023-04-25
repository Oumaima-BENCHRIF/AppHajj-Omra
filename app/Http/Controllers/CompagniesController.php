<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compagnies;
use App\Http\Requests\compagniesPostRequest;

class CompagniesController extends Controller
{
   
   //Lister les Compagnies
   public function index(Request $request){
    $page = $request->page ?? 0;
    $code_cie = $request->get('code_cie__');
    $compagnie = $request->get('compagnie__');
    $fax = $request->get('fax__');
    $adresse = $request->get('adresse__');
    $telephone = $request->get('telephone__');
    $directeur = $request->get('directeur__');
    $tel_directeur = $request->get('tel_directeur__');
    $nom_en_arabe = $request->get('nom_en_arabe__');
    $compte_comptable_BSP = $request->get('compte_comptable_BSP__');
    $compte_comptable_normal = $request->get('compte_comptable_normal__');

    // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
    $Liste_Compagnies = Compagnies::where('Compagnies.deleted_at', '=', NULL)
        ->orderBy("id", "desc")
        ->where(function ($query) use ($code_cie, $compagnie, $fax, $adresse, $telephone, $directeur, $tel_directeur,$nom_en_arabe,$compte_comptable_BSP, $compte_comptable_normal ) {
            if (!empty($code_cie)) {
                $query->where('Compagnies.code_cie', 'LIKE', $code_cie . '%');
            }
            if (!empty($compagnie)) {
                $query->where('Compagnies.compagnie', 'LIKE', $compagnie . '%');
            }
            if (!empty($fax)) {
                $query->where('Compagnies.fax', 'LIKE', $fax . '%');
            }
            if (!empty($adresse)) {
                $query->where('Compagnies.adresse', 'LIKE', $adresse . '%');
            }
            if (!empty($directeur)) {
                $query->where('Compagnies.directeur', 'LIKE', $directeur . '%');
            }
            if (!empty($telephone)) {
                $query->where('Compagnies.telephone', 'LIKE', $telephone . '%');
            }
            if (!empty($tel_directeur)) {
             $query->where('Compagnies.tel_directeur', 'LIKE', $tel_directeur . '%');
            }
             if (!empty($nom_en_arabe)) {
                $query->where('Compagnies.nom_en_arabe', 'LIKE', $nom_en_arabe . '%');
             }
          if (!empty($compte_comptable_BSP)) {
             $query->where('Compagnies.compte_comptable_BSP', 'LIKE', $compte_comptable_BSP . '%');
             }
             if (!empty($compte_comptable_normal)) {
                $query->where('Compagnies.compte_comptable_normal', 'LIKE', $compte_comptable_normal . '%');
                }

        });
    // -------------------------------------------------------------------------------------------------------------------------
    // dd($listeDemandes->paginate($pagination ?? 20));
    return view('gestion_Compagnies.create_Compagnies', [
        'page' => $page,
        'pagination' => $pagination ?? 20,
        'countListeCompagnies' => $Liste_Compagnies->count(),
        'listes_Compagnies' => $Liste_Compagnies->paginate($pagination ?? 20),
        
    ])
        ->with($request->all());


    // $Liste_Compagnies= Compagnies::all();
    // return view('gestion_compagnies.index',[
    //     'listes_Compagnies'=>$Liste_Compagnies
    //     ]);
}
//Affiche le formulaire de creation de Compagnies
public function create(){

    $Liste_Compagnies= Compagnies::all();
    return view('gestion_compagnies.create',[
        'countListeCompagnies' => $Liste_Compagnies->count(),
        'listes_Compagnies'=>$Liste_Compagnies
        ]);
    // return view('gestion_compagnies.create');
}
//Enregister Compagnies
public function store(compagniesPostRequest $request ){

    try{
        
        $Compagnies=new Compagnies();
        $Compagnies->code_cie=$request->input('code_cie');
        $Compagnies->compagnie=$request->input('compagnie');
        $Compagnies->telephone=$request->input('telephone');
        $Compagnies->fax=$request->input('fax');
        $Compagnies->adresse=$request->input('adresse');
        $Compagnies->directeur=$request->input('directeur');
        $Compagnies->tel_directeur=$request->input('tel_directeur');
        $Compagnies->nom_en_arabe=$request->input('nom_en_arabe');
        $Compagnies->compte_comptable_BSP=$request->input('compte_comptable_BSP');
        $Compagnies->compte_comptable_normal=$request->input('compte_comptable_normal');
        
        $Compagnies->save();

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
    $niveaux = Compagnies::where('id', $request->id)->first();
    return response()->json([
        'compagnies' => $niveaux
    ]);
}
public function infosCompagnie($id)
{
    $infosCompagnie = Compagnies::where('id', $id)->get();
    return response()->json([
        'infosCompagnie' => $infosCompagnie
    ]);
}

//permet de récupérer un Compagnies
public function edit(){

}
// permet de modifier Compagnies
public function update(Request $request){


    $Compagnies_update=Compagnies::where('id',$request->_id_)->first();
 
       $Compagnies_update->code_cie=$request->_code_cie;
       $Compagnies_update->compagnie=$request->_compagnie;
       $Compagnies_update->adresse=$request->_adresse;
       $Compagnies_update->fax=$request->_fax;
       $Compagnies_update->telephone=$request->_telephone;
       $Compagnies_update->directeur=$request->_directeur;
       $Compagnies_update->tel_directeur=$request->_tel_directeur;
       $Compagnies_update->nom_en_arabe=$request->_nom_en_arabe;
       $Compagnies_update->compte_comptable_BSP=$request->_compte_comptable_BSP;
       $Compagnies_update->compte_comptable_normal=$request->_compte_comptable_normal;
       $Compagnies_update->save();
       session()->flash('success', 'Compagnies a été bien modifiée');
       return back();
    

}
public function liste_Compagnies(){

    $liste_Compagnies = Compagnies::all(); 
    return response()->json([

        'liste_Compagnies' => $liste_Compagnies
    ]);

}
// permet de supprimer Compagnies
public function destroy(Request  $request){
    
    $check=Compagnies::where('id',$request->__id)->first();
    if($check!=null){
        $niveauurgence = Compagnies::find($request->__id);
        $niveauurgence->delete();
        return redirect()->back()->with([
            session()->flash('success', 'suppression avec succès'),
        ]);
    }else{
        session()->flash('delete_danger', 'Error');
        return back();
    }
}

}
