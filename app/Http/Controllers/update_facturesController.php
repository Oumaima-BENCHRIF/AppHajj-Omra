<?php

namespace App\Http\Controllers;
use App\Models\Factures;
use App\Models\Detail_factures;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class update_facturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $facture=Factures::where('factures.deleted_at', '=', NULL)
        ->where('factures.id',$id)
        ->get();
       
        $detail_facture=Detail_factures::
         where('detail_factures.FK_Facture',$id)
        ->get();
       
        return view('gestion_Facturation/update_facture', [
              'facture'=>$facture,
              'detail_facture'=>$detail_facture
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_facture($id)
    {
        $facture=Factures::where('factures.deleted_at', '=', NULL)
        ->where('factures.id',$id)
        ->get();
        return response()->json([
            'facture' => $facture,
           
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
    public function print($id){
       
     
      
       $info_facture=Factures::where('factures.deleted_at', '=', NULL)
     ->where('factures.id',$id)->first();
     
   
     
     $detail_facture=Detail_factures::where('detail_factures.FK_Facture',$id)
     ->get();
         $pdf = PDF::loadView('myPDF',[
           'info_facture'=>$info_facture ,
           'detail_facture'=>$detail_facture
 
         ]);
 
         return $pdf->download('facture.pdf');
     
     }
    public function update(Request $request)
    {
        try {
            $myList = json_decode($request->input('myList'),true);
            $count = count($myList['data']);
    
            $mylis =$myList['data'];

        $Factures=factures::where('id', $request->_id)->first();
        $Factures->date=$request->input('date');
      
        $Factures->bon_commande=$request->input('bon_commande');

        $Factures->Nom_client=$request->input('Nom_client');
        $Factures->adresse=$request->input('adresse');
        $Factures->ville=$request->input('ville');
        $Factures->designation=$mylis[0]['col0'];
        $Factures->date_Arrives=$mylis[0]['col1'];
        $Factures->date_departs=$mylis[0]['col2'];
     
        $Factures->save();
        
         $detail_facture=Detail_factures::where('detail_factures.FK_Facture',$request->_id)
        ->get();
        
   
        
        for ($i = 1; $i < $count; $i++) {
            $detail_facture[$i-1]->nom_complet=$mylis[$i]['col0'];
            $detail_facture[$i-1]->prix = $mylis[$i]['col3'];  
            $detail_facture[$i-1]->save();
        }
        $detail_facture->save();
       
       
          
        
        
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        try {
            $check = Factures::where('id', $request->delet_id_facture)->first();
            if ($check != null) {
                $niveauurgence = Factures::find($request->delet_id_facture);
                $niveauurgence->delete();
                Detail_factures::where('fk_facture',$request->delet_id_facture)->get()->each->delete();
          
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
}
