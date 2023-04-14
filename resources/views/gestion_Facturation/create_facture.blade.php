@extends('../layout/' . $layout)

@section('subhead')
<title>Gestion Fiche d'inscription</title>
@endsection

@section('subcontent')
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
<div class="px-5 sm:px-20 mt-10 pt-10 ">
    <div class="grid grid-cols-6 gap-4">
        <div class="intro-y col-span-12 sm:col-span-6">
            @if (session()->has('danger'))
            <!-- BEGIN -->

            <div class="alert alert-danger alert-dismissible show flex items-center mbt-2 text-size" role="alert">
                <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> <strong class="text-light"> {{ session()->get('danger') }}</strong>
                <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <!-- END -->
            @endif
            @if (session()->has('success'))
            <!-- BEGIN -->
            <div class="alert alert-success alert-dismissible show flex items-center mb-5" role="alert">
                <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> <strong class="text-light"> {{ session()->get('success') }}</strong>
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <!-- END -->
            @endif
        </div>
    </div>
</div>
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="py-5 px-5  mt-5">
                <div class="font-medium text-center text-lg">Gestion facturation</div>
            </div>
            <!-- @if (Auth::user()->permissions->contains('name','Ajouter_Compagnies')) -->
            <form id="Add_compagnie" action="{{ url('Compagnies_Store') }}" method="post">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">

                        <div class="intro-y w4 px-1  @if ($errors->get('code_cie')) has-error @endif">
                            <label for="Code_client" class="form-label mbt-2 text-size">Code client</label>

                            <input type="text" id="Code_client" name="Code_client" class="form-control py-1 @if ($errors->get('Code_client')) is-invalid @endif" placeholder="Entrer Code client">

                            <!-- @if ($errors->get('code_cie'))
                            @foreach ($errors->get('code_cie') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif -->
                        </div>

                        <div class="intro-y w4 px-1  @if ($errors->get('nom_client')) has-error @endif">
                            <label for="nom_client" class="form-label mbt-2 text-size">nom client</label>
                            <input id="nom_client" name="nom_client" type="text" class="form-control py-1 @if($errors->get('compagnie')) is-invalid @endif" >
                            <!-- @if($errors->get('compagnie'))
                            @foreach($errors->get('compagnie') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                        </div>
                        <div class="intro-y w4 px-1 @if($errors->get('adressse')) has-error @endif">
                            <label for="adressse" class="form-label mbt-2 text-size">adressse</label>
                            <input id="adressse" name="adressse" type="text" class="form-control py-1 @if($errors->get('adressse')) is-invalid @endif" >
                            <!-- @if($errors->get('telephone'))
                            @foreach($errors->get('telephone') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                        </div>

                        <div class="intro-y w4 px-1 @if($errors->get('ville')) has-error @endif">
                            <label for="ville" class="form-label mbt-2 text-size">vile</label>
                            <input id="ville" name="ville" type="text" class="form-control py-1 @if($errors->get('ville')) is-invalid @endif" placeholder="Entrer ville">

                            <!-- @if($errors->get('fax'))
                            @foreach($errors->get('fax') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                        </div>
                    
                  </div>
                  <div class="form-inline mt-2">
                  <div class="intro-y w4 px-1 @if($errors->get('date_fac')) has-error @endif">
                            <label for="date_fac" class="form-label mbt-2 text-size">Date</label>
                           
                            <input id="date_fac" name="date_fac" type="date" class="form-control py-1 @if($errors->get('date')) is-invalid @endif" required="">
                            <!-- @if($errors->get('nom_en_arabe'))
                            @foreach($errors->get('nom_en_arabe') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                        </div>
                  <div class="intro-y w4 px-1 @if($errors->get('N_facture')) has-error @endif"> 
                            <label for="N_facture" class="form-label mbt-2 text-size">N° facture</label>
                            <input id="N_facture" name="N_facture" class="form-control py-1 @if($errors->get('N_facture')) is-invalid @endif" type="text" class="form-control" placeholder="Entrer N° facture">

                            <!-- @if($errors->get('adresse'))
                            @foreach($errors->get('adresse') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                   </div>

                     <div class="intro-y w4 px-1 @if($errors->get('N_dossier')) has-error @endif">
                            <label for="N_dossier" class="form-label mbt-2 text-size">N° dossier</label>
                            <input id="N_dossier" name="N_dossier" type="text" class="form-control py-1 @if($errors->get('N_dossier')) is-invalid @endif" placeholder="Entrer N° dossier">
                            <!-- @if($errors->get('directeur'))
                            @foreach($errors->get('directeur') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                    </div>
                    <div class="intro-y w4 px-1 @if($errors->get('Bon_commande')) has-error @endif">
                            <label for="Bon_commande" class="form-label mbt-2 text-size">Bon de commande</label>
                            <input id="Bon_commande" name="Bon_commande" type="text" class="form-control py-1 @if($errors->get('Bon_commande')) is-invalid @endif" placeholder="Entrer Bon de commande">
                            <!-- @if($errors->get('tel_directeur'))
                            @foreach($errors->get('tel_directeur') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                     </div>
                     </div>
                     <div class="form-inline mt-2">      
                     <div class="intro-y w4 px-1 @if($errors->get('vos_ref')) has-error @endif">
                            <label for="vos_ref" class="form-label mbt-2 text-size">vos ref</label>
                            <input id="vos_ref" name="vos_ref" type="text" class="form-control py-1 @if($errors->get('vos_ref')) is-invalid @endif" placeholder="Entrer vos ref">
                            <!-- @if($errors->get('compte_comptable_BSP'))
                            @foreach($errors->get('compte_comptable_BSP') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif -->
                        </div>
                        <div class="intro-y w4 px-1">
                            <label for="type" class="form-label mbt-2 text-size">fiche inscription</label>
                            <!-- <input id="type" name="type" type="text" value="" class="form-control " placeholder="type"> -->
                            <select name="type" id="type" class="form-control py-">
                                <option value="">Transport</option>
                                <option value="">Guide</option>
                                <option value="">Restaurant </option>
                                <option value="">Autre</option>
                            </select>
                         </div>
                         <div class="intro-y w4 px-1">
                            {{-- <a class="btn btn-secondary w-24" >Liste</a> --}}
                            <button type="Submit" class="btn btn-primary mt-6 py-1 mr-1">importer</button>
                        </div>
               
                        </div>
                     </div>
            </form>
            <a href="{{ route('generate.index') }}" class="btn btn-primary" target="_blank">Print Invoice</a>
            @endif
            </div>
             <!-- debut de liste hotel fourni -->
          
            <!-- Fin de liste date depart hotel fourni -->
    
</div>



@endsection
@section('jqscripts')

@endsection