@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion Allotement</title>
@endsection

@section('subcontent')
<!-- style css of tabilator -->
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
<div class="flex flex-col sm:flex-row sm:items-end xl:items-start tab-content mt-3">
    <a href="{{  route('Liste_prg.liste') }}/{{ session('projet_id______')}}" class="tooltip btn btn-primary w-1/2 sm:w-auto mr-10" title="Retour a la page précédent!" >
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
        <button id="tabulator-html-filter-reset" type="button" style="background-color: #6a1b9a  ; color: #ffffff;" class="btn btn-secondary ">
            <h2 class="intro-y text-lg font-medium mr-auto" >Gestion Allotement</h2>
        </button>

    </div>
</div>
 
<div class="tab-content mt-1">
   
    <!-- BEGIN: Gestion ALLOTTEMENT -->
    <div id="example-tab-3" class="tab-pane leading-relaxed active" class="padd" role="tabpanel" aria-labelledby="example-3-tab">

        <div style="background-color:#f3e5f5;" class="tab-content intro-y  dark:bg-transparent py-1 sm:py-2 mt-1" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="border border-primary">
                <div class="pading font-medium text-center text-lg">Allottement des compagnies</div>

                <div class="sm:px-1  pt-10 border-t border-slate-200/60 dark:border-darkmode-400 borde-allot">

                    <form id="form_allot" name="form_allot" action="{{ url('allotement_Store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-inline mt-2">
                            
                               
                                <button onclick="Nouveau()"  type="text" id="Nouveau_allot" name="Nouveau_allot" value="Nouveau_allot" class="btn form-control py-1" style="display: none;">Nouveau</button>
                            

                            <div class="intro-y w8 px-1">
                                  <label for="num_allot" class="form-label  mbt-2 text-size">input</label>
                               <input type="text" id="id_allotement" class="form-control py-1 py-1" name="id_allotement">
                            </div>
                            <div class="intro-y w8 px-1">
                                <label for="num_allot" class="form-label  mbt-2 text-size">N°Allottement</label>
                                <select id="num_allot" name="num_allot" class="form-control py-1">
                                    <option value="">Sélectionnez</option>
                                </select>
                            </div>

                            <div class="intro-y w8 px-1">
                                <label for="nom_allot" class="form-label  mbt-2 text-size">Nom</label>
                                <input id="nom_allot" name="nom_allot" type="text" class="form-control py-1" placeholder="Entrer Nom allottement" required>
                            </div>

                            <div class="intro-y w8 px-1">
                                <label for="compagnie_allot" class="form-label  mbt-2 text-size">Compagnie</label>
                                <select id="compagnie_allot" name="compagnie_allot" class="w-full form-control py-1">
                                    <option value="compagnie_allot" class="form-control py-1" disabled selected hidden>Compagnie</option>
                                    @foreach($Gestion_compagnies as $Gestion_compagnie)
                                    <option value="{{$Gestion_compagnie->id}}">{{$Gestion_compagnie->compagnie}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="intro-y w8 px-1">
                                <label for="total_accorde_allot" class="form-label  mbt-2 text-size">Total Accordé</label>
                                <input id="total_accorde_allot" name="total_accorde_allot" type="number" min="0" class="form-control py-1" placeholder="Entrer Total Accordé" required>
                            </div>

                            <div class="intro-y w8 px-1">
                                <label for="total_occupe_allot" class="form-label  mbt-2 text-size">Total occupe</label>
                                <input id="total_occupe_allot" name="total_occupe_allot" onblur="javascript:calcule1(document.getElementById('total_occupe_allot').value, document.getElementById('total_accorde_allot').value);" class="form-control py-1" type="number" class="form-control py-1" placeholder="Entrer Total occupe" required>
                            </div>

                            <div class="intro-y w8 px-1">
                                <label for="reliquat_allot" class="form-label  mbt-2 text-size">Reliquat</label>
                                <input id="reliquat_allot" name="reliquat_allot" type="number"  min="0" class="form-control py-1" placeholder="Entrer reliquat" required>
                            </div>

                            <div class="intro-y w8 px-1">
                                <label for="Nouveau_allot" class="form-label  mbt-2 text-size">Enregistrer</label>
                                <button type="Submit" id="Nouveau_allot" name="Nouveau_allot" value="Nouveau_allot" class="btn form-control py-1" style="background-color: #6a1b9a  ;color: #ffffff;">Enregistrer</button>
                            </div>
                        </div>
                        <div class="intro-y w8 px-1 ">
                           

                        </div>
                    </form>
                </div>

                <!-- ----DEBUT VOLE DEPART---- -->
                <div class="border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class=" mt-2 font-medium text-center text-lg">Voles Départ</div>
                    <div class=" sm:px-1  pt-10 border-t border-slate-200/60 dark:border-darkmode-400 borde-allot">
                        <form id="form_allo1" name="form_allo1" method="POST" action="{{  url('vole_depart_Store')  }}">
                            {{ csrf_field() }}
                            <div class="form-inline mt-2">
                                <div class="intro-y w8 px-1 @if ($errors->get('date_depart_allotement')) has-error @endif">
                                    <label for="date_depart_allotement" class="form-label  mbt-2 text-size">Date départ</label>
                                    <div class="relative  mx-auto">
                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                        </div>
                                        <input type="date" id="date_depart_allotement" name="date_depart_allotement" class="form-control py-1 pl-12" required>
                                    </div>
                                </div>

                                <div class="intro-y w8 px-1">
                                    <label for="num_vol_depart_allotement" class="form-label  mbt-2 text-size">N° Vol</label>
                                    <input required id="num_vol_depart_allotement" name="num_vol_depart_allotement" type="text" class="form-control py-1" placeholder="Entrer Num vol">
                                </div>

                                <div class="intro-y w8 px-1">
                                    <label for="parcours_depart_allotement" class="form-label  mbt-2 text-size">Parcours</label>
                                    <select id="parcours_depart_allotement" name="parcours_depart_allotement" data-search="true" class="form-control py-1" required>
                                        <option value="parcours_depart_allotement" disabled selected hidden>Parcours</option>
                                        @foreach($Gestion_parcours as $Gestion_parcour)
                                        <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="intro-y w8 px-1">
                                    <label for="total_accorde_depart_allotement" class="form-label  mbt-2 text-size">Total accorde</label>
                                    <input id="total_accorde_depart_allotement" name="total_accorde_depart_allotement" type="number"   min="0" class="form-control py-1" placeholder="Entrer Total accorde" required>

                                </div>

                                <div class="intro-y w8 px-1">
                                    <label for="heure_depart_allotement" class="form-label  mbt-2 text-size">Heure Départ</label>
                                    <input type="time" id="heure_depart_allotement" name="heure_depart_allotement" class="form-control py-1" required>
                                </div>

                                <div class="intro-y w8 px-1">
                                    <label for="heure_arrivee_depart_allotement" class="form-label  mbt-2 text-size">Heure Arrivée</label>
                                    <input type="time" id="heure_arrivee_depart_allotement" name="heure_arrivee_depart_allotement" class="form-control py-1" required>
                                </div>

                                <div class="intro-y w8 px-1">
                                    <label for="prix_Achat_dep" class="form-label  mbt-2 text-size">prix Achat</label>
                                    <input type="number" min="0" id="prix_Achat_dep" name="prix_Achat_dep" class="form-control py-1" required>
                                </div>

                                <div class="intro-y w8 px-1">
                                    <label for="prix_vente_dep" class="form-label  mbt-2 text-size">prix vente</label>
                                    <input type="number" min="0" id="prix_vente_dep" name="prix_vente_dep" class="form-control py-1" required>
                                </div>
                                </div>
                              
                          <div class="form-inline mt-2">  
                                <div class="intro-y w8 px-1">
                                    <label for="Ajouter_depat_allotement" class="form-label  mbt-2 text-size"> Ajouter</label>
                                    <button type="submit" id="btn-save" name="Ajouter_depat_allotement" class="btn w-24 ml-2 form-control py-1" style="background-color: #6a1b9a;color: #ffffff;">Ajouter</button>
                                </div>
</div>

                           
                        </form>
                    </div>
                    <!-- debut de liste vole depart -->
                    <div class="grid grid-cols-12 gap-6">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center ">
                        </div>
                        <!-- BEGIN: Data List -->
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x:auto;">
                            <div class="intro-y box">
                                <div class="flex flex-col sm:flex-row sm:items-end xl:items-start pading">
                                    <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                                    </form>
                                    <div class="flex mt-2 sm:mt-0">

                                                   <div class="input-form w-1/2 sm:w-auto  px-1 ">
                            <input type="text" id="num_v" value="" name="num_v" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 mr-2" required="" placeholder="Entrer le code">
                       </div>   
                       <button id="search-btn" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" data-lucide="search" class="lucide lucide-search block mx-auto"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>
                        </span>
                    </button>
                                        <button id="tabulator-print-Vole-Depart" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                        </button>
                                        <div class="dropdown w-1/2 sm:w-auto">
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
                                    <div id="listeVoleDepart" class="mt-2 table-report--tabulator"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Data List -->
                    </div>
                    <!-- Fin de liste date depart -->
                </div>
                <!-- ----FIN VOLE DEPART---- -->
                <!-- ---------------------------------------------------------- -->
                <!-- ----debut Voles Retour---- -->
                <div class="border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="mt-3 font-medium text-center text-lg">Voles Retour</div>
                    <div class="sm:px-20  pt-10 border-t border-slate-200/60 dark:border-darkmode-400 borde-allot">
                        <form id="form_allo_vole_retour" name="form_allo_vole_retour" method="POST" action="{{  url('vole_retour_Store')  }}">
                            {{ csrf_field() }}

                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control py-1 col-span-2">
                                    <label for="date_vole_retour_allotemet" class="form-label  mbt-2 text-size">Date retour</label>
                                    <div class="relative  mx-auto">
                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                        </div>
                                        <input type="date" id="date_vole_retour_allotemet" name="date_vole_retour_allotemet" class="form-control py-1 pl-12" required>
                                    </div>
                                </div>

                                <div class="form-control py-1 col-span-1  @if ($errors->get('num_vol_retour_allotemet')) has-error @endif">
                                    <label for="num_vol_retour_allotemet" class="form-label  mbt-2 text-size">N° Vol</label>
                                    <input id="num_vol_retour_allotemet" name="num_vol_retour_allotemet" type="text" class="form-control py-1 @if($errors->get('num_vol_retour_allotemet')) is-invalid @endif" placeholder="Entrer Num vol de retour" required>
                                    @if($errors->get('num_vol_retour_allotemet'))
                                    @foreach($errors->get('num_vol_retour_allotemet') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="form-control py-1 col-span-2">
                                    <label for="parcours_retour_allotement" class="form-label  mbt-2 text-size">Parcours</label>
                                    <select id="parcours_retour_allotement" name="parcours_retour_allotement" data-search="true" class="tom-select w-full">
                                        <option value="parcours_retour_allotement" disabled selected hidden>parcours</option>
                                        @foreach($Gestion_parcours as $Gestion_parcour)
                                        <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-control py-1 col-span-1">
                                    <label for="total_accorde_retour_allotement" class="form-label  mbt-2 text-size">Total accorde</label>
                                    <input id="total_accorde_retour_allotement" name="total_accorde_retour_allotement" type="number" class="form-control py-1" placeholder="Entrer Total accorde" required>
                                </div>

                                <div class="form-control py-1 col-span-2">
                                    <label for="heure_depart_vol_retour_allot" class="form-label  mbt-2 text-size">Heure Départ</label>
                                    <input type="time" id="heure_depart_vol_retour_allot" name="heure_depart_vol_retour_allot" class="form-control py-1" required>
                                </div>

                                <div class="form-control py-1 col-span-1">
                                    <label for="heure_arrivee_vole_retour_allot" class="form-label  mbt-2 text-size">Heure Arrivée</label>
                                    <input type="time" id="heure_arrivee_vole_retour_allot" name="heure_arrivee_vole_retour_allot" class="form-control py-1" required>
                                </div>

                                <div class="form-control py-1 col-span-1">
                                    <label for="prix_Achat_retour" class="form-label  mbt-2 text-size">prix Achat</label>
                                    <input type="number" min="0" id="prix_Achat_retour" name="prix_Achat_retour" class="form-control py-1" required>
                                </div>

                                <div class="form-control py-1 col-span-1">
                                    <label for="prix_vente_retour" class="form-label  mbt-2 text-size">prix vente</label>
                                    <input type="number"  min="0" id="prix_vente_retour" name="prix_vente_retour" class="form-control py-1" required>
                                </div>

                                <div class="form-control py-1 col-span-1">
                                    <label for="ajouter_vol_retour_allot" class="form-label  mbt-2 text-size"> Ajouter</label>
                                    <button type="submit" id="ajouter_vol_retour_allot" name="ajouter_vol_retour_allot" value="ajouter_vol_retour_allot" class="btn w-24 ml-2 form-control py-1" style="background-color: #6a1b9a ;color: #ffffff;">Ajouter</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- debut de liste date depart -->
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x:auto;">
                        <div class="intro-y box ">
                            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start pading">
                                <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                                </form>
                                <div class="flex mt-1 sm:mt-0">
                                <div class="input-form w-1/2 sm:w-auto  px-1 ">
                            <input type="text" id="num_vo" value="" name="num_vo" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 mr-2" required="" placeholder="Entrer le code">
                       </div>   
                       <button id="search-btn" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" data-lucide="search" class="lucide lucide-search block mx-auto"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>
                        </span>
                    </button>
                                    <button id="tabulator-print-vole-retour" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                    </button>
                                    <div class="dropdown w-1/2 sm:w-auto">
                                        <button class="dropdown-toggle btn btn-outline-dark w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown">
                                            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
                                        </button>
                                        <div class="dropdown-menu w-40">
                                            <ul class="dropdown-content">
                                               
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
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto scrollbar-hidden">
                                <div id="listeVoleRetour" class="mt-2 table-report--tabulator"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data List -->

                </div>
                <!-- Fin de liste date depart -->
            </div>
        </div>
        <!-- ----FIN Voles Retour---- -->
    </div>
    <!-- END ALLOTTEMENT -->
    <!-- </form> -->
</div>
<!-- End: Gestion ALLOTTEMENT -->
<!-- ------------------------------------------- -->

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
                            <label for="date_vole_retour_allotemet_up" class="form-label  mbt-2 text-size">Date retour</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="date_vole_retour_allotemet_up" name="date_vole_retour_allotemet_up" class="datepicker form-control py-1 pl-12" data-single-mode="true">
                            </div>
                        </div>

                        <input type="hidden" id="id_vole_retour_up" name="id_vole_retour_up">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="num_vol_retour_allotemet_up" class="form-label  mbt-2 text-size">N° Vol</label>
                            <input id="num_vol_retour_allotemet_up" name="num_vol_retour_allotemet_up" type="text" class="form-control py-1 @if($errors->get('num_vol_retour_allotemet_up')) is-invalid @endif" placeholder="Entrer Num vol de retour">
                            @if($errors->get('num_vol_retour_allotemet'))
                            @foreach($errors->get('num_vol_retour_allotemet') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="parcours_retour_allotement_up" class="form-label  mbt-2 text-size">Parcours</label>
                            <select id="parcours_retour_allotement_up" name="parcours_retour_allotement_up" class="form-control py-1">
                                <option value="parcours_retour_allotement_up" disabled selected hidden>parcours</option>
                                @foreach($Gestion_parcours as $Gestion_parcour)
                                <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="total_accorde_retour_allotement_up" class="form-label  mbt-2 text-size">Total accorde</label>
                            <input id="total_accorde_retour_allotement_up" name="total_accorde_retour_allotement_up" type="number"  min="0"class="form-control py-1 @if($errors->get('total_accorde_retour_allotement_up')) is-invalid @endif" placeholder="Entrer Total accorde">
                            @if($errors->get('total_accorde_retour_allotement_up'))
                            @foreach($errors->get('total_accorde_retour_allotement_up') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_depart_vol_retour_allot_up" class="form-label  mbt-2 text-size">Heure Départ</label>
                            <input type="time" id="heure_depart_vol_retour_allot_up" name="heure_depart_vol_retour_allot_up" class="form-control py-1">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_arrivee_vole_retour_allot_up" class="form-label  mbt-2 text-size">Heure Arrivée</label>
                            <input type="time" id="heure_arrivee_vole_retour_allot_up" name="heure_arrivee_vole_retour_allot_up" class="form-control py-1">
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
                            <label for="vole_depart_allotemet_Dt_depart" class="form-label  mbt-2 text-size">Date départ</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="date" id="vole_depart_allotemet_Dt_depart" name="vole_depart_allotemet_Dt_depart" class="form-control py-1 pl-12" data-single-mode="true" required>
                            </div>
                        </div>

                        <input type="hidden" id="id_vole_depart_up" name="id_vole_depart_up">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="num_vol_depart_allotemet_up" class="form-label  mbt-2 text-size">N° Vol</label>
                            <input id="num_vol_depart_allotemet_up" name="num_vol_depart_allotemet_up" type="text" class="form-control py-1 @if($errors->get('num_vol_depart_allotemet_up')) is-invalid @endif" placeholder="Entrer Num vol de départ" required>
                            @if($errors->get('num_vol_depart_allotemet_up'))
                            @foreach($errors->get('num_vol_depart_allotemet_up') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="parcours_vol_depart_allotement_up" class="form-label  mbt-2 text-size">Parcours</label>
                            <select id="parcours_vol_depart_allotement_up" name="parcours_vol_depart_allotement_up" class="form-control py-1">
                                <option value="parcours_vol_depart_allotement_up" disabled selected hidden>parcours</option>
                                @foreach($Gestion_parcours as $Gestion_parcour)
                                <option value="{{$Gestion_parcour->id}}">{{$Gestion_parcour->nom_parcours}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="total_accorde_vol_depart_allot_up" class="form-label  mbt-2 text-size">Total accorde</label>
                            <input required id="total_accorde_vol_depart_allot_up" name="total_accorde_vol_depart_allot_up" type="number"  min="0" class="form-control py-1" placeholder="Entrer Total accorde">

                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_depart_vol_retour_allot_up" class="form-label  mbt-2 text-size">Heure Départ</label>
                            <input required type="time" id="heure_depart_vol_depart_allot_up" name="heure_depart_vol_retour_allot_up" class="form-control py-1">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="heure_arrivee_vole_depart_allot_up" class="form-label  mbt-2 text-size">Heure Arrivée</label>
                            <input required type="time" id="heure_arrivee_vole_depart_allot_up" name="heure_arrivee_vole_depart_allot_up" class="form-control py-1">
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
                                    <label for="_compte_" class="form-label  mbt-2 text-size">num_allottement</label>

                                    <input type="text" id="_compte_" name="num_allottement" class="form-control py-1 @if ($errors->get('_compte_')) is-invalid @endif" placeholder="Entrer num_allottement">

                                    @if ($errors->get('_compte_'))
                                    @foreach ($errors->get('_compte_') as $message)
                                    <li class="text-danger">{{ $message }}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_nom_" class="form-label  mbt-2 text-size">nom_allottement</label>
                                    <input id="_nom_" name="nom_allottement" type="text" class="form-control py-1 @if($errors->get('_nom_')) is-invalid @endif" placeholder="nom_allottement">
                                    @if($errors->get('_nom_'))
                                    @foreach($errors->get('_nom_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_adresse_" class="form-label  mbt-2 text-size">compagnie</label>
                                    <input id="_adresse_" name="compagnie" type="text" class="form-control py-1 @if($errors->get('_adresse_')) is-invalid @endif" placeholder="compagnie">
                                    @if($errors->get('_adresse_'))
                                    @foreach($errors->get('_adresse_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_C_postal_" class="form-label  mbt-2 text-size">C postal</label>
                                    <input id="_C_postal_" name="total_accorde" type="text" class="form-control py-1 @if($errors->get('_C_postal_')) is-invalid @endif" placeholder="C postal">

                                    @if($errors->get('_C_postal_'))
                                    @foreach($errors->get('_C_postal_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_contact_commercial_" class="form-label  mbt-2 text-size">Contact commercial</label>
                                    <input id="_contact_commercial_" name="total_occupe" class="form-control py-1 @if($errors->get('_contact_commercial_')) is-invalid @endif" type="text" class="form-control py-1" placeholder="Contact commercial">

                                    @if($errors->get('_contact_commercial_'))
                                    @foreach($errors->get('_contact_commercial_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_telephone_commercial_" class="form-label  mbt-2 text-size">Telephone commercial</label>
                                    <input id="_telephone_commercial_" name="reliquat" type="text" class="form-control py-1 @if($errors->get('_telephone_commercial_')) is-invalid @endif" placeholder="Telephone commercial">
                                    @if($errors->get('_telephone_commercial_'))
                                    @foreach($errors->get('_telephone_commercial_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_mobile_commercial_" class="form-label  mbt-2 text-size">Mobile commercial</label>
                                    <input id="_mobile_commercial_" name="mobile_commercial" type="text" class="form-control py-1 @if($errors->get('_mobile_commercial_')) is-invalid @endif" placeholder="Mobile commercial">
                                    @if($errors->get('_mobile_commercial_'))
                                    @foreach($errors->get('_mobile_commercial_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_ville_client_" class="form-label  mbt-2 text-size">Ville client</label>
                                    <input id="_ville_client_" name="ville_client" type="text" class="form-control py-1 @if($errors->get('_ville_client_')) is-invalid @endif" placeholder="Ville client">
                                    @if($errors->get('_ville_client_'))
                                    @foreach($errors->get('_ville_client_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_tele_client_" class="form-label  mbt-2 text-size">Tele client</label>
                                    <input id="_tele_client_" name="tele_client" type="text" class="form-control py-1 @if($errors->get('_tele_client_')) is-invalid @endif" placeholder="Tele client">
                                    @if($errors->get('_tele_client_'))
                                    @foreach($errors->get('_tele_client_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="email_client" class="form-label  mbt-2 text-size">Email client</label>
                                    <input id="email_client" name="email_client" type="text" class="form-control py-1 @if($errors->get('email_client')) is-invalid @endif" placeholder="Email client">
                                    @if($errors->get('email_client'))
                                    @foreach($errors->get('email_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="pays_client" class="form-label  mbt-2 text-size">Pays client</label>
                                    <input id="pays_client_" name="pays_client" type="text" class="form-control py-1 @if($errors->get('pays_client')) is-invalid @endif" placeholder="Pays client">
                                    @if($errors->get('pays_client'))
                                    @foreach($errors->get('pays_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="fax_client" class="form-label  mbt-2 text-size">Fax client</label>
                                    <input id="fax_client" name="fax_client" type="text" class="form-control py-1 @if($errors->get('fax_client')) is-invalid @endif" placeholder="Fax client">
                                    @if($errors->get('fax_client'))
                                    @foreach($errors->get('fax_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="marge_client" class="form-label  mbt-2 text-size">Marge client</label>
                                    <input id="marge_client_" name="marge_client" type="text" class="form-control py-1 @if($errors->get('marge_client')) is-invalid @endif" placeholder="Marge client">
                                    @if($errors->get('marge_client'))
                                    @foreach($errors->get('marge_client') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="Remarques" class="form-label  mbt-2 text-size">Remarques</label>
                                    <input id="Remarques" name="Remarques" type="text" class="form-control py-1 @if($errors->get('Remarques')) is-invalid @endif" placeholder="Remarques">
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
                        <label for="up_date_retour_Itineraire" class="form-label  mbt-2 text-size">Date retour Itineraire</label>
                        <input type="date" id="up_date_retour_Itineraire" name="up_date_retour_Itineraire" type="text" class="form-control py-1">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_ville_Itineraire" class="form-label  mbt-2 text-size">Ville</label>
                        <select id="up_ville_Itineraire" name="up_ville_Itineraire" data-search="true" class="w-full" required>
                            <option value="up_ville_Itineraire" disabled selected hidden>Sélectionner ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_Transport_Itineraire" class="form-label  mbt-2 text-size">Transport Itineraire</label>
                        <input type="text" id="up_Transport_Itineraire" name="up_Transport_Itineraire" class="form-control py-1" placeholder="Entrer Transport" required>

                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_itineraire_programme" class="form-label  mbt-2 text-size">Itineraire</label>
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
                        <label for="Transport_Itineraire" class="form-label  mbt-2 text-size">Fournisseur</label>
                        <select id="Transport_Itineraire" name="Transport_Itineraire" data-search="true" class="w-full" required>
                            <option value="Transport_Itineraire" disabled selected hidden>Sélectionner Fournisseur</option>

                        </select>
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_etoile" class="form-label  mbt-2 text-size">Nombre étoilé</label>
                        <input type="text" id="up_etoile" name="up_etoile" class="form-control py-1" placeholder="Entrer Service">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_ville_service" class="form-label  mbt-2 text-size">Ville</label>
                        <select id="up_ville_service" name="up_ville_service" data-search="true" class="w-full">
                            <option value="up_ville_service" disabled selected hidden>Sélectionner ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_service_prog" class="form-label  mbt-2 text-size">Service</label>
                        <input type="text" id="up_service_prog" name="up_service_prog" class="form-control py-1" placeholder="Entrer Service" required>
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
                        <label for="up_ref_Hotels_prog" class="form-label  mbt-2 text-size">Réf Hotels</label>
                        <input id="up_ref_Hotels_prog" name="up_ref_Hotels_prog" type="text" class="form-control py-1" placeholder="Entrer réf Hotels" required>
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_ville_Hotel_prg" class="form-label  mbt-2 text-size">Ville</label>
                        <select id="up_ville_Hotel_prg" name="up_ville_Hotel_prg" data-search="true" class="w-full" required>
                            <option value="up_ville_Hotel_prg" disabled selected hidden>Ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_date_depart_hotel" class="form-label  mbt-2 text-size">Date départ</label>
                        <div class="relative  mx-auto">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <input id="up_date_depart_hotel" name="up_date_depart_hotel" type="date" class="form-control py-1 block mx-auto pl-12" required>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_date_retour_hotel" class="form-label  mbt-2 text-size">Date retour</label>
                        <div class="relative  mx-auto">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <input id="up_date_retour_hotel" name="up_date_retour_hotel" type="date" class="form-control py-1 block mx-auto pl-12" required>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_hotel_prg" class="form-label  mbt-2 text-size">Hôtel</label>
                        <select id="up_hotel_prg" name="up_hotel_prg" data-search="true" class="w-full" required>
                            <option disabled selected hidden>Sélectionner Hôtel</option>
                            @foreach($Hotel_t as $Hotel_ts)
                            <option value="{{$Hotel_ts->nom??null}}">{{$Hotel_ts->nom??null}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_bnr_nuits_prg" class="form-label  mbt-2 text-size">Nbr nuits</label>
                        <input id="up_bnr_nuits_prg" name="up_bnr_nuits_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer Nbr nuits" required>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_regime_prg" class="form-label  mbt-2 text-size">Régime</label>
                        <select id="up_regime_prg" name="up_regime_prg" data-search="true" class="w-full" required>
                            <option disabled selected hidden>Sélectionner Régime</option>
                            @foreach($liste_regimes as $liste_regime)
                            <option value="{{$liste_regime->nom_regime??null}}">{{$liste_regime->nom_regime??null}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_type_chambre_prg" class="form-label  mbt-2 text-size">Type chambre</label>
                        <select id="up_type_chambre_prg" name="up_type_chambre_prg" data-search="true" class="w-full" required>
                            <option disabled selected hidden>Sélectionner parcours</option>
                            @foreach($liste_type_chambres as $liste_type_chambre)
                            <option value="{{$liste_type_chambre->type_chambre??null}}">{{$liste_type_chambre->type_chambre??null}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_chambre_prg" class="form-label  mbt-2 text-size">Chambre</label>
                        <select id="up_chambre_prg" name="up_chambre_prg" data-search="true" class="w-full" required>
                            <option value="up_chambre_prg" disabled selected hidden>Sélectionner chambre</option>
                            @foreach($liste_chambres as $liste_chambre)
                            <option value="{{$liste_chambre->nom_chambre??null}}">{{$liste_chambre->nom_chambre??null}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_prix_achat_prg" class="form-label  mbt-2 text-size">Prix Achat</label>
                        <input id="up_prix_achat_prg" name="up_prix_achat_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer prix achat" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_prix_vente_prg" class="form-label  mbt-2 text-size">Prix Vente</label>
                        <input id="up_prix_vente_prg" name="up_prix_vente_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer prix vente" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="up_prix_prg" class="form-label  mbt-2 text-size">Prix prg</label>
                        <input id="up_prix_prg" name="up_prix_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer prix prg" required>
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
                            <label for="up_ref_Hotels_prog" class="form-label  mbt-2 text-size">Réf Hotels</label>
                            <input id="up_ref_Hotels_prog" name="up_ref_Hotels_prog" type="text" class="form-control py-1" placeholder="Entrer réf Hotels" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ville_Hotel_prg" class="form-label  mbt-2 text-size">Ville</label>
                            <select id="up_ville_Hotel_prg" name="up_ville_Hotel_prg" data-search="true" class="w-full" required>
                                <option value="up_ville_Hotel_prg" disabled selected hidden>Ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_date_depart_hotel" class="form-label  mbt-2 text-size">Date départ</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="up_date_depart_hotel" name="up_date_depart_hotel" type="date" class="form-control py-1 block mx-auto pl-12" required>
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_date_retour_hotel" class="form-label  mbt-2 text-size">Date retour</label>
                            <div class="relative  mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input id="up_date_retour_hotel" name="up_date_retour_hotel" type="date" class="form-control py-1 block mx-auto pl-12" required>
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_hotel_prg" class="form-label  mbt-2 text-size">Hôtel</label>
                            <select id="up_hotel_prg" name="up_hotel_prg" data-search="true" class="w-full" required>
                                <option disabled selected hidden>Sélectionner Hôtel</option>
                                @foreach($Hotel_t as $Hotel_ts)
                                <option value="{{$Hotel_ts->nom??null}}">{{$Hotel_ts->nom??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_bnr_nuits_prg" class="form-label  mbt-2 text-size">Nbr nuits</label>
                            <input id="up_bnr_nuits_prg" name="up_bnr_nuits_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer Nbr nuits" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_regime_prg" class="form-label  mbt-2 text-size">Régime</label>
                            <select id="up_regime_prg" name="up_regime_prg" data-search="true" class="w-full" required>
                                <option disabled selected hidden>Sélectionner Régime</option>
                                @foreach($liste_regimes as $liste_regime)
                                <option value="{{$liste_regime->nom_regime??null}}">{{$liste_regime->nom_regime??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_type_chambre_prg" class="form-label  mbt-2 text-size">Type chambre</label>
                            <select id="up_type_chambre_prg" name="up_type_chambre_prg" data-search="true" class="w-full" required>
                                <option disabled selected hidden>Sélectionner parcours</option>
                                @foreach($liste_type_chambres as $liste_type_chambre)
                                <option value="{{$liste_type_chambre->type_chambre??null}}">{{$liste_type_chambre->type_chambre??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_chambre_prg" class="form-label  mbt-2 text-size">Chambre</label>
                            <select id="up_chambre_prg" name="up_chambre_prg" data-search="true" class="w-full" required>
                                <option value="up_chambre_prg" disabled selected hidden>Sélectionner chambre</option>
                                @foreach($liste_chambres as $liste_chambre)
                                <option value="{{$liste_chambre->nom_chambre??null}}">{{$liste_chambre->nom_chambre??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_prix_achat_prg" class="form-label  mbt-2 text-size">Prix Achat</label>
                            <input id="up_prix_achat_prg" name="up_prix_achat_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer prix achat" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_prix_vente_prg" class="form-label  mbt-2 text-size">Prix Vente</label>
                            <input id="up_prix_vente_prg" name="up_prix_vente_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer prix vente" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_prix_prg" class="form-label  mbt-2 text-size">Prix prg</label>
                            <input id="up_prix_prg" name="up_prix_prg" type="number"  min="0" class="form-control py-1" placeholder="Entrer prix prg" required>
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
                            <label for="up_date_retour_Itineraire" class="form-label  mbt-2 text-size">Date retour Itineraire</label>
                            <input type="date" id="up_date_retour_Itineraire" name="up_date_retour_Itineraire" type="text" class="form-control py-1">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ville_Itineraire" class="form-label  mbt-2 text-size">Ville</label>
                            <select id="up_ville_Itineraire" name="up_ville_Itineraire" data-search="true" class="w-full" required>
                                <option value="up_ville_Itineraire" disabled selected hidden>Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_Transport_Itineraire" class="form-label  mbt-2 text-size">Transport Itineraire</label>
                            <input type="text" id="up_Transport_Itineraire" name="up_Transport_Itineraire" class="form-control py-1" placeholder="Entrer Transport" required>

                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_itineraire_programme" class="form-label  mbt-2 text-size">Itineraire</label>
                            <select id="up_itineraire_programme" name="up_itineraire_programme" data-search="true" class="w-full">
                                <option value="up_itineraire_programme" disabled selected hidden>Sélectionner Itinéraire</option>
                                @foreach($liste_itineraires as $liste_itineraires)
                                <option value="{{$liste_itineraires->nom_itineraire??null}}">{{$liste_itineraires->nom_itineraire??null}}</option>
                                @endforeach
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
                            <label for="Transport_Itineraire" class="form-label  mbt-2 text-size">Fournisseur</label>
                            <select id="Transport_Itineraire" name="Transport_Itineraire" data-search="true" class="w-full" required>
                                <option value="Transport_Itineraire" disabled selected hidden>Sélectionner Fournisseur</option>

                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_etoile" class="form-label  mbt-2 text-size">Nombre étoilé</label>
                            <input type="text" id="up_etoile" name="up_etoile" class="form-control py-1" placeholder="Entrer Service">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ville_service" class="form-label  mbt-2 text-size">Ville</label>
                            <select id="up_ville_service" name="up_ville_service" data-search="true" class="w-full">
                                <option value="up_ville_service" disabled selected hidden>Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom??null}}">{{$ville->nom??null}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_service_prog" class="form-label  mbt-2 text-size">Service</label>
                            <input type="text" id="up_service_prog" name="up_service_prog" class="form-control py-1" placeholder="Entrer Service" required>
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
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_allotement.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_programme.js')}}"></script>
@endsection