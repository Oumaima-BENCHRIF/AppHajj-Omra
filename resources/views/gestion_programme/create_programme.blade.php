@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion Programmes</title>
@endsection

@section('subcontent')
<!-- style css of tabilator -->
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
<!-- BEGIN -->


<nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex style">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dossier</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            <!-- <input type="text" id="nom_dossier"> -->
            <span id="nom_dossier">{{$liste_programmes->nom_dossier ?? ""}}</span>
        </li>
    </ol>
</nav>

<!-- <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">

    <a href="{{ route('Liste_prg.liste') }}/{{ session('projet_id______') }}" class="tooltip btn btn-primary w-1/2 sm:w-auto mr-10" title="Retour a la page précédent!">
        <span class="w-5 h-5 flex items-center justify-center">
            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="arrow-left" data-lucide="arrow-left" class="lucide lucide-arrow-left block mx-auto">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </div>
        </span>
    </a>

    <div class="mt-2 xl:mt-0">
        <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary ">
            <h3 class="intro-y text-lg font-medium mr-auto">Gestion Programmes</h3>
        </button>
    </div>


</div> -->
<!-- END -->
<!-- <div class="flex flex-col sm:flex-row sm:items-end xl:items-start tab-content mt-3">
    <a href="{{ route('Liste_prg.liste') }}/{{ session('projet_id______') }}" class="tooltip btn btn-primary w-1/2 sm:w-auto mr-10" title="Retour a la page précédent!">
        <span class="w-5 h-5 flex items-center justify-center">
            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="arrow-left" data-lucide="arrow-left" class="lucide lucide-arrow-left block mx-auto">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </div>
        </span>
    </a>

    <div class="mt-2 xl:mt-0">
        <button id="tabulator-html-filter-reset" type="button" style="background-color: #00897b  ; color: #ffffff;" class="btn btn-secondary ">
            <h2 class="intro-y text-lg font-medium mr-auto">Gestion Programmes</h2>
        </button>

    </div>
</div> -->


<!-- End: Gestion ALLOTTEMENT -->
<!-- ------------------------------------------- -->
<div class="flex items-center mt-2">
    <h2 class="intro-y text-lg font-medium mr-auto"> </h2>
