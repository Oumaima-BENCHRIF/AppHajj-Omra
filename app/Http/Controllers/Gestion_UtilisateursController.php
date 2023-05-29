<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Gestion_UtilisateursPostRequest;
use App\Models\Gestion_utilisateurs;
use App\Models\Villes;
use App\Models\Privileges;
use App\Models\Gestion_permissions;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\gestion_utilisateurPostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Gestion_UtilisateursController extends Controller
{
    public function upd(Request $request)
    {
        $villes = Villes::get();
        $Privileges = Privileges::get();
        $gestion_permissions = Gestion_permissions::get();


        return view('gestion_utilisateurs/updat_user', [
            'villes' => $villes,
            'Privileges' => $Privileges,
            'gestion_permissions' => $gestion_permissions,
        ])
            ->with($request->all());
    }
    //Lister les Gestion_utilisateurs
    public function index(Request $request)
    {

        $villes = Villes::get();
        $Privileges = Privileges::get();
        $permissions = Permission::get();
        return view('gestion_utilisateurs/create_utilisateurs', [
            'villes' => $villes,
            'Privileges' => $Privileges,
            'permissions' => $permissions,


        ])
            ->with($request->all());


        // $Liste_Gestion_utilisateurs= Gestion_utilisateurs::all();
        // return view('gestion_Gestion_utilisateurs.index',[
        //     'listes_Gestion_utilisateurs'=>$Liste_Gestion_utilisateurs
        //     ]);
    }
    //Lister les Gestion_utilisateurs
    public function all(Request $request)
    {

        $page = $request->page ?? 0;
        $nom_utilisateur = $request->get('nom_utilisateur');
        $Email = $request->get('Email');
        $address = $request->get('address');
        $privilege = $request->get('privilege');
        $ville = $request->get('ville');
        $villes = Villes::get();
        $Privileges = Privileges::get();


        // ----------------------------------------index & search demande Methodes/Chefequipe-----------------------------------
        $Liste_Gestion_utilisateurs = User::where('users.deleted_at', '=', NULL)
            ->orderBy("id", "desc")
            ->where(function ($query) use ($nom_utilisateur, $Email, $address, $privilege, $ville) {
                if (!empty($nom_utilisateur)) {
                    $query->where('users.name', 'LIKE', $nom_utilisateur . '%');
                }
                if (!empty($Email)) {
                    $query->where('users.email', 'LIKE', $Email . '%');
                }
                if (!empty($address)) {
                    $query->where('users.address', 'LIKE', $address . '%');
                }

                if (!empty('Sélectionner Ville')) {
                    $query->where('users.ville', 'LIKE', $ville . '%');
                }
            });
        // -------------------------------------------------------------------------------------------------------------------------
        // dd($listeDemandes->paginate($pagination ?? 20));
        return view('gestion_utilisateurs/all_utilisateurs', [
            'page' => $page,
            'pagination' => $pagination ?? 20,
            'countListeGestion_utilisateurs' => $Liste_Gestion_utilisateurs->count(),
            'listes_Gestion_utilisateurs' => $Liste_Gestion_utilisateurs->paginate($pagination ?? 20),
            'villes' => $villes,
            'Privileges' => $Privileges,

        ])
            ->with($request->all());
    }
    //Affiche le formulaire de creation de Gestion_utilisateurs
    public function view(Request $request)
    {
        $Listes_Gestion_utilisateurs = User::where('id', $request->id)->first();


        // $Liste_Gestion_utilisateurs = Gestion_utilisateurs::all();
        return view('gestion_utilisateurs/profile_utilisateur', [
            'name' => $Listes_Gestion_utilisateurs->name,
            'email' => $Listes_Gestion_utilisateurs->email,
            'address' => $Listes_Gestion_utilisateurs->address,
            'privilege' => $Listes_Gestion_utilisateurs->privilege,
            'ville' => $Listes_Gestion_utilisateurs->ville,

        ]);
        // return view('gestion_Gestion_utilisateurs.create');
    }
    //Enregister Gestion_utilisateurs
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'mot_passe' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'adress' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $userLogin = Auth::user(); 
                $User = new User();
    
                $User->name = $request->input('name');
                $User->password = $request->input('mot_passe');
                $User->gender = $request->input('gender');
                $User->email = $request->input('email');
                // $User->privilege = $request->input('privilege');
                $User->ville = $request->input('ville');   
                $User->adress = $request->input('adress');
                $User->phone = $request->input('phone');
                $User->id_Agence = $userLogin->	id_Agence;
                $User->baseName = $userLogin->	baseName;
                $User->id_Succursales = $userLogin->id_Succursales;
                // dd($User);
                $User->save();
                $user = User::where('email',$User->email)->first();
                $permissions = $user->permissions;
                $user->permissions()->sync($permissions);
                return response()->json([
                    'status' => 200,
                    'message' => 'Votre demande a été bien envoyée.',
                ]);
            }
        }
     catch (\Exception $e) {

        return redirect()
            ->back()
            ->with('danger', 'Merci de vérifier la connexion internet, si non le service IT')
            ->withInput();
    }
            //    dd( explode('-',$request->input('date_dossier'))[1]);

        
            // $user = User::create(request(['name', 'email', 'password', 'gender', 'ville','Nom_DB', 'active' => 1, 'privilege', 'adress','phone']));
            // $user->permissions()->sync($request->input('permissions', []));
            // $user->save();
            
             
           
            // auth()->login($user);

            // return redirect()
            //     ->back()
            //     ->with('success', 'Votre demande a été bien envoyée.')
            //     ->withInput();
