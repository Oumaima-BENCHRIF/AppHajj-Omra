<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agents;
use App\Http\Requests\AgentsPostRequest;

class AgentsController extends Controller
{

    //Lister les Agents
    public function index(Request $request)
    {
        $page = $request->page ?? 0;
        $code_agents = $request->get('__code_agents_');
        $nom_agents = $request->get('__nom_agents_');
        $fax = $request->get('__fax__');
        $adresse = $request->get('__adresse__');
        $telephone = $request->get('__telephone__');
        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
        $Liste_Agents = Agents::where('Agents.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($code_agents, $nom_agents, $fax, $adresse, $telephone) {
                if (!empty($code_agents)) {
                    $query->where('Agents.code_agents', 'LIKE', $code_agents . '%');
                }
                if (!empty($nom_agents)) {
                    $query->where('Agents.nom_agents', 'LIKE', $nom_agents . '%');
                }
                if (!empty($fax)) {
                    $query->where('Agents.fax', 'LIKE', $fax . '%');
                }
                if (!empty($adresse)) {
                    $query->where('Agents.adresse', 'LIKE', $adresse . '%');
                }
                if (!empty($telephone)) {
                    $query->where('Agents.telephone', 'LIKE', $telephone . '%');
                }
            });
        
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_Agents/create_Agents', [
            'page' => $page,
            'pagination' => $pagination ?? 20,
            'countListeAgents' => $Liste_Agents->count(),
            'listes_Agents' => $Liste_Agents->paginate($pagination ?? 20),

        ])
            ->with($request->all());


        // $Liste_Agents= Agents::all();
        // return view('gestion_Agents.index',[
        //     'listes_Agents'=>$Liste_Agents
        //     ]);
    }
    //Affiche le formulaire de creation de Agents
    public function Agents_Liste()
    {

        $Liste_Agents = Agents::all(); 
        return response()->json([
   
            'listes_Agents' => $Liste_Agents
        ]);
       
    }
    //Enregister Agents
    public function store(AgentsPostRequest $request)
    {
        try {

            $Agents = new Agents();
            $Agents->code_agents = $request->input('code_agents');
            $Agents->nom_agents = $request->input('nom_agents');
            $Agents->telephone = $request->input('telephone');
            $Agents->fax = $request->input('fax');
            $Agents->adresse = $request->input('adresse');
            $Agents->save();

            return redirect()
                ->back()
                ->with('success', 'Votre demande a été bien envoyée.')
                ->withInput();
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    // 
    public function infos($id)
    {
        $info_Agents = Agents::where('id', $id)->get();
       
        if ($info_Agents != null) {
            return response()->json([
                'info_Agents' => $info_Agents,
                'status' => 200,
                'message' => 'Existe',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => 'N\existe pas',
            ]);
        }
    }

    //permet de récupérer un Agents
    public function edit()
    {
    }
    // permet de modifier Agents
    public function update(Request $request)
    {
        try {
            $Agents_update = Agents::where('id', $request->id_)->first();

            $Agents_update->code_agents = $request->code_agents_;
            $Agents_update->nom_agents = $request->nom_agents_;
            $Agents_update->adresse = $request->adresse_;
            $Agents_update->fax = $request->fax_;
            $Agents_update->telephone = $request->telephone_;
            $Agents_update->save();
            session()->flash('success', 'Niveau d\'urgence a été bien modifiée');
            return back();
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    // permet de supprimer Agents
    public function destroy(Request  $request)
    {

        $check = Agents::where('id', $request->__id)->first();
        if ($check != null) {
            $niveauurgence = Agents::find($request->__id);
            $niveauurgence->delete();
            return redirect()->back()->with([
                session()->flash('success', 'suppression avec succès'),
            ]);
        } else {
            session()->flash('delete_danger', 'Error');
            return back();
        }
    }
}
