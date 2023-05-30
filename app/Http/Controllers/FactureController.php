<?php

namespace App\Http\Controllers;


use App\Models\Gestion_detail_fiches_inscriptions;
use App\Models\gestion_dossiers;
use App\Models\Fiche_client;
use App\Models\gestion_fiches_inscription;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Factures;
use App\Models\Detail_factures;
use App\Models\lettrage_fact;
use App\Models\Reglement;
use App\Models\Gestion_chambres;
use App\Models\gestion_programmes;
use Cmixin\Numero\Locale as Numero;
use Cmixin\Numero\Locale;
use Symfony\Component\Console\Input\Input;
use App\Models\Agents;
use Attribute;
use Illuminate\Support\Facades\DB;
use App\Models\Agence;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //generate num facture
    private function NumFacture()
    {
        $lastRecord = Factures::latest('id')->withTrashed()->first();;
       
        if($lastRecord!=null)
        {
        $num=$lastRecord->numero_facture;
        $conteur =substr($num,6);
       
        $conteur += 1;
        $result = sprintf('%04d', $conteur);
        
       $code= 'FT'.Carbon::now()->year.$result;
       return $code;
        }
        else
        {
            return 'FT'.Carbon::now()->year.'0001';
        }

    }
    // private function  pritToword()
    // {
    //     $totalPrice = 400;

    //  // Set the locale to French
    //    Numero::setLocale('fr');

    //   // Convert the numerical value to its word representation in French
    //      $priceInWords = Numero::toWords($totalPrice);

    //  // Capitalize the first letter of the words and add the currency
    //     $priceInWords = ucfirst($priceInWords) . ' dollars';

    //  // Output the result
    //      echo "Price: $totalPrice ($priceInWords)";
    // }
    public function index($id)
    { 
        
       $fiche=$id;
       $facture=Factures::where('factures.fk_fiche',$fiche);
       $exist=false;
    
       if($facture->count()!=0)
       {
        $exist=true;
       }
         $numfacture=$this->NumFacture();
       $gestion = gestion_fiches_inscription::where('gestion_fiches_inscriptions.id', $fiche)->get();
      
       $numdossier=gestion_dossiers::select('gestion_dossier.num_dossier')
       ->join('gestion__programmes', 'gestion__programmes.FK_dossier', 'gestion_dossier.id')
       ->where('gestion_fiches_inscriptions.deleted_at', '=', NULL)
       ->where('gestion__programmes.deleted_at', '=', NULL)
       ->join('gestion_fiches_inscriptions', 'gestion_fiches_inscriptions.FK_programme', 'gestion__programmes.id')
       ->where('gestion_fiches_inscriptions.id', $fiche)
       ->get();
      
       $info_sociéte=Fiche_client::select('fiche_clients.nom','fiche_clients.adresse','fiche_clients.ville_client')
       ->join('gestion_fiches_inscriptions', 'gestion_fiches_inscriptions.FK_societe', 'fiche_clients.id')
       ->where('gestion_fiches_inscriptions.id', $fiche)
       ->get();
       $Detail_Fiche_Insc =  DB::table('Gestion_detail_fiches_inscriptions')
       ->selectRaw('CONCAT(	nom_client, " ", prenom_client) AS nom_complet,prix')
       ->get();
       $Detail_Fiche_Insc = Gestion_detail_fiches_inscriptions::select('gestion_detail_fiches_inscriptions.prix','gestion_detail_fiches_inscriptions.nom_client','gestion_detail_fiches_inscriptions.prenom_client')
       ->join('gestion_fiches_inscriptions','gestion_detail_fiches_inscriptions.Fk_fiche_inscription','gestion_fiches_inscriptions.id')
       ->where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
       ->where('gestion_fiches_inscriptions.deleted_at', '=', NULL)
       ->where('gestion_fiches_inscriptions.id', $fiche)
       ->get();
       $Total=0;
       foreach ($Detail_Fiche_Insc as $key ) {
        $Total= $Total + $key->Totale_prg;
        }
   
      $programe = gestion_programmes::select('gestion__programmes.nom_programme','gestion__programmes.type_programme','gestion_vole__deeparts.date_depart','gestion_vole__reetours.date_retour')
      ->join('gestion_detail_fiches_inscriptions','gestion__programmes.id','gestion_detail_fiches_inscriptions.FK_programme')
      ->join('gestion_vole__deeparts','gestion__programmes.FK_Num_vole_depart','gestion_vole__deeparts.id')
      ->join('gestion_vole__reetours','gestion__programmes.FK_Num_vole_retour','gestion_vole__reetours.id')
      ->join('gestion_fiches_inscriptions','gestion_fiches_inscriptions.id','gestion_detail_fiches_inscriptions.Fk_fiche_inscription')
      ->where('gestion_fiches_inscriptions.id', $fiche)
      ->get();
  
        return view('gestion_Facturation/create_facture',[
            'id'=>$id,
            'code_client'=>$gestion->Code_client,
            'bon_commande'=>$gestion->bon_commande,
            'date'=>Carbon::now()->format('d-m-y'),
            'ville_client'=>$info_sociéte->	ville_client,
            'adresse'=>$info_sociéte->adresse,
            'nom'=>$info_sociéte->nom,
            'numdossier'=>$numdossier,
            'numfacture'=>$numfacture,
            'Detail_Fiche'=>$Detail_Fiche_Insc,
            'designation'=>$programe->nom_programme,
             'date_depart'=>$programe->date_depart,
             'date_retour'=>$programe->date_retour,
            'exist'=>$exist,
            'total'=>$Total
        ]);
    }

    public function consult_facture($num)
    {
       
        $facture=Factures::where('factures.numero_facture',$num)->first();
        $exist=false;
     
        if($facture->count()!=0)
        {
         $exist=true;
        }
        
        $numdossier=$facture->Numero_dossier;
        // $info_sociéte=Factures::select('factures.Nom_client','factures.adresse','factures.ville')
        // ->where('factures.id', $num)
        // ->get();
     
        $detail_factures = detail_factures::select('detail_factures.prix','detail_factures.nom_complet')
        ->where('detail_factures.deleted_at', '=', NULL)
        ->where('detail_factures.FK_Facture', $facture->id)
        ->get();
        $Total=0;
        foreach ($detail_factures as $key ) {
        $Total= $Total + $key->prix;
       }
       $userLogin = Auth::user(); 
       $logo=Agence::select('agence.logo')
       ->where('agence.id',$userLogin->	id_Agence)
       ->First();
      
       $id=1;
         return view('gestion_Facturation/create_facture',[
             'id'=>$id,
             'code_client'=>$facture->Code_client,
             'bon_commande'=>$facture->bon_commande,
             'date'=>$facture->date,
             'ville_client'=>$facture->ville,
             'adresse'=>$facture->adresse,
             'nom'=>$facture->Nom_client,
             'numdossier'=>$numdossier,
             'numfacture'=>$num,
             'Detail_Fiche'=>$detail_factures,
           
             'designation'=>$facture->designation,
             'date_depart'=>$facture->date_departs,
             'date_retour'=>$facture->date_Arrives,
             'exist'=>$exist,
             'total'=>$Total,
             'logo'=>$logo
         ]);
    }
    public function sitation_fact($num)
    {
        $ligne_lettrage=lettrage_fact::where('lettrage_fact.num_factures', '=', $num)
        ->where('lettrage_fact.deleted_at', '=', NULL)
        ->get();
        $facture = Factures::select('factures.*')
        ->where('numero_facture', $num)
        ->first();
        return response()->json([
            'ligne_lettrage'=> $ligne_lettrage,
            'facture'=>$facture,
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
        
    }
   
   
    public function print($id){ 
       $value=$id;
       $userLogin = Auth::user(); 
       $logo=Agence::select('agence.logo')
       ->where('agence.id',$userLogin->	id_Agence)
       ->first();
      
       $info_facture=Factures::where('factures.deleted_at', '=', NULL)
       ->where('factures.fk_fiche',$value)->first();
       $id_fac=$info_facture->id;
       $detail_facture=Detail_factures::where('detail_factures.FK_Facture',$id_fac)
       ->get();
        $pdf = PDF::loadView('myPDF',[
          'info_facture'=>$info_facture ,
          'detail_facture'=>$detail_facture,
          'logo'=>$logo->logo
        ]);
      
        return $pdf->download('facture.pdf');

    }
    public function store(Request $request)
    {
        try {
            $myList = json_decode($request->input('myList'),true);
 
        $Factures=new factures();
        $Factures->Code_client=$request->input('numfichier');
        $Factures->fk_fiche=$request->input('id_fiche');
        $Factures->date=$request->input('date_fiche_inscription');
        $Factures->bon_commande=$request->input('bon_commande');
        $Factures->Numero_dossier=$request->input('num_dossier');
        $Factures->	Total=$request->input('total');
        $Factures->numero_facture=$request->input('numfacture');
        $Factures->Nom_client=$request->input('nom');
        $Factures->adresse=$request->input('adresse');
        $Factures->ville=$request->input('ville_client');
        $Factures->designation=$request->input('designation');
        $Factures->date_Arrives=$request->input('date_retour');
        $Factures->date_departs=$request->input('date_depart');
    
         $Factures->save();
        
        $detail=new Detail_factures();
        
         $count = count($myList['data']);
          $mylis =$myList['data'];
         
        for ($i = 1; $i <$count; $i++) {
          
            $detail=new Detail_factures();
            $detail->nom_complet =$mylis[$i]['col0'];
            
            $detail->FK_Facture= $Factures->id;
            $detail->prix = $mylis[$i]['col3'];;
           
            $detail->save();
          
           
           
        }
        return response()->json([
            'status' => 200,
            'message' => 'Votre demande a été bien envoyée.',
        ]);
    

     } catch (\Exception $e) {

    return redirect()
        ->back()
        ->with('danger', 'Merci de vérifier la connexion internet, si non email_clienter le service IT')
        ->withInput();
}

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function edit($id)
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