//         try {
// } catch (\Exception $e) {

//             return redirect()
//                 ->back()
//                 ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
//                 ->withInput();
//         }
        // try {

        //     $Gestion_utilisateurs = new User();
        //     $Gestion_utilisateurs->name = $request->input('name');
        //     $Gestion_utilisateurs->email = $request->input('email');
        //     $Gestion_utilisateurs->password = Hash::make($request->input('password'));
        //     // $Gestion_utilisateurs->ville = $request->input('ville');
        //     // $Gestion_utilisateurs->address = $request->input('address');
        //     // $Gestion_utilisateurs->privilege = $request->input('privilege');

        //     $Gestion_utilisateurs->save();

        //     return redirect()
        //         ->back()
        //         ->with('success', 'Votre demande a été bien envoyée.')
        //         ->withInput();


    }
    // 
    public function infos(Request $request)
    {
        $niveaux = Gestion_utilisateurs::where('id', $request->id)->first();
        return response()->json([
            'to_s' => $niveaux
        ]);
    }

    //permet de récupérer un Gestion_utilisateurs
    public function edit()
    {
    }
    // permet de modifier Gestion_utilisateurs
    public function update(Request $request)
    {

        try {

            $Gestion_utilisateurs_update = Gestion_utilisateurs::where('id', $request->_id_)->first();

            $Gestion_utilisateurs_update->code = $request->code_to;
            $Gestion_utilisateurs_update->nom = $request->nom_to;
            $Gestion_utilisateurs_update->telephone = $request->telephone_to;
            $Gestion_utilisateurs_update->fax = $request->fax_to;
            $Gestion_utilisateurs_update->ville = $request->ville_to;

            $Gestion_utilisateurs_update->save();
            session()->flash('success', 'TO a été bien modifiée');
            return back();
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('danger', 'Merci de vérifier la connexion internet, si non contacter le service IT')
                ->withInput();
        }
    }
    // permet de supprimer Gestion_utilisateurs
    public function destroy(Request  $request)
    {

        $check = Gestion_utilisateurs::where('id', $request->__id)->first();
        if ($check != null) {
            $niveauurgence = Gestion_utilisateurs::find($request->__id);
            $niveauurgence->delete();
            return redirect()->back()->with([
                session()->flash('success', 'suppression avec succès'),
            ]);
        } else {
            session()->flash('danger', 'Error');
            return back();
        }
    }
}
