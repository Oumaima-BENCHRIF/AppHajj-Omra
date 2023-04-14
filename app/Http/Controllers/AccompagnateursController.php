<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accompagnateurs;
use App\Http\Requests\accompagnateursPostRequest;
use App\Models\Products;
class AccompagnateursController extends Controller
{
    
  
      //Lister les Accompagnateurs
      public function index(Request $request){
        $page = $request->page ?? 0;
        $code = $request->get('code__');
        $nom_prenom = $request->get('nom_prenom__');
        $fax = $request->get('fax__');
        $adresse = $request->get('adresse__');
        $telephone = $request->get('telephone');
        $prix = $request->get('prix');

        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
        $Liste_Accompagnateurs = Accompagnateurs::where('accompagnateurs.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($code, $nom_prenom, $fax, $adresse, $telephone, $prix) {
                if (!empty($code)) {
                    $query->where('accompagnateurs.code', 'LIKE', $code . '%');
                }
                if (!empty($nom_prenom)) {
                    $query->where('accompagnateurs.nom_prenom', 'LIKE', $nom_prenom . '%');
                }
                if (!empty($fax)) {
                    $query->where('accompagnateurs.fax', 'LIKE', $fax . '%');
                }
                if (!empty($adresse)) {
                    $query->where('accompagnateurs.adresse', 'LIKE', $adresse . '%');
                }
                if (!empty($prix)) {
                    $query->where('accompagnateurs.prix', 'LIKE', $prix . '%');
                }
                if (!empty($telephone)) {
                    $query->where('accompagnateurs.telephone', 'LIKE', $telephone . '%');
                }

            });
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_Accompagnateurs/create_Accompagnateurs', [
            'page' => $page,
            'pagination' => $pagination ?? 20,
            'countListeAccompagnateurs' => $Liste_Accompagnateurs->count(),
            'listes_Accompagnateurs' => $Liste_Accompagnateurs->paginate($pagination ?? 20),
            
        ])
            ->with($request->all());


        // $Liste_Accompagnateurs= Accompagnateurs::all();
        // return view('gestion_accompagnateurs.index',[
        //     'listes_Accompagnateurs'=>$Liste_Accompagnateurs
        //     ]);
    }
    //Affiche le formulaire de creation de Accompagnateurs
    public function Accompagnateurs_Liste(){

        $Liste_Accompagnateur = Accompagnateurs::all(); 
        return response()->json([
   
            'Liste_Accompagnateur' => $Liste_Accompagnateur
        ]);



        // $Liste_Accompagnateurs= Accompagnateurs::all();
        // return view('gestion_accompagnateurs.create',[
        //     'countListeAccompagnateurs' => $Liste_Accompagnateurs->count(),
        //     'listes_Accompagnateurs'=>$Liste_Accompagnateurs
        //     ]);
        // return view('gestion_accompagnateurs.create');
    }
    //Enregister Accompagnateurs
    public function store(Request $request ){

        try{
            
            $Accompagnateurs=new Accompagnateurs();
            $Accompagnateurs->code=$request->input('code');
            $Accompagnateurs->nom_prenom=$request->input('nom_prenom');
            $Accompagnateurs->telephone=$request->input('telephone');
            $Accompagnateurs->fax=$request->input('fax');
            $Accompagnateurs->adresse=$request->input('adresse');
            $Accompagnateurs->prix=$request->input('prix');
            dd($Accompagnateurs);
            $Accompagnateurs->save();
    
          
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
  }  // 
    public function infos($id)
    {
        $Accompagnateur_infos = Accompagnateurs::where('id', $id)->get();
        return response()->json([
            'Accompagnateur_infos' => $Accompagnateur_infos
        ]);
    }

    //permet de récupérer un Accompagnateurs
    public function edit(){

    }
    // permet de modifier Accompagnateurs
    public function update(Request $request){
        try{
            $Accompagnateurs_update=Accompagnateurs::where('id',$request->id__)->first();
       
            $Accompagnateurs_update->code=$request->_code;
            $Accompagnateurs_update->nom_prenom=$request->_nom_prenom;
            $Accompagnateurs_update->adresse=$request->_adresse;
            $Accompagnateurs_update->fax=$request->_fax;
            $Accompagnateurs_update->telephone=$request->_telephone;
            $Accompagnateurs_update->prix=$request->_prix;
            $Accompagnateurs_update->save();
            session()->flash('success', 'Agent a été bien modifiée');
            return back();
         

        }catch (\Exception $e) {
           
            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    // permet de supprimer Accompagnateurs
    public function destroy(Request  $request){
        
        $check=Accompagnateurs::where('id',$request->__id)->first();
        if($check!=null){
            $niveauurgence = Accompagnateurs::find($request->__id);
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
