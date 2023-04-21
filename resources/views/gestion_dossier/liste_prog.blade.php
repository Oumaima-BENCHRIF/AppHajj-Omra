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
<title>Liste des programmes</title>
@endsection
@section('subcontent')
<!-- style css of tabilator -->
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">

<nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex style">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dossier</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            <!-- <input type="text" id="nom_dossier"> -->
            <span id="nom_dossier"></span>
        </li>
    </ol>
</nav>

<ul class="nav nav-boxed-tabs mt-10" role="tablist">
    <li id="example-3-tab" class="nav-item flex-1" role="presentation">
        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3" aria-selected="true">
            Gestion Programme
        </button>
    </li>
    <li id="example-4-tab" class="nav-item flex-1" role="presentation">
        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-4" type="button" role="tab" aria-controls="example-tab-4" aria-selected="false">
            Gestion Allotement
        </button>
    </li>
</ul>
<div class="tab-content">
    <!-- G.programme -->
    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <!-- <div class="flex items-center mt-5">
            <h2 class="intro-y text-lg font-medium mr-auto">Liste des programmes</h2>
        </div> -->


        <!-- BEGIN: LISTE Dossier -->
        <div class="grid grid-cols-12 gap-6">

            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x:auto;">

                <div class="intro-y box p-5 pt-10">

                    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">

                        <a href="{{ Route('gestion_dossier.index') }}" title="Retour à la gestion des dossiers!" class="tooltip btn btn-primary w-1/2 sm:w-auto mr-2">
                            <span class="w-5 h-5 flex items-center justify-center">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                    <i data-lucide="arrow-left" class="block mx-auto"></i>
                                </div>
                            </span>
                        </a>

                        <!-- <div class="mt-2 xl:mt-0">
                            <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary ">Liste programme</button>
                        </div> -->
                       

                        <div class="flex mt-5 w-full sm:mt-0">


                            <?php $url_Allotement = url('Allotement', $pieces[4]); ?>

                            <?php $url_programme = url('gestion_programme', $pieces[4]); ?>
                            <a href="{{ $url_programme }}" data-tw-toggle="modal" data-tw-target="#ajouter-modal-dossier-preview" class="btn btn-outline-success w-1/2 sm:w-auto mr29">
                                <span class=" h-5 flex items-center justify-center">
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                        Gestion programme
                                    </div>
                                </span>
                            </a>
                            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">

<input id="name" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 " placeholder="entrer le nom de programme     ">
<!-- <button id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16">Go</button> -->
</div>
                            <button id="search-btn" href="javascript:;"  data-tw-target="#large-modal-size-preview" class="btn  btn-outline-danger w-1/2 sm:w-auto mr-2">
                                <span class="w-5 h-5 flex items-center justify-center">
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                        <i data-lucide="search" class="block mx-auto"></i>
                                    </div>
                                </span>
                            </button>
                            <button id="tabulator-print" class="btn  btn-outline-primary  w-1/2 sm:w-auto mr-2">
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
                        <div id="liste_prg" class="mt-5 table-report--tabulator"></div>
                    </div>
                </div>
            </div>
            <!-- END: Data List -->


        </div>
    </div>

    <!-- G.Allotement -->
    <div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">

        <!-- <div class="flex items-center mt-5">
            <h2 class="intro-y text-lg font-medium mr-auto">Liste des Allotements</h2>
        </div> -->


        <!-- BEGIN: LISTE Dossier -->
        <div class="grid grid-cols-12 gap-6">

            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x:auto;">

                <div class="intro-y box p-5 pt-10">

                    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">

                        <a href="{{ Route('gestion_dossier.index') }}" title="Retour à la gestion des dossiers!" class="mr-2 tooltip btn btn-primary sm:w-auto">
                            <span class="w-5 h-5 flex items-center justify-center">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                    <i data-lucide="arrow-left" class="block mx-auto"></i>
                                </div>
                            </span>
                        </a>
                        <?php $url_Allotement = url('Allotement', $pieces[4]); ?>
                            <a href="{{ $url_Allotement}}" data-tw-toggle="modal" data-tw-target="#ajouter-modal-dossier-preview" class="btn btn-outline-success w-1/2 sm:w-auto mr-2">
                                <span class=" h-5 flex items-center justify-center">
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                        Gestion Allotement
                                    </div>
                                </span>
                            </a>