</div>
<!-- BEGIN: Gestion Programme -->
<div id="example-tab-3" class="tab-pane leading-relaxed active " role="tabpanel" aria-labelledby="example-3-tab">
    <div style="background-color: #D6E8EE;" class="tab-content intro-y box py-1 sm:py-2  " id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

        <div class="px-2 style_pading">
            <!-- <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <a href="{{ route('Liste_prg.liste') }}/{{ session('projet_id______') }}" class="mr-5 tooltip btn btn-primary w-1/2 sm:w-auto mr-10" title="Retour a la page précédent!">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="arrow-left" data-lucide="arrow-left" class="lucide lucide-arrow-left block mx-auto">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </div>
                    </span>
                </a>
                <div class="font-medium text-center text-lg left">
                    <div class="mt-2 xl:mt-0">
                        <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary " style="background-color: #00897b  ; color: #ffffff;">
                            <h3 class="intro-y text-lg font-medium mr-auto">Gestion Programmes</h3>
                        </button>
                    </div>
                </div>
            </div> -->
            <div class="w-full items-center pr-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-900">
        <div class="flex">

        <a href="{{ route('Liste_prg.liste') }}/{{ session('projet_id______') }}" class="mr-5 tooltip btn btn-primary w-1/2 sm:w-auto mr-10" style="border-radius:20px; background-color:#015C92;" title="Retour a la page précédent!">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="arrow-left" data-lucide="arrow-left" class="lucide lucide-arrow-left block mx-auto">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </div>
                    </span>
                </a>

            <div class="font-medium py-2 px-5  btn-G text-center text-lg ">
                <div class="mt-2 xl:mt-0">

                    <h3 class="intro-y text-lg font-medium mr-auto">Gestion Programmes</h3>

                </div>
            </div>
        </div>
    </div>
        </div>
        <!-- -->
        <form id="form_gestion_prog" name="form_gestion_prog" action="{{ url('Programme_Store') }}" method="post">
            {{ csrf_field() }}
            <div class="intro-y">
                <div class="form-inline">

                    <div class="intro-y w4 px-1">
                        <label for="ref_programme" class="form-label  mbt-2 text-size">Ref ligne</label>
                        <div class="relative  mx-auto">
                            <select id="ref_programme" name="ref_programme" data-search="true" class="form-control py-1" required>
                                <option>réf</option>
                            </select>
                        </div>
                    </div>
                    <!-- <input type="text" id="id_prg" name="id_prg"> -->
                    <!-- <input type="text" id="FK_dossier" name="FK_dossier"> -->
                    <input type="hidden" name="FKdossier" id="FKdossier" value="{{ session('projet_id______') }}">

                    <div class="intro-y w4 px-1">
                        <label for="nom_programme" class="form-label  mbt-2 text-size">Nom programme</label>
                        <input id="nom_programme" name="nom_programme" type="text" class="form-control py-1" placeholder="Entrer nom programme" required>
                    </div>

                    <div class="intro-y w4 px-1">
                        <label for="type_programme" class="form-label  mbt-2 text-size">Type programme</label>
                        <select id="type_programme" name="type_programme" data-search="true" class="form-control py-1" required>

                        </select>
                    </div>

                    <div class="intro-y w4 px-1">
                        <label for="nbr_nuitee_prog_mdina" class="form-label  mbt-2 text-size">Nbr nuitées Médine</label>
                        <input id="nbr_nuitee_prog_mdina" name="nbr_nuitee_prog_mdina" class="form-control py-1" type="number" min="0" placeholder="Entrer Nbr nuitées programme Médine" required>
                    </div>

                    
                </div>
                <div class="form-inline mt-2">
                <div class="intro-y w4 px-1">
                        <label for="nbr_nuitee_prog_maka" class="form-label  mbt-2 text-size">Nbr nuitées Makka</label>
                        <input id="nbr_nuitee_prog_maka" name="nbr_nuitee_prog_maka" class="form-control py-1" type="number" min="0" placeholder="Entrer Nbr nuitées programme Makka" required>
                 </div>
                    <div class="intro-y w4 px-1">
                        <label for="num_vole_dep" class="form-label  mbt-2 text-size">Num vole départ</label>
                        <select id="num_vole_dep" name="num_vole_dep"  data-search="true" class="form-control py-1 w-full" required>

                        </select>
                    </div>

                    <div class="intro-y w4 px-1">
                        <label for="nbr_place_aller" class="form-label  mbt-2 text-size">Nbr place départ</label>
                        <input id="nbr_place_aller" name="nbr_place_aller"  class="form-control py-1" type="number" min="0" placeholder="Entrer Nbr place départ" required>
                    </div>
                    <div class="intro-y w4 px-1">
                        <label for="nbr_reserver_dep" class="form-label  mbt-2 text-size">Nbr réserver départ</label>
                        <input id="nbr_reserver_dep" name="nbr_reserver_dep" class="form-control py-1" type="number" min="0" placeholder="Entrer nbr réserver départ" required>
                    </div>

                  

                </div>
                <div class="form-inline mt-2 mb-5">
                <div class="intro-y w4 px-1">
                        <label for="num_vole_retour" class="form-label  mbt-2 text-size">Num vole retour</label>
                        <select id="num_vole_retour" name="num_vole_retour"  data-search="true" class="form-control py-1 w-full" required>

                        </select>
                    </div>

                    <div class="intro-y w4 px-1">
                        <label for="nbr_place_retour" class="form-label  mbt-2 text-size">Nbr place retour</label>
                        <input id="nbr_place_retour" name="nbr_place_retour" class="form-control py-1"  type="number" min="0" placeholder="Entrer Nbr place retour" required>
                    </div>

                    <div class="intro-y w4 px-1">
                        <label for="nbr_reserver_retour" class="form-label  mbt-2 text-size">Nbr reserver retour</label>
                        <input id="nbr_reserver_retour" name="nbr_reserver_retour" class="form-control py-1"  type="number" min="0" placeholder="Entrer Nbr reserver retour" required>
                    </div>

                    <div class="intro-y w4 px-1 " style="padding-top: 2rem;">
                        <button type="Submit" class="btn w49 p-1" style="background-color: #00897b  ; color: #ffffff; ">Ajouter</button>
                        <button type="Submit" id="NV_prg" name="NV_prg" onclick="Nouveau_prg()" class="btn w49 p-1 text-light" style="background-color: #004d40; color: #ffffff;">Nouveau</button>
                    </div>
                </div>
                <div class="form-inline">
                </div>
            </div>
        </form>
        
    </div>

    <!-- debut de choix entre ( Hotels du programme\Itinéraire & informations supplémentaires\Autres service) -->
    <ul class="nav nav-boxed-tabs" role="tablist" style="  background-color: #e0f2f1;">
        <li id="hotel_programme2" class="nav-item flex-1" role="presentation">
            <button class="nav-link w-full py-2 active bx-show" data-tw-toggle="pill" data-tw-target="#hotel_programme" type="button" role="tab" aria-controls="hotel_programme" aria-selected="true">
                Hotels du programme
            </button>
        </li>
        <li id="Itineraire_informations_supp2" class="nav-item flex-1" role="presentation">
            <button class="nav-link w-full py-2 bx-show" data-tw-toggle="pill" data-tw-target="#Itineraire_informations_supp" type="button" role="tab" aria-controls="Itineraire_informations_supp" aria-selected="false">
                Itinéraire & informations supplémentaires
            </button>
        </li>
        <li id="Autre_service2" class="nav-item flex-1" role="presentation">
            <button class="nav-link w-full py-2 bx-show" data-tw-toggle="pill" data-tw-target="#Autre_service" type="button" role="tab" aria-controls="Autre_service" aria-selected="false">
                Autres service
            </button>
        </li>
    </ul>
    <!-- Fin de choix entre ( Hotels du programme\Itinéraire & informations supplémentaires\Autres service) -->

    <div class="tab-content" style="background-color:#e0f2f1   ;">

        <!-- début de traitement de Hotels du programme -->
        <div id="hotel_programme" class="tab-pane leading-relaxed active " role="tabpanel" aria-labelledby="hotel_programme">

            <div class="px-2 py-3 ">
                <div class="font-medium pb-3 text-center text-lg border-b border-slate-200/60 dark:border-darkmode-900 ">Hotels du programme</div>
            </div>
            <div class="px-5 sm:px-20   pt-10 ">
            <form id="detail_hotel_prg" class="mb-5" name="detail_hotel_prg" method="POST" action="{{  url('hotel_Stores')  }}">
                    {{ csrf_field() }}
                    <div class="intro-y">
                <div class="form-inline">
                   

                        <div class="intro-y w4 px-1">
                            <label for="ref_Hotels_prog" class="form-label  mbt-2 text-size">Ref ligne</label>
                            <div class="relative  mx-auto">
                                <input id="ref_Hotels_prog" name="ref_Hotels_prog" type="text" class="form-control py-1" placeholder="Entrer Ref Hotel" required>
                            </div>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="ville_Hotel_prg" class="form-label  mbt-2 text-size">Ville</label>
                            <select id="ville_Hotel_prg" name="ville_Hotel_prg" data-search="true" class="form-control py-1 w-full">
                                <option value="ville_Hotel_prg" disabled selected hidden>Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="date_depar_hotel" class="form-label  mbt-2 text-size">Date départ</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="date_depar_hotel" name="date_depar_hotel" type="date" class="form-control py-1" required>
                            </div>
                        </div>
                        <div class="intro-y w4 px-1">
                            <label for="date_retour_hotel" class="form-label  mbt-2 text-size">Date retour</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="date_retour_hotel" name="date_retour_hotel" type="date" class="form-control py-1" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                        <div class="intro-y w4 px-1">
                            <label for="hotel_prg" class="form-label  mbt-2 text-size">Hôtel</label>
                            <select id="hotel_prg" name="hotel_prg" data-search="true" class="form-control py-1">
                                <option value="hotel_prg" disabled selected hidden>Sélectionner Hôtel</option>
                                @foreach($Hotel_transports as $Hotel_transports)
                                <option value="{{$Hotel_transports->nom}}">{{$Hotel_transports->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="bnr_nuits_prg" class="form-label  mbt-2 text-size">Nbr nuits</label>
                            <input type="number" min="0" id="bnr_nuits_prg" name="bnr_nuits_prg" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="bnr_chambre" class="form-label  mbt-2 text-size">Nbr chambre</label>
                            <input type="number" min="0" id="bnr_chambre" name="bnr_chambre" class="form-control py-1" required>
                        </div>
                        <div class="intro-y w4 px-1">
                            <label for="Totale_place" class="form-label  mbt-2 text-size">Total place</label>
                            <input type="number" min="0" id="Totale_place" name="Totale_place" class="form-control py-1" disabled>
                        </div>

                    </div>
                    <div class="form-inline mt-2">
                       
                        <div class="intro-y w4 px-1">
                            <label for="regime_prg" class="form-label  mbt-2 text-size">Régime</label>
                            <select id="regime_prg" name="regime_prg" data-search="true" class="form-control py-1">
                                <option value="regime_prg" disabled selected hidden>Sélectionner</option>
                                @foreach($Gestion_regimes as $Gestion_regimes)
                                <option value="{{$Gestion_regimes->nom_regime}}">{{$Gestion_regimes->nom_regime}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="type_chambre_prg" class="form-label  mbt-2 text-size">Type chambre</label>
                            <select id="type_chambre_prg" name="type_chambre_prg" data-search="true" class="form-control py-1">
                                <option value="type_chambre_prg" disabled selected hidden>chambre</option>
                                @foreach($Gestion_chambres as $Gestion_chambres)
                                <option value="{{$Gestion_chambres->id}}">{{$Gestion_chambres->nom_chambre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="chambre_prg" class="form-label  mbt-2 text-size">Chambre</label>
                            <select id="chambre_prg" name="chambre_prg" data-search="true" class="form-control py-1">
                                <option value="chambre_prg" disabled selected hidden>chambre</option>
                                @foreach($Gestion_type_chambres as $Gestion_type_chambres)
                                <option value="{{$Gestion_type_chambres->type_chambre}}">{{$Gestion_type_chambres->type_chambre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y w4 px-1">
                            <label for="prix_achat_prg" class="form-label  mbt-2 text-size">Prix achat</label>
                            <input type="number" min="0" id="prix_achat_prg" name="prix_achat_prg" class="form-control py-1" required>
                        </div>
                    </div>
                    <div class="form-inline">
                       

                        <div class="intro-y w4 px-1">
                            <label for="prix_vente_prg" class="form-label  mbt-2 text-size">Prix vente</label>
                            <input type="number" min="0" id="prix_vente_prg" name="prix_vente_prg" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="prix_prg" class="form-label  mbt-2 text-size">Prix prg</label>
                            <input type="number" min="0" id="prix_prg" name="prix_prg" class="form-control py-1" required>
                        </div>
                        <div class="intro-y w4 px-1">
                        </div>
                        <div class="intro-y w4 px-1" style="padding-top: 2rem;">
                            <button type="Submit" class="btn  w-full  p-1" style="background-color: #00897b  ; color: #ffffff;">Ajouter</button>
                        </div>
                    </div>
                </div>
                    
                </form>
                     <div class="flex flex-col sm:flex-row sm:items-end xl:items-start pading mb-5">
                            <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                            </form>
                            <div class="flex mt-2 sm:mt-0">

                                <button href="javascript:;" data-tw-toggle="modal" style="background-color: #fff;" data-tw-target="#hotel-prog-rech-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                                    <span class="w-5 h-5 flex items-center justify-center">
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1" >
                                            <i data-lucide="search" class="block mx-auto"></i>
                                        </div>
                                    </span>
                                </button>
                                <button id="tabulator-print-Hotels-programme" style="background-color: #fff;" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                </button>
                                <div class="dropdown w-1/2 sm:w-auto">
                                    <button class="dropdown-toggle btn btn-outline-dark w-full sm:w-auto" style="background-color: #fff;" aria-expanded="false" data-tw-toggle="dropdown">
                                        <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
                                    </button>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <li>
                                                <a id="tabulator-export-csv" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export CSV
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-json" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export JSON
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export XLSX
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-html" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export HTML
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto scrollbar-hidden">
                            <div id="liste_hotel_prg" class="  table-report--tabulator"></div>
                        </div>
                    
            <!-- debut de liste date depart -->
            </div>
        </div>
          
       
        <!-- fin de traitement de Hotels du programme -->
        <!-- ---------------------------------------------- -->
        <!-- début de traitement Itinéraire & informations supplémentaires -->
        <div style="background-color:  rgb(219 234 254);" id="Itineraire_informations_supp" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="Itineraire_informations_supp">
            <div class="px-2 py-3 ">
                <div class="font-medium text-center text-lg pb-3 border-b border-slate-200/60 dark:border-darkmode-900 ">Itinéraire & informations supplémentaires</div>
            </div>
            <div class="px-5 sm:px-20   pt-10 "">
                <form id="detail_Itineraire_prg" class="mb-5" name="detail_Itineraire_prg" method="POST" action="{{  url('Itineraire_Stores')  }}">
                    {{ csrf_field() }}
                    <div class="intro-y ">
                        <div class="form-inline">
                        <div class="intro-y w3 px-1">
                            <label for="date_retour_Itineraire" class="form-label  mbt-2 text-size">Date retour</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="date" id="date_retour_Itineraire" name="date_retour_Itineraire" class="form-control py-1" required>
                            </div>
                        </div>

                        <div class="intro-y w3 px-1">
                            <label for="ville_Itineraire" class="form-label  mbt-2 text-size">Ville</label>
                            <!-- country -->
                            <select id="ville_Itineraire" name="ville_Itineraire" data-search="true" class="form-control py-1" required>
                                <option value="ville_Itineraire" disabled selected hidden>Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="intro-y w3 px-1">
                            <label for="Transport_Itineraire" class="form-label  mbt-2 text-sizel">Transport</label>
                            <select id="Transport_Itineraire" name="Transport_Itineraire" data-search="true" class="form-control py-1" required>
                                <option value="Transport_Itineraire" disabled selected hidden>Sélectionner Transport</option>

                            </select>
                        </div>
                        </div>
                        <div class="form-inline mt-2">
                        <div class="intro-y w3 px-1">
                            <label for="type_Transport" class="form-label  mbt-2 text-size">Type transport</label>
                            <input type="text" id="type_Transport" name="type_Transport" class="form-control py-1" placeholder="Type transport" disabled>
                        </div>

                        <div class="intro-y w3 px-1">
                            <label for="itineraire_programme" class="form-label  mbt-2 text-size">Itinéraire</label>
                            <select id="itineraire_programme" name="itineraire_programme" class="form-control py-1">
                                <option value="itineraire_programme" disabled selected hidden>Sélectionner Itinéraire</option>
                                @foreach($Gestion_itineraires as $Gestion_itineraires)
                                <option value="{{$Gestion_itineraires->nom_itineraire}}">{{$Gestion_itineraires->nom_itineraire}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="intro-y w3 px-1" style="padding-top: 2rem;">
                            <button type="Submit" class="btn  w-full  p-1" style="background-color: #00897b  ; color: #ffffff;">Ajouter</button>
                        </div>
                        </div>
                    </div>
                </form>
                
                        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                            <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                            </form>
                            <div class="flex   sm:mt-0">

                                <button style="background-color: #fff;" href="javascript:;" data-tw-toggle="modal" data-tw-target="#itineraire-rech-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                                    <span class="w-5 h-5 flex items-center justify-center">
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                            <i data-lucide="search" class="block mx-auto"></i>
                                        </div>
                                    </span>
                                </button>
                                <button style="background-color: #fff;"  id="tabulator-print-Itineraire" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                </button>
                                <div style="background-color: #fff;" class="dropdown w-1/2 sm:w-auto">
                                    <button class="dropdown-toggle btn btn-outline-dark w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown">
                                        <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
                                    </button>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <li>
                                                <a id="tabulator-export-csv" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export CSV
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-json" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export JSON
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export XLSX
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-html" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export HTML
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto scrollbar-hidden">
                            <div id="liste_itieraire" class="mt-5 table-report--tabulator"></div>
                        </div>
                    </div>
            

                  
               
            <!-- Fin de liste date depart -->

        </div>
        <!-- fin de traitement Itinéraire & informations supplémentaires -->

        <!-- ---------------------------------------------- -->
        <!-- début de traitement  Autres service -->
        <div style="background-color: rgb(238 242 255);" id="Autre_service" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="Autre_service">
            <div class="px-2 py-3 ">
                <div class="font-medium text-center text-lg pb-3 border-b border-slate-200/60 dark:border-darkmode-900 ">Autres service</div>
            </div>
            <div class="px-5 sm:px-20 pt-10 " style="padding-right: 1rem;">
            <form id="detail_service_prg" class="mb-5" name="detail_service_prg" method="POST" action="{{  url('Service_Stores')  }}">
                    {{ csrf_field() }}
                    <div class="intro-y ">
                        <div class="form-inline">
                       
                        <div class="intro-y w5 px-1">
                            <label for="ville_service" class="form-label  mbt-2 text-size">Ville </label>
                            <select id="ville_service" name="ville_service" data-search="true" class="form-control py-1 w-full" required>
                                <option value="ville_service" disabled selected hidden>Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="intro-y w5 px-1" >
                            <label for="Transport_Itineraire" class="form-label  mbt-2 text-size">Fournisseur</label>
                            <select id="Transport_Itineraire" name="Transport_Itineraire" data-search="true" class="form-control py-1 w-full etoile"  required>
                                <option value="Transport_Itineraire" disabled selected hidden>Sélectionner Transport</option>
                            </select>
                        </div>
                    
                        <div class="intro-y w5 px-1">
                            <label for="nbr_etoile" class="form-label  mbt-2 text-size">Nombre étoilé</label>
                            <input type="text" name="nbr_etoile" id="nbr_etoile" class="form-control py-1 w-full">
                        </div>

                        <div class="intro-y w5 px-1">
                            <label for="service_prog" class="form-label  mbt-2 text-size">Service</label>
                            <input type="text" name="service_prog" id="service_prog" class="form-control py-1 w-full">
                        </div>

                        <div class="intro-y w5 px-1" style="padding-top: 2rem;">
                            <button type="Submit" class="btn  w-full  p-1" style="background-color: #00897b  ; color: #ffffff;">Ajouter</button>
                        </div>
                    
                        </div>
                    </div>
                </form>
               
                        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                            <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                            </form>
                            <div class="flex  mb-5  sm:mt-0">
                                <button href="javascript:;"style="background-color: #fff;" data-tw-toggle="modal" data-tw-target="#autre-service-rech-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                                    <span class="w-5 h-5 flex items-center justify-center">
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                            <i data-lucide="search" class="block mx-auto"></i>
                                        </div>
                                    </span>
                                </button>
                                <button id="tabulator-print-service" style="background-color: #fff;" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                </button>
                                <div class="dropdown w-1/2 sm:w-auto">
                                    <button class="dropdown-toggle btn btn-outline-dark w-full sm:w-auto"style="background-color: #fff;"aria-expanded="false" data-tw-toggle="dropdown">
                                        <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
                                    </button>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <li>
                                                <a id="tabulator-export-csv" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export CSV
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-json" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export JSON
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export XLSX
                                                </a>
                                            </li>
                                            <li>
                                                <a id="tabulator-export-html" href="javascript:;" class="dropdown-item">
                                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export HTML
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto scrollbar-hidden">
                            <div id="listes_service" class="  table-report--tabulator"></div>
                        </div>
             
           
            </div>
            <!-- Fin de liste date depart  -->
        </div>

        
        <!-- fin de traitement  Autres service -->
    
</div>
<!-- END ALLOTTEMENT -->
<!-- </div> -->
<!-- END: Gestion Programme -->

<!-- BEGIN: Delete vole depart Confirmation Modal -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">vous êtes sûr?</div>
                            <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer vole départ? <br>Ce processus ne peut pas être annulé.</div>
                        </div>
                        <!--   -->
                        <form id="delet_vole_depart" name="delet_vole_depart" action="{{route('vole_depart.delete')}}" method="post">

                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>


                                <input type="hidden" id="_id_vole_depart" name="_id_vole_depart">

                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger w-24">Supprimer</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->

<!-- BEGIN: Delete vole retour Confirmation Modal -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-vole-retour-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">vous êtes sûr?</div>
                            <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer Vole Retour? <br>Ce processus ne peut pas être annulé.</div>
                        </div>

                        <form id="delete_vole_retour" name="delete_vole_retour" action="{{ route('vole_retour.delete') }}" method="post">

                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>


                                <input type="hidden" id="id_vole_retour" name="id_vole_retour">

                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger w-24">Supprimer</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete retour Modal -->

<!-- BEGIN: Modal update vole retour-->
<div id="updatVoleRetour" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="retour-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier vole retour</h2>

                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="javascript:;" class="dropdown-item">
                                        <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modifier  Modal Body -->

                <form id="update_vole_retour" name="update_vole_retour" action="{{ route('vole_retour.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="date_vole_retour_allotemet_up" class="form-label">Date retour</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="date_vole_retour_allotemet_up" name="date_vole_retour_allotemet_up" class="datepicker form-control pl-12" data-single-mode="true">
                            </div>
                        </div>

                        <input type="hidden" id="id_vole_retour_up" name="id_vole_retour_up">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="num_vol_retour_allotemet_up" class="form-label">N° Vol</label>
                            <input id="num_vol_retour_allotemet_up" name="num_vol_retour_allotemet_up" type="text" class="form-control @if($errors->get('num_vol_retour_allotemet_up')) is-invalid @endif" placeholder="Entrer Num vol de retour">
                            @if($errors->get('num_vol_retour_allotemet'))
                            @foreach($errors->get('num_vol_retour_allotemet') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="parcours_retour_allotement_up" class="form-label">Parcours</label>
                            <select id="parcours_retour_allotement_up" name="parcours_retour_allotement_up" class="form-control">
                                <option value="parcours_retour_allotement_up" disabled selected hidden>parcours</option>
                                @foreach($Gestion_parcours as $Gestion_parcour)
                                <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="total_accorde_retour_allotement_up" class="form-label">Total accorde</label>
                            <input id="total_accorde_retour_allotement_up" name="total_accorde_retour_allotement_up" type="number" min="0" class="form-control @if($errors->get('total_accorde_retour_allotement_up')) is-invalid @endif" placeholder="Entrer Total accorde">
                            @if($errors->get('total_accorde_retour_allotement_up'))
                            @foreach($errors->get('total_accorde_retour_allotement_up') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_depart_vol_retour_allot_up" class="form-label">Heure Départ</label>
                            <input type="time" id="heure_depart_vol_retour_allot_up" name="heure_depart_vol_retour_allot_up" class="form-control">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_arrivee_vole_retour_allot_up" class="form-label">Heure Arrivée</label>
                            <input type="time" id="heure_arrivee_vole_retour_allot_up" name="heure_arrivee_vole_retour_allot_up" class="form-control">
                        </div>

                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="submit" class="btn w-20" style="background-color: #00838f ;color: #ffffff;">Ajouter</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: Modal update retour-->

<!-- BEGIN: Modal update vole depart-->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="depart-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier vole départ</h2>

                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="javascript:;" class="dropdown-item">
                                        <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modifier  Modal Body -->

                <?php $url_update = route('vole_depart.edit'); ?>
                <form id="update_vole_depart" name="update_vole_depart" action="{{ route('vole_depart.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="vole_depart_allotemet_Dt_depart" class="form-label">Date départ</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="date" id="vole_depart_allotemet_Dt_depart" name="vole_depart_allotemet_Dt_depart" class="form-control pl-12" data-single-mode="true" required>
                            </div>
                        </div>

                        <input type="hidden" id="id_vole_depart_up" name="id_vole_depart_up">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="num_vol_depart_allotemet_up" class="form-label">N° Vol</label>
                            <input id="num_vol_depart_allotemet_up" name="num_vol_depart_allotemet_up" type="text" class="form-control @if($errors->get('num_vol_depart_allotemet_up')) is-invalid @endif" placeholder="Entrer Num vol de départ" required>
                            @if($errors->get('num_vol_depart_allotemet_up'))
                            @foreach($errors->get('num_vol_depart_allotemet_up') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="parcours_vol_depart_allotement_up" class="form-label">Parcours</label>
                            <select id="parcours_vol_depart_allotement_up" name="parcours_vol_depart_allotement_up" class="form-control">
                                <option value="parcours_vol_depart_allotement_up" disabled selected hidden>parcours</option>
                                @foreach($Gestion_parcours as $Gestion_parcour)
                                <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="total_accorde_vol_depart_allot_up" class="form-label">Total accorde</label>
                            <input required id="total_accorde_vol_depart_allot_up" name="total_accorde_vol_depart_allot_up" type="number" min="0" class="form-control" placeholder="Entrer Total accorde">

                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_depart_vol_retour_allot_up" class="form-label">Heure Départ</label>
                            <input required type="time" id="heure_depart_vol_depart_allot_up" name="heure_depart_vol_retour_allot_up" class="form-control">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_arrivee_vole_depart_allot_up" class="form-label">Heure Arrivée</label>
                            <input required type="time" id="heure_arrivee_vole_depart_allot_up" name="heure_arrivee_vole_depart_allot_up" class="form-control">
                        </div>

                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="submit" class="btn w-20" style="background-color: #00838f ;color: #ffffff;">Ajouter</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: Modal update depart-->

<!-- BEGIN: Model Ajouter Programme -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">

    <div id="static-backdrop-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">

                    <!-- BEGIN: Modal Header -->
                    <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto">Ajouter Programme</h2>
                        <div class="dropdown sm:hidden">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                                <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                            </a>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="javascript:;" class="dropdown-item">
                                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END: Modal Header -->
                    <!-- BEGIN: Modal Body -->

                    <form action="{{ url('fiche_clients_Store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_compte_" class="form-label">num_allottement</label>

                                    <input type="text" id="_compte_" name="num_allottement" class="form-control @if ($errors->get('_compte_')) is-invalid @endif" placeholder="Entrer num_allottement">

                                    @if ($errors->get('_compte_'))
                                    @foreach ($errors->get('_compte_') as $message)
                                    <li class="text-danger">{{ $message }}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_nom_" class="form-label">nom_allottement</label>
                                    <input id="_nom_" name="nom_allottement" type="text" class="form-control @if($errors->get('_nom_')) is-invalid @endif" placeholder="nom_allottement">
                                    @if($errors->get('_nom_'))
                                    @foreach($errors->get('_nom_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_adresse_" class="form-label">compagnie</label>
                                    <input id="_adresse_" name="compagnie" type="text" class="form-control @if($errors->get('_adresse_')) is-invalid @endif" placeholder="compagnie">
                                    @if($errors->get('_adresse_'))
                                    @foreach($errors->get('_adresse_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_C_postal_" class="form-label">C postal</label>
                                    <input id="_C_postal_" name="total_accorde" type="text" class="form-control @if($errors->get('_C_postal_')) is-invalid @endif" placeholder="C postal">

                                    @if($errors->get('_C_postal_'))
                                    @foreach($errors->get('_C_postal_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_contact_commercial_" class="form-label">Contact commercial</label>
                                    <input id="_contact_commercial_" name="total_occupe" class="form-control @if($errors->get('_contact_commercial_')) is-invalid @endif" type="text" class="form-control" placeholder="Contact commercial">

                                    @if($errors->get('_contact_commercial_'))
                                    @foreach($errors->get('_contact_commercial_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_telephone_commercial_" class="form-label">Telephone commercial</label>
                                    <input id="_telephone_commercial_" name="reliquat" type="text" class="form-control @if($errors->get('_telephone_commercial_')) is-invalid @endif" placeholder="Telephone commercial">
                                    @if($errors->get('_telephone_commercial_'))
                                    @foreach($errors->get('_telephone_commercial_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_mobile_commercial_" class="form-label">Mobile commercial</label>
                                    <input id="_mobile_commercial_" name="mobile_commercial" type="text" class="form-control @if($errors->get('_mobile_commercial_')) is-invalid @endif" placeholder="Mobile commercial">
                                    @if($errors->get('_mobile_commercial_'))
                                    @foreach($errors->get('_mobile_commercial_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_ville_client_" class="form-label">Ville client</label>
                                    <input id="_ville_client_" name="ville_client" type="text" class="form-control @if($errors->get('_ville_client_')) is-invalid @endif" placeholder="Ville client">
                                    @if($errors->get('_ville_client_'))
                                    @foreach($errors->get('_ville_client_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_tele_client_" class="form-label">Tele client</label>
                                    <input id="_tele_client_" name="tele_client" type="text" class="form-control @if($errors->get('_tele_client_')) is-invalid @endif" placeholder="Tele client">
                                    @if($errors->get('_tele_client_'))
                                    @foreach($errors->get('_tele_client_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="email_client" class="form-label">Email client</label>
                                    <input id="email_client" name="email_client" type="text" class="form-control @if($errors->get('email_client')) is-invalid @endif" placeholder="Email client">
                                    @if($errors->get('email_client'))
                                    @foreach($errors->get('email_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="pays_client" class="form-label">Pays client</label>
                                    <input id="pays_client_" name="pays_client" type="text" class="form-control @if($errors->get('pays_client')) is-invalid @endif" placeholder="Pays client">
                                    @if($errors->get('pays_client'))
                                    @foreach($errors->get('pays_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="fax_client" class="form-label">Fax client</label>
                                    <input id="fax_client" name="fax_client" type="text" class="form-control @if($errors->get('fax_client')) is-invalid @endif" placeholder="Fax client">
                                    @if($errors->get('fax_client'))
                                    @foreach($errors->get('fax_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="marge_client" class="form-label">Marge client</label>
                                    <input id="marge_client_" name="marge_client" type="text" class="form-control @if($errors->get('marge_client')) is-invalid @endif" placeholder="Marge client">
                                    @if($errors->get('marge_client'))
                                    @foreach($errors->get('marge_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="Remarques" class="form-label">Remarques</label>
                                    <input id="Remarques" name="Remarques" type="text" class="form-control @if($errors->get('Remarques')) is-invalid @endif" placeholder="Remarques">
                                    @if($errors->get('Remarques'))
                                    @foreach($errors->get('Remarques') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                                    <button type="Submit" data-tw-dismiss="modal" class="btn btn-primary w-24">Envoyer</button>

                                </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</div>
<!-- END: Model Ajouter Programme -->

<!-- BEGIN:search itineraire -->
<div id="itineraire-rech-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Itinéraire & informations supplémentaires</h2>

                <div class="dropdown sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                        <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                    </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <?php $url_update = route('fiche_client.edit'); ?>
            <form action="{{  route('fiche_client.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_date_retour_Itineraire" class="form-label">Date retour Itineraire</label>
                        <input type="date" id="up_date_retour_Itineraire" name="up_date_retour_Itineraire" type="text" class="form-control">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_ville_Itineraire" class="form-label">Ville</label>
                        <select id="up_ville_Itineraire" name="up_ville_Itineraire" data-search="true" class="w-full" required>
                            <option value="up_ville_Itineraire" disabled selected hidden>Sélectionner ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_Transport_Itineraire" class="form-label">Transport Itineraire</label>
                        <input type="text" id="up_Transport_Itineraire" name="up_Transport_Itineraire" class="form-control" placeholder="Entrer Transport" required>

                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_itineraire_programme" class="form-label">Itineraire</label>
                        <select id="up_itineraire_programme" name="up_itineraire_programme" data-search="true" class="w-full">
                            <option value="up_itineraire_programme" disabled selected hidden>Sélectionner Itinéraire</option>
                            @foreach($liste_itineraires as $liste_itineraires)
                            <option value="{{$liste_itineraires->nom_itineraire??null}}">{{$liste_itineraires->nom_itineraire??null}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                    <button type="submit" class="btn w-20" style="background-color: #00897b  ; color: #ffffff;">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END: search Modal itineraire -->

<!-- BEGIN:search vole dep -->
<div id="vole-dep-rech" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Vole départ</h2>

                <div class="dropdown sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                        <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                    </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <?php $url_update = route('fiche_client.edit'); ?>
            <form action="{{  route('fiche_client.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="num_vol_depart_allotemet_up" class="form-label">N° Vol</label>
                        <input id="num_vol_depart_allotemet_up" name="num_vol_depart_allotemet_up" type="text" class="form-control @if($errors->get('num_vol_depart_allotemet_up')) is-invalid @endif" placeholder="Entrer Num vol de départ" required>
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="parcours_vol_depart_allotement_up" class="form-label">Parcours</label>
                        <select id="parcours_vol_depart_allotement_up" name="parcours_vol_depart_allotement_up" class="form-control">
                            <option value="parcours_vol_depart_allotement_up" disabled selected hidden>parcours</option>
                            @foreach($Gestion_parcours as $Gestion_parcour)
                            <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="total_accorde_vol_depart_allot_up" class="form-label">Total accorde</label>
                        <input required id="total_accorde_vol_depart_allot_up" name="total_accorde_vol_depart_allot_up" type="number" min="0" class="form-control" placeholder="Entrer Total accorde">

                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="heure_depart_vol_retour_allot_up" class="form-label">Heure Départ</label>
                        <input required type="time" id="heure_depart_vol_depart_allot_up" name="heure_depart_vol_retour_allot_up" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="heure_arrivee_vole_depart_allot_up" class="form-label">Heure Arrivée</label>
                        <input required type="time" id="heure_arrivee_vole_depart_allot_up" name="heure_arrivee_vole_depart_allot_up" class="form-control">
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                    <button type="submit" class="btn w-20" style="background-color: #00838f;color: #ffffff;">Envoyer</button>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- END: search vole dep -->

<!-- BEGIN:search vole dep -->
<div id="autre-service-rech-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher service</h2>

                <div class="dropdown sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                        <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                    </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <form action="{{  route('fiche_client.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="Transport_Itineraire" class="form-label">Fournisseur</label>
                        <select id="Transport_Itineraire" name="Transport_Itineraire" data-search="true" class="w-full" required>
                            <option value="Transport_Itineraire" disabled selected hidden>Sélectionner Fournisseur</option>

                        </select>
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_etoile" class="form-label">Nombre étoilé</label>
                        <input type="text" id="up_etoile" name="up_etoile" class="form-control" placeholder="Entrer Service">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_ville_service" class="form-label">Ville</label>
                        <select id="up_ville_service" name="up_ville_service" data-search="true" class="w-full">
                            <option value="up_ville_service" disabled selected hidden>Sélectionner ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_service_prog" class="form-label">Service</label>
                        <input type="text" id="up_service_prog" name="up_service_prog" class="form-control" placeholder="Entrer Service" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                    <button type="submit" class="btn w-20" style="background-color: #00838f;color: #ffffff;">Envoyer</button>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- END: search vole dep -->

<!-- BEGIN:search vole retour -->
<div id="vole-retour-rech-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Vole retour</h2>

                <div class="dropdown sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                        <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                    </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <form action="{{  route('fiche_client.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="date_vole_retour_allotemet_up" class="form-label">Date retour</label>
                        <div class="relative  mx-auto">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <input type="text" id="date_vole_retour_allotemet_up" name="date_vole_retour_allotemet_up" class="datepicker form-control pl-12" data-single-mode="true">
                        </div>
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="num_vol_retour_allotemet_up" class="form-label">N° Vol</label>
                        <input id="num_vol_retour_allotemet_up" name="num_vol_retour_allotemet_up" type="text" class="form-control" placeholder="Entrer Num vol de retour">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="parcours_retour_allotement_up" class="form-label">Parcours</label>
                        <select id="parcours_retour_allotement_up" name="parcours_retour_allotement_up" class="form-control">
                            <option value="parcours_retour_allotement_up" disabled selected hidden>parcours</option>
                            @foreach($Gestion_parcours as $Gestion_parcour)
                            <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="total_accorde_retour_allotement_up" class="form-label">Total accorde</label>
                        <input id="total_accorde_retour_allotement_up" name="total_accorde_retour_allotement_up" type="number" min="0" class="form-control" placeholder="Entrer Total accorde">

                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="heure_depart_vol_retour_allot_up" class="form-label">Heure Départ</label>
                        <input type="time" id="heure_depart_vol_retour_allot_up" name="heure_depart_vol_retour_allot_up" class="form-control">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="heure_arrivee_vole_retour_allot_up" class="form-label">Heure Arrivée</label>
                        <input type="time" id="heure_arrivee_vole_retour_allot_up" name="heure_arrivee_vole_retour_allot_up" class="form-control">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                    <button type="submit" class="btn w-20" style="background-color: #00838f;color: #ffffff;">Envoyer</button>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- END: search vole retour -->

<!-- BEGIN:search vole dep -->
<div id="hotel-prog-rech-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Hotel programme</h2>

                <div class="dropdown sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                        <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                    </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <form action="{{  route('fiche_client.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_ref_Hotels_prog" class="form-label">Réf Hotels</label>
                        <input id="up_ref_Hotels_prog" name="up_ref_Hotels_prog" type="text" class="form-control" placeholder="Entrer réf Hotels" required>
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_ville_Hotel_prg" class="form-label">Ville</label>
                        <select id="up_ville_Hotel_prg" name="up_ville_Hotel_prg" data-search="true" class="w-full" required>
                            <option value="up_ville_Hotel_prg" disabled selected hidden>Ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_date_depart_hotel" class="form-label">Date départ</label>
                        <div class="relative  mx-auto">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <input id="up_date_depart_hotel" name="up_date_depart_hotel" type="date" class="form-control block mx-auto pl-12" required>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_date_retour_hotel" class="form-label">Date retour</label>
                        <div class="relative  mx-auto">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <input id="up_date_retour_hotel" name="up_date_retour_hotel" type="date" class="form-control block mx-auto pl-12" required>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_hotel_prg" class="form-label">Hôtel</label>
                        <select id="up_hotel_prg" name="up_hotel_prg" data-search="true" class="w-full" required>
                            <option disabled selected hidden>Sélectionner Hôtel</option>
                            @foreach($Hotel_t as $Hotel_ts)
                            <option value="{{$Hotel_ts->nom??null}}">{{$Hotel_ts->nom??null}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_bnr_nuits_prg" class="form-label">Nbr nuits</label>
                        <input id="up_bnr_nuits_prg" name="up_bnr_nuits_prg" type="number" min="0" class="form-control" placeholder="Entrer Nbr nuits" required>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_regime_prg" class="form-label">Régime</label>
                        <select id="up_regime_prg" name="up_regime_prg" data-search="true" class="w-full" required>
                            <option disabled selected hidden>Sélectionner Régime</option>
                            @foreach($liste_regimes as $liste_regime)
                            <option value="{{$liste_regime->nom_regime??null}}">{{$liste_regime->nom_regime??null}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_type_chambre_prg" class="form-label">Type chambre</label>
                        <select id="up_type_chambre_prg" name="up_type_chambre_prg" data-search="true" class="w-full" required>
                            <option disabled selected hidden>Sélectionner parcours</option>
                            @foreach($liste_type_chambres as $liste_type_chambre)
                            <option value="{{$liste_type_chambre->type_chambre??null}}">{{$liste_type_chambre->type_chambre??null}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_chambre_prg" class="form-label">Chambre</label>
                        <select id="up_chambre_prg" name="up_chambre_prg" data-search="true" class="w-full" required>
                            <option value="up_chambre_prg" disabled selected hidden>Sélectionner chambre</option>
                            @foreach($liste_chambres as $liste_chambre)
                            <option value="{{$liste_chambre->nom_chambre??null}}">{{$liste_chambre->nom_chambre??null}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_prix_achat_prg" class="form-label">Prix Achat</label>
                        <input id="up_prix_achat_prg" name="up_prix_achat_prg" type="number" min="0" class="form-control" placeholder="Entrer prix achat" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_prix_vente_prg" class="form-label">Prix Vente</label>
                        <input id="up_prix_vente_prg" name="up_prix_vente_prg" type="number" min="0" class="form-control" placeholder="Entrer prix vente" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_prix_prg" class="form-label">Prix prg</label>
                        <input id="up_prix_prg" name="up_prix_prg" type="number" min="0" class="form-control" placeholder="Entrer prix prg" required>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                    <button type="submit" class="btn w-20" style="background-color: #00838f;color: #ffffff;">Envoyer</button>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- END: search vole dep -->

<!-- BEGIN: Modal update hotel prg-->
<div id="updatHotelPrg" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="Hotel-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Hotel programme</h2>

                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="javascript:;" class="dropdown-item">
                                        <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modifier  Modal Body -->

                <form id="update_hotel_prg" name="update_hotel_prg" action="{{ route('hotel.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                        <input type="hidden" id="up_id_hotel" name="up_id_hotel">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ref_Hotels_prog_" class="form-label">Réf Hotels</label>
                            <input id="up_ref_Hotels_prog_" name="up_ref_Hotels_prog_" type="text" class="form-control" placeholder="Entrer réf Hotels" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ville_Hotel_prg_" class="form-label">Ville</label>
                            <select id="up_ville_Hotel_prg_" name="up_ville_Hotel_prg_" data-search="true" class="w-full" required>
                                <option value="up_ville_Hotel_prg_" disabled selected hidden>Ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_date_depart_hotel_" class="form-label">Date départ</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="up_date_depart_hotel_" name="up_date_depart_hotel_" type="date" class="form-control block mx-auto pl-12" required>
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_date_retour_hotel_" class="form-label">Date retour</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="up_date_retour_hotel_" name="up_date_retour_hotel_" type="date" class="form-control block mx-auto pl-12" required>
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_hotel_prg_" class="form-label">Hôtel</label>
                            <select id="up_hotel_prg_" name="up_hotel_prg_" data-search="true" class="w-full" required>
                                <option disabled selected hidden>Sélectionner Hôtel</option>
                                @foreach($Hotel_t as $Hotel_ts)
                                <option value="{{$Hotel_ts->nom??null}}">{{$Hotel_ts->nom??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_bnr_nuits_prg_" class="form-label">Nbr nuits</label>
                            <input id="up_bnr_nuits_prg_" name="up_bnr_nuits_prg_" type="number" min="0" class="form-control" placeholder="Entrer Nbr nuits" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_regime_prg_" class="form-label">Régime</label>
                            <select id="up_regime_prg_" name="up_regime_prg_" data-search="true" class="w-full" required>
                                <option disabled selected hidden>Sélectionner Régime</option>
                                @foreach($liste_regimes as $liste_regime)
                                <option value="{{$liste_regime->nom_regime??null}}">{{$liste_regime->nom_regime??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_type_chambre_prg_" class="form-label">Type chambre</label>
                            <select id="up_type_chambre_prg_" name="up_type_chambre_prg_" data-search="true" class="w-full" required>
                                <option disabled selected hidden>Sélectionner parcours</option>
                                @foreach($liste_type_chambres as $liste_type_chambre)
                                <option value="{{$liste_type_chambre->type_chambre??null}}">{{$liste_type_chambre->type_chambre??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_chambre_prg_" class="form-label">Chambre</label>
                            <select id="up_chambre_prg_" name="up_chambre_prg_" data-search="true" class="w-full" required>
                                <option value="up_chambre_prg_" disabled selected hidden>Sélectionner chambre</option>
                                @foreach($liste_chambres as $liste_chambre)
                                <option value="{{$liste_chambre->nom_chambre??null}}">{{$liste_chambre->nom_chambre??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_prix_achat_prg_" class="form-label">Prix Achat</label>
                            <input id="up_prix_achat_prg_" name="up_prix_achat_prg_" type="number" min="0" class="form-control" placeholder="Entrer prix achat" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_prix_vente_prg_" class="form-label">Prix Vente</label>
                            <input id="up_prix_vente_prg_" name="up_prix_vente_prg_" type="number" min="0" class="form-control" placeholder="Entrer prix vente" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_prix_prg_" class="form-label">Prix prg</label>
                            <input id="up_prix_prg_" name="up_prix_prg_" type="number" min="0" class="form-control" placeholder="Entrer prix prg" required>
                        </div>
                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="submit" class="btn w-20" style="background-color: #00897b ;color: #ffffff;">Envoyer</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: Modal update hotel prg-->

<!-- BEGIN: Delete hotel prg -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-hotel-prg-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">vous êtes sûr?</div>
                            <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer? <br>Ce processus ne peut pas être annulé.</div>
                        </div>

                        <form id="delete_hotel_prg" name="delete_hotel_prg" action="{{ route('hotel.delete') }}" method="post">

                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>


                                <input type="hidden" id="id_delet_hotel" name="id_delet_hotel">

                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger w-24">Supprimer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete hotel prg -->


<!-- BEGIN: Modal update itinerair prg-->
<div id="updatHotelPrg" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="itinerair-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Itinéraire & informations supplémentaires</h2>

                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="javascript:;" class="dropdown-item">
                                        <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modifier  Modal Body -->

                <form id="update_itinerair" name="update_itinerair" action="{{ route('itinerair.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                        <input type="hidden" id="up_id_Itineraire" name="up_id_Itineraire">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_date_retour_Itineraire_" class="form-label">Date retour Itineraire</label>
                            <input type="date" id="up_date_retour_Itineraire_" name="up_date_retour_Itineraire_" type="text" class="form-control">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ville_Itineraire_" class="form-label">Ville</label>
                            <select id="up_ville_Itineraire_" name="up_ville_Itineraire_" data-search="true" class="w-full" required>
                                <option value="up_ville_Itineraire_" disabled selected hidden>Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_Transport_Itineraire_" class="form-label">Transport Itineraire</label>
                            <input type="text" id="up_Transport_Itineraire_" name="up_Transport_Itineraire_" class="form-control" placeholder="Entrer Transport" required>

                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_itineraire_programme_" class="form-label">Itineraire</label>
                            <select id="up_itineraire_programme_" name="up_itineraire_programme_" data-search="true" class="w-full">

                            </select>
                        </div>

                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="submit" class="btn w-20" style="background-color: #00897b ;color: #ffffff;">Envoyer</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: Modal update hotel prg-->

<!-- BEGIN: Delete itinerair prg -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-itinerair-prg-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">vous êtes sûr?</div>
                            <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer itineraires? <br>Ce processus ne peut pas être annulé.</div>
                        </div>

                        <form id="delete_itinerair_prg" name="delete_itinerair_prg" action="{{ route('itinerair.delete') }}" method="post">

                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>


                                <input type="hidden" id="id_delet_itineraire" name="id_delet_itineraire">

                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger w-24">Supprimer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete itinerair prg -->

<!-- BEGIN: Delete service prg -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-service-prg-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">vous êtes sûr?</div>
                            <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer Service? <br>Ce processus ne peut pas être annulé.</div>
                        </div>

                        <form id="delete_service_prg" name="delete_service_prg" action="{{ route('Service.delete') }}" method="post">

                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>


                                <input type="hidden" id="id_delet_service" name="id_delet_service">

                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger w-24">Supprimer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete service prg -->

<!-- BEGIN: Modal update service prg-->
<div id="updatHotelPrg" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="service-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Autres service</h2>

                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="javascript:;" class="dropdown-item">
                                        <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modifier  Modal Body -->

                <form id="update_service" name="update_service" action="{{ route('Service.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                        <input type="hidden" id="up_id_service" name="up_id_service">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="Transport_Itineraire" class="form-label">Fournisseur</label>
                            <select id="Transport_Itineraire" name="Transport_Itineraire" data-search="true" class="w-full" required>
                                <option value="Transport_Itineraire" disabled selected hidden>Sélectionner Fournisseur</option>

                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_etoile" class="form-label">Nombre étoilé</label>
                            <input type="text" id="up_etoile" name="up_etoile" class="form-control" placeholder="Entrer Service">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ville_service" class="form-label">Ville</label>
                            <select id="up_ville_service" name="up_ville_service" data-search="true" class="w-full">
                                <option value="up_ville_service" disabled selected hidden>Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_service_prog" class="form-label">Service</label>
                            <input type="text" id="up_service_prog" name="up_service_prog" class="form-control" placeholder="Entrer Service" required>
                        </div>

                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="submit" class="btn w-20" style="background-color: #00897b ;color: #ffffff;">Envoyer</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: Modal update service prg-->

</div>
<!-- END: gestion Programme -->


</div>


@endsection

@section('jqscripts')
<script type="text/javascript" src="{{URL::asset('js/Gestion_allotement.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_programme.js')}}"></script>
@endsection