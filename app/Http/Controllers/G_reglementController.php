<?php

namespace App\Http\Controllers;
use App\Models\Gestion_Jornal;
use App\Models\Gestion_ModeP;
use App\Models\Gestion_Sens;
use App\Models\Fiche_client;
use App\Models\Factures;
use App\Models\lettrage_fact;
use App\Models\Reglement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;


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
    public function facture_info(Request $request)
    {
        $invoiceNumber = $request->input('invoice_number');
        
        
        $facture = Factures::select('factures.*')
        ->where('numero_facture', $invoiceNumber)
        ->get();
    
        return response()->json([
        'facture' => $facture,
        'status' => 200,
        'message' => 'Votre demande a été bien envoyée.',
      ]);
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
    public function liste_reglement()
    {
        $Liste_regle= Reglement::distinct()
        ->where('gestion_reglement.deleted_at', '=', NULL)
        ->get(['N_reglement']);
        return response()->json([
            'Liste_regle'=> $Liste_regle,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    
    }
    public function liste_client()
    {
        $Liste_client = Fiche_client::select('fiche_clients.*')
      
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
    { 
        $validator = Validator::make($request->all(), [
            'date_reglement' => 'required',
            'jornal' => 'required',
            'client' => 'required',
            'Montant' => 'required',
            'mode' => 'required',
            'sens' => 'required',
            'libelle' => 'required',
            'M_reglement' => 'required',
            'Montant' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
          $user = Auth::user(); 
        $username = $user->name; 
        $num_reglement=$request->input('num_regl');
        $line_regle = Reglement::where('N_reglement',$num_reglement)->get();
        $Nligne=1;
      
        if($line_regle->count()>0)
        {
            $Nligne=$line_regle->count()+1;
            
        }
        $reglement = new Reglement();
        $reglement->N_reglement = $num_reglement;
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
        $reglement->rest_reglement = $request->input('Montant');
        $reglement->utilisateur =  $username;
        $reglement->Nligne =  $Nligne;
        $reglement->save();
        return response()->json([
            'reglement'=>$reglement->N_reglement,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    }
    public function Store_detailF(Request $request)
    {
        $id= $request->input('id');
        $num= $request->input('num');
        $detail_regle = new lettrage_fact();
        $line_regle = Reglement::where('id',$id)->first();
        $detail_regle->num_reglement =$num;
        $detail_regle->id_regle =$id;
        $detail_regle->Nligne =$line_regle->Nligne;
        $detail_regle->num_factures  =$request->input('factures');
        $detail_regle->Acompte  =$request->input('Acompte');
        $detail_regle->	Code_clt  =$line_regle->client;
        $detail_regle->Date_Let  =Carbon::now();
        $detail_regle->save();
        $facture= Factures::select('factures.*')
       ->where('factures.numero_facture', '=', $request->input('factures'))
       ->first();
       if ( $facture !== null) {
        $TotalR=floatval($facture->Total_regler);
        $facture->Total_regler=$TotalR+floatval($request->input('Acompte'));
        $facture->save();
     } 
      
       $Acompte=$request->input('Acompte');
      if ($line_regle !== null) {
       $rest_reglement = floatval($line_regle->rest_reglement);
      } 
       $line_regle->rest_reglement=$rest_reglement-$Acompte;
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
        $liste_regle = lettrage_fact::select('lettrage_fact.*')
        ->where('lettrage_fact.num_reglement', '=', $num_regle)
        ->where('lettrage_fact.deleted_at', '=', NULL)
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
    public function info_regle(Request $request)
    {
        $num_regle= $request->input('number');

         $line_regle = Reglement::where('gestion_reglement.N_reglement', '=', $num_regle)
        ->where('gestion_reglement.deleted_at', '=', NULL)
        ->get();
        
        $ligne_detail=lettrage_fact::where('lettrage_fact.num_reglement', '=', $num_regle)
        ->where('lettrage_fact.deleted_at', '=', NULL)
        ->get();
        
        return response()->json([
            'line_regle'=> $line_regle,
            'ligne_detail'=>$ligne_detail,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    }
    public function print($num){
       
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');
      
        $info_Reglement=Reglement::where('gestion_reglement.deleted_at', '=', NULL)
        ->where('gestion_reglement.N_reglement',$num)->get();
          $pdf = PDF::loadView('reglement',[
            'regleement'=>$info_Reglement ,
            'date'=> $formattedDate,
            'numero'=>$num
          ]);  
  
          return $pdf->download('reglement.pdf');
      
      }
   
    // public function regle($num)
    // {
    //     $info_Reglement=Reglement::where('gestion_reglement.deleted_at', '=', NULL)
    //     ->where('gestion_reglement.N_reglement',$num)->first();
      
    //     $pdf = PDF::loadView('reglement'[
    //         'reglement'=>$info_Reglement,
    //     ]);
    //     return $pdf->download('facture.pdf');
        
    // }
}
