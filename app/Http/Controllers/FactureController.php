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
use App\Models\Gestion_chambres;
use App\Models\gestion_programmes;
use Cmixin\Numero\Locale as Numero;
use Cmixin\Numero\Locale;
use Symfony\Component\Console\Input\Input;

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
     
       $Detail_Fiche_Insc = Gestion_detail_fiches_inscriptions::select('gestion_detail_fiches_inscriptions.*')
       ->join('gestion_fiches_inscriptions','gestion_fiches_inscriptions.id','gestion_detail_fiches_inscriptions.Fk_fiche_inscription')
       ->where('gestion_detail_fiches_inscriptions.deleted_at', '=', NULL)
       ->where('gestion_fiches_inscriptions.id', $fiche)
       ->get();

    $programe = gestion_programmes::select('gestion__programmes.nom_programme','gestion__programmes.type_programme','gestion_vole__deeparts.date_depart','gestion_vole__reetours.date_retour')
    ->join('gestion_detail_fiches_inscriptions','gestion__programmes.id','gestion_detail_fiches_inscriptions.FK_programme')
    ->join('gestion_vole__deeparts','gestion__programmes.FK_Num_vole_depart','gestion_vole__deeparts.id')
    ->join('gestion_vole__reetours','gestion__programmes.FK_Num_vole_retour','gestion_vole__reetours.id')
    ->join('gestion_fiches_inscriptions','gestion_fiches_inscriptions.id','gestion_detail_fiches_inscriptions.Fk_fiche_inscription')
 ->where('gestion_fiches_inscriptions.id', $fiche)
 ->get();
   
        return view('gestion_Facturation/create_facture',[
            'id'=>$id,
            'data2'=>$gestion,
            'numdossier'=>$numdossier,
            'numfacture'=>$numfacture,
            'Detail_Fiche'=>$Detail_Fiche_Insc,
            'societe'=>$info_sociéte,
            'programme'=>$programe->first(),
            'exist'=>$exist
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
   
    public function print($id){
       
       $value=$id;
     
      $info_facture=Factures::where('factures.deleted_at', '=', NULL)
    ->where('factures.fk_fiche',$value)
    ->get();
    $detail_facture=Detail_factures::where('detail_factures.deleted_at', '=', NULL)
    ->where('detail_factures.FK_Facture',$value);
  
   


        $pdf = PDF::loadView('myPDF',[
          'info_facture'=>$info_facture ,
          'detail_facture'=>$detail_facture

        ]);

        return $pdf->download('facture.pdf');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        for ($i = 0; $i < $count; $i++) {
            $detail=new Detail_factures();
            $detail->nom_complet =$mylis[$i]['col0'];
          
            $detail->prix = $mylis[$i]['col3'];
            $detail->FK_Facture= $request->input('numfichier');
            
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