<!-- 
                        <div class="mt-2 xl:mt-0">

                            <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary ">Liste Allotement</button>

                        </div> -->
                        <form id="tabulator-html-filter-form" class="xl:flex sm:ml-auto">

                            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">

                                <input  id="num" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 mr-2" placeholder="Entrer le numero Allotement">
                              
                            </div>

                        </form>
                        <div class="flex mt-5 sm:mt-0">
                            <button id="search-btn" data-tw-target="#large-modal-size-preview" class="btn  btn-outline-danger w-1/2 sm:w-auto mr-2">
                                <span class="w-5 h-5 flex items-center justify-center">
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                        <i data-lucide="search" class="block mx-auto"></i>
                                    </div>
                                </span>
                            </button>
                            <button id="tabulator-print-allotement" class="btn  btn-outline-primary  w-1/2 sm:w-auto mr-2">
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
                        <div id="liste_Allotement" class="mt-5 table-report table-report--tabulator"></div>
                    </div>
                </div>
            </div>
            <!-- END: Data List -->


        </div>
    </div>
</div>


<!-- END:Gestion -->



<!-- BEGIN: Delete Confirmation Modal -->
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
<!-- END: Delete Confirmation Modal -->




<!-- BEGIN: Modal update allotement -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="allot-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Allotement</h2>

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
                <!--  -->
                <form id="up_gestion_allo" name="up_gestion_allo" action="{{ route('allotement.update') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <input type="hidden" id="id_Allotement" name="id_Allotement">

                        <div class="col-span-2 sm:col-span-2">
                            <label for="nom_allot_up" class="form-label">Nom allotement</label>
                            <input type="text" id="nom_allot_up" name="nom_allot_up" class="form-control" placeholder="Entrer nom allotement">
                        </div>
                        <div class="col-span-2 sm:col-span-2">
                            <label for="total_accorde_allot_up" class="form-label">Total accorde</label>
                            <input type='number' class="form-control" id="total_accorde_allot_up" name="total_accorde_allot_up" placeholder="Entrer Total accorde" required />
                        </div>

                        <div class="col-span-2 sm:col-span-2">
                            <label for="total_occupe_allot_up" class="form-label">Total occupe</label>
                            <input type='number' class="form-control" id="total_occupe_allot_up" name="total_occupe_allot_up" placeholder="Entrer Total occupe" required />
                        </div>

                        <div class="col-span-2 sm:col-span-2">
                            <label for="reliquat_allot_up" class="form-label">Reliquat</label>
                            <input type='number' class="form-control" id="reliquat_allot_up" name="reliquat_allot_up" placeholder="Entrer Reliquat" required />
                        </div>

                        <div class="col-span-12 sm:col-span-3">
                            <label for="compagnie_allot_up" class="form-label">Compagnie</label>
                            <select id="compagnie_allot_up" name="compagnie_allot_up" data-search="true" class="form-control w-full" required>

                            </select>
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
<!-- END: Modal update allootement -->


<!-- BEGIN: Delete allotement -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="delete-confirmation-allotement" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Êtes-vous sûr allotement?</div>
                        <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer ces enregistrements ?
                            Ce processus ne peut pas être annulé.</div>
                    </div>
                    <form id="delet_allotement" name="delet_allotement" action="{{ route('allotement.delete') }}" method="post">
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>
                            <input type="hidden" id="delet_id_allot" name="delet_id_allot">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger w-24">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete allotement -->


@endsection

@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/liste_programme.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_allotement.js')}}"></script>
@endsection