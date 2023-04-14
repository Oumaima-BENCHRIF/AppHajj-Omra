@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

$currentUrl = 'http';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $currentUrl .= "s";
}
$currentUrl .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$pieces = explode("/", $currentUrl);

?>

@section('subhead')
<title>Liste réservation</title>
@endsection
@section('subcontent')
<!-- style css of tabilator -->
<link rel="stylesheet" href="{{URL::asset('css/Style_reservation.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">

<nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex style">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dossier</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            <span id="nom_dossier"></span>
        </li>
        <li class="breadcrumb-item"><a href="#">Programme</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            <span id="nom_programme"></span>
        </li>
    </ol>
</nav>
<div class="tab-content mt-1">
    <!-- G.programme -->
    <!-- <div class="flex flex-col sm:flex-row sm:items-end xl:items-start tab-content mt-3">
        <div class="mt-2 xl:mt-0">
            <button id="tabulator-html-filter-reset" type="button" style="background-color: #1A488E  ; color: #ffffff;" class="btn btn-secondary ">
                <h2 class="intro-y text-lg font-medium mr-auto">Listes chambres</h2>
            </button>

        </div>
    </div> -->

    <!-- BEGIN: LISTE Dossier -->
    <div class="grid grid-cols-12 gap-6 mt-1">

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x:auto;">

            <div class="intro-y box p-5 mt-1">
                <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <div class="mt-2 xl:mt-0">
                            <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary ">Listes chambres</button>

                        </div>
                <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                    </form>
                    <div class="flex mt-5 sm:mt-0">
                        <a href="{{  route('Liste_prg.liste') }}/{{ session('projet_id______')}}" class="tooltip btn btn-primary w-1/2 sm:w-auto mr-10" title="Retour a la page précédent!">
                            <span class="w-5 h-5 flex items-center justify-center">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="arrow-left" data-lucide="arrow-left" class="lucide lucide-arrow-left block mx-auto">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>
                                </div>
                            </span>
                        </a>

                        <?php $url_Allotement = url('Allotement', $pieces[4]); ?>

                        <?php $url_programme = url('gestion_programme', $pieces[4]); ?>
                        <a href="{{ $url_programme }}" data-tw-toggle="modal" data-tw-target="#ajouter-modal-dossier-preview" class="btn btn-outline-success w-1/2 sm:w-auto mr-2">
                            <span class=" h-5 flex items-center justify-center">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                    Gestion programme
                                </div>
                            </span>
                        </a>
                        <button href="javascript:;" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn  btn-outline-danger w-1/2 sm:w-auto mr-2">
                            <span class="w-5 h-5 flex items-center justify-center">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                    <i data-lucide="search" class="block mx-auto"></i>
                                </div>
                            </span>
                        </button>
                        <button id="tabulator-print-reservation" class="btn  btn-outline-primary  w-1/2 sm:w-auto mr-2">
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
                    <div id="liste_reservation" class="mt-5 table-report--tabulator"></div>
                </div>
            </div>
        </div>
        <!-- END: Data List -->


    </div>


</div>


<!-- END:Gestion -->



<!-- BEGIN: Delete réservation -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Êtes-vous sûr?</div>
                        <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer ces enregistrements ?
                            Ce processus ne peut pas être annulé.</div>
                    </div>
                    <form id="delet_prg" name="delet_prg" action="{{ route('prg.delete') }}" method="post">
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>
                            <input type="hidden" id="delet_id_prg" name="delet_id_prg">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger w-24">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete réservation -->


<!-- BEGIN:update réservation -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Programmes</h2>

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
                <form id="up_prg" name="up_prg" action="{{ route('prg.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <input type="hidden" id="up_id_prg" name="up_id_prg">

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="nom_programme" class="form-label">Nom programme</label>
                            <input id="nom_programme" name="nom_programme" type="text" class="form-control" placeholder="Entrer nom programme" required>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="type_programme" class="form-label">Type programme</label>
                            <select id="type_programme" name="type_programme" data-search="true" class="form-control w-full" required>

                            </select>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="nbr_nuitee_prog_mdina" class="form-label">Nbr nuitées Médine</label>
                            <input id="nbr_nuitee_prog_mdina" name="nbr_nuitee_prog_mdina" class="form-control" type="number" placeholder="Entrer Nbr nuitées programme Médine" required>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="nbr_nuitee_prog_maka" class="form-label">Nbr nuitées Makka</label>
                            <input id="nbr_nuitee_prog_maka" name="nbr_nuitee_prog_maka" class="form-control" type="number" placeholder="Entrer Nbr nuitées programme Makka" required>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="num_vole_dep" class="form-label">Num vole départ</label>
                            <select id="num_vole_dep" name="num_vole_dep" data-search="true" class="form-control w-full" required>

                            </select>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="nbr_place_aller" class="form-label">Nbr place départ</label>
                            <input id="nbr_place_aller" name="nbr_place_aller" class="form-control" type="number" placeholder="Entrer Nbr place départ" required>
                        </div>
                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="nbr_reserver_dep" class="form-label">Nbr réserver départ</label>
                            <input id="nbr_reserver_dep" name="nbr_reserver_dep" class="form-control" type="number" placeholder="Entrer nbr réserver départ" required>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2 @if ($errors->get('num_vole_retour')) has-error @endif">
                            <label for="num_vole_retour" class="form-label">Num vole retour</label>
                            <select id="num_vole_retour" name="num_vole_retour" data-search="true" class="form-control w-full" required>

                            </select>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="nbr_place_retour" class="form-label">Nbr place retour</label>
                            <input id="nbr_place_retour" name="nbr_place_retour" class="form-control" type="number" placeholder="Entrer Nbr place retour" required>
                        </div>

                        <div class="intro-y col-span-2 sm:col-span-2">
                            <label for="nbr_reserver_retour" class="form-label">Nbr reserver retour</label>
                            <input id="nbr_reserver_retour" name="nbr_reserver_retour" class="form-control" type="number" placeholder="Entrer Nbr reserver retour" required>
                        </div>
                        <input type="hidden" id="up_FK_dossier" name="up_FK_dossier">


                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="submit" class="btn btn-primary w-20">Envoyer</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END:update réservation  -->


<!-- BEGIN: search réservation  -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Rechercher Dossier</h2>

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
                <!-- -->
                <form id="search_gestion_dossier" name="search_gestion_dossier" action="{{ url('rech_dossier') }}" method="get">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="Rech_nom_dossier" class="form-label">Nom dossier</label>
                            <input type="text" id="Rech_nom_dossier" name="Rech_nom_dossier" class="form-control" placeholder="Entrer nom dossier">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="Rech_hijri_date" class="form-label">Date Hijri</label>
                            <input type='number' class="form-control" id="Rech_hijri_date" name="Rech_hijri_date" placeholder="Entrer Date Hijri" />
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="Rech_date_debut" class="form-label">Date Début</label>
                            <input type='date' class="form-control" id="Rech_date_debut" name="Rech_date_debut" placeholder="Entrer date début" />
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="Rech_date_fin" class="form-label">Date fin</label>
                            <input type='date' class="form-control" id="Rech_date_fin" name="Rech_date_fin" placeholder="Entrer date fin" />
                        </div>

                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="submit" class="btn btn-primary w-20">Envoyer</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: search réservation -->

@endsection

@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_reservation.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('js/Gestion_fiche_inscription.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{URL::asset('js/liste_programme.js')}}"></script> -->
@endsection