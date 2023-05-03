<?php

namespace App\Http\Controllers;
use App\Models\Gestion_Jornal;
use App\Models\Gestion_ModeP;
use App\Models\Gestion_Sens;
use App\Models\Fiche_client;
use App\Models\Factures;
use App\Models\Reglement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class G_reglementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function NumReglement()
    {
        $lastRecord = Reglement::latest('id')->withTrashed()->first();;
       
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
            return 'FT'.Carbon::now()->year.'0001';
        }

    }
    public function index()
    {
        // $numreglement=$this->NumReglement();
        // dd($numreglement);
        return view('gestion_reglement/create_reglemet',[
            // 'numreglement'=>$numreglement,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
