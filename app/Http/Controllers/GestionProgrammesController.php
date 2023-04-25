<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gestion_programmes;
use App\Models\gestion_dossiers;
use App\Models\Gestion_itineraires;

class GestionProgrammesController extends Controller
{
    public function index()
    {
        
        return view('gestion_dossier/liste_prog');
    }
    // info for updatingthe dossier
    public function info_prog($id)
    {
        $prg = gestion_programmes::where('id', $id)->get();
      
        if ($prg != null) {
            return response()->json([
                'programme' => $prg,
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
    // Liste G.itineraires 
    public function liste_itineraires()
    {
        $liste_itineraires = Gestion_itineraires::all();
        if($liste_itineraires!=null){
            return response()->json([
                'liste_itineraires' => $liste_itineraires,
                'status' => 200,
                'message' => 'Existe',
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'errors' => 'N\éxiste pas',
            ]);
        }
       
    }
    public function liste_pro_data($id)
    {
        $gestion_programmes = gestion_programmes::select('gestion_dossier.*','gestion__programmes.*',"gestion__programmes.id as id_prg",'gestion_dossier.id as id_dossier')
        ->join('gestion_dossier', 'gestion__programmes.FK_dossier', '=', 'gestion_dossier.id')
        ->where('gestion__programmes.FK_dossier', $id)
        ->get();
       
        $Dossier = gestion_dossiers::where('id', $id)->get();
        
        session()->put('Dossier', $Dossier);
        session()->put('projet_id______', $id);
        if ($gestion_programmes != null) {
            return response()->json([
                'liste_programmes' => $gestion_programmes,
                'Dossier' => $Dossier,
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
    public function destroy(Request  $request)
    {
        try {
            $check = gestion_programmes::where('id', $request->delet_id_prg)->first();
            if ($check != null) {
                $niveauurgence = gestion_programmes::find($request->delet_id_prg);
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
     public function update(Request $request)
     {
         try {
             $Gestion_dossier_update = gestion_programmes::where('id', $request->up_id_prg)->first();
             $Gestion_dossier_update->nom_programme = $request->nom_programme;
             $Gestion_dossier_update->type_programme = $request->type_programme;
             $Gestion_dossier_update->nbr_nuitee_prog_mdina = $request->nbr_nuitee_prog_mdina;
             $Gestion_dossier_update->nbr_nuitee_prog_maka = $request->nbr_nuitee_prog_maka;
             $Gestion_dossier_update->FK_Num_vole_depart  = $request->num_vole_dep;
             $Gestion_dossier_update->Nbr_place_aller  = $request->nbr_place_aller;
             $Gestion_dossier_update->Nbr_reserver_depart  = $request->nbr_reserver_dep;
             $Gestion_dossier_update->FK_Num_vole_retour   = $request->num_vole_retour;
             $Gestion_dossier_update->Nbr_place_retour  = $request->nbr_place_retour;
             $Gestion_dossier_update->Nbr_reserver_retour  = $request->nbr_reserver_retour;
             $Gestion_dossier_update->FK_dossier  = $request->up_FK_dossier;
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
}