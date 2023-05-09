<?php

namespace App\Http\Controllers;
use App\Models\Gestion_Jornal;
use App\Models\Gestion_ModeP;
use App\Models\Gestion_Sens;
use App\Models\Fiche_client;
use App\Models\Factures;
use App\Models\detail_reglement;
use App\Models\Reglement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class G_reglementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $numreglement=$this->NumReglement();
        return view('gestion_reglement/create_reglemet',[
           'numreglement'=>$numreglement,
        ]);
    }
    private function NumReglement()
    {
        $lastRecord = Reglement::latest('id')->first();
       
        if($lastRecord!=null)
        {
        $num=$lastRecord->N_reglement;
        $conteur =substr($num,6);
       
        $conteur += 1;
        $result = sprintf('%04d', $conteur);
        
       $code= 'RL'.Carbon::now()->year.$result;
       return $code;
        }
        else
        {
            return 'RL'.Carbon::now()->year.'0001';
        }

    }

    

    public function liste_jornal()
    {
        $Liste_jornal = Gestion_Jornal::select('gestion_jornal.designation')
        
        ->where('gestion_jornal.deleted_at', '=', NULL)
        ->get(); 

        return response()->json([
            'Liste_jornal'=> $Liste_jornal,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    
    }
 
    public function liste_ModeP()
    {
        $Liste_ModeP = Gestion_ModeP::select('gestion_mode_paiement.designation')
        
        ->where('gestion_mode_paiement.deleted_at', '=', NULL)
        ->get(); 

        return response()->json([
            'Liste_ModeP'=> $Liste_ModeP,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    
    }
    public function liste_client()
    {
        $Liste_client = Fiche_client::select('fiche_clients.nom')
      
        ->where('fiche_clients.deleted_at', '=', NULL)
        ->get(); 

        return response()->json([
            'Liste_client'=> $Liste_client,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    
    }
    public function liste_Sens()
    {
        $liste_Sens = Gestion_Sens::select('gestion_sens.designation')
        
        ->where('gestion_sens.deleted_at', '=', NULL)
        ->get(); 

        return response()->json([
            'liste_Sens'=> $liste_Sens,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    
    }
   
    public function store(Request $request)
    {   $user = Auth::user(); 
        $username = $user->name; 
        $reglement = new Reglement();
        $reglement->N_reglement = $request->input('N_reglement');
        $reglement->date_r = $request->input('date_reglement');
        $reglement->jornal = $request->input('jornal');  
        $reglement->client = $request->input('client');
        $reglement->n_piece = $request->input('n_piece');
        $reglement->mode = $request->input('mode');
        $reglement->sens = $request->input('sens');
        $reglement->societe = $request->input('Succursales');
        $reglement->montant = $request->input('Montant');
        $reglement->libelle = $request->input('libelle');
        $reglement->m_reglement = $request->input('M_reglement');
        $reglement->utilisateur =  $username;
      
        $reglement->save();
        return response()->json([
            'reglement'=>$reglement->N_reglement,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    public function Store_detailF(Request $request)
    {
        $detail_regle = new detail_reglement();
        $detail_regle->num_reglement =$request->input('N_reglement2');
        $detail_regle->num_factures  =$request->input('factures');
       $detail_regle->save();
       $facture= Factures::select('factures.*')
       ->where('factures.id', '=', $request->input('factures'))
       ->first();
       if ( $facture !== null) {
        $total = floatval($facture->Total);
    } 
       $line_regle = Reglement::where('N_reglement',  $request->input('N_reglement2'))->first();
if ($line_regle !== null) {
    $montant = floatval($line_regle->montant);
} 
    $line_regle->montant=$montant-$total;
       $line_regle->save();
        return response()->json([
            'reglement'=> $detail_regle->num_reglement,
            'line_regle'=> $line_regle,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    public function detail_regle($num_regle)
    {
        $liste_regle = detail_reglement::select('factures.*')
        ->join('factures', 'detail_reglement.num_factures', '=', 'factures.id')
        ->where('detail_reglement.num_reglement', '=', $num_regle)
        ->where('detail_reglement.deleted_at', '=', NULL)
        ->get();
        return response()->json([
            'liste_regle'=> $liste_regle,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    public function line_regle($num_regle)
    {
         $line_regle = Reglement::where('gestion_reglement.N_reglement', '=', $num_regle)
        ->where('gestion_reglement.deleted_at', '=', NULL)
        ->get();
        return response()->json([
            'line_regle'=> $line_regle,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    public function print($num){
       
     
      
    $regleement=Reglement::where('gestion_reglement.N_reglement', '=', $num);
          $pdf = PDF::loadView('reglement',[
            'regleement'=>$regleement ,
           
  
          ]);
  
          return $pdf->download('facture.pdf');
      
      }
   
    public function regle()
    {
        return view('reglement');
    }
}
