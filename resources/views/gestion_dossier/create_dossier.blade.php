@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion Dossier</title>
@endsection

@section('subcontent')
<!-- style css of tabilator -->
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">

<div class="px-5 mt-10 mb-6">
    <h2 class="font-medium text-center text-lg style_dossier">Gestion Dossier</h2>
</div>
<!-- BEGIN: LISTE Dossier -->
<!-- <h2 class="intro-y text-lg font-medium mt-10">Liste Dossier</h2> -->

<div class="grid grid-cols-12 gap-6 mt-5">

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x:auto;">

        <div class="intro-y box p-5 mt-5">
            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                </form>

                <div class="flex mt-5 w-full sm:mt-0">
                @if (Auth::user()->permissions->contains('name','Ajouter_Dossier'))
                
                    <button href="javascript:;" data-tw-toggle="modal" data-tw-target="#ajouter-modal-dossier-preview" class="btn btn-outline-success w-1/2 mr15 sm:w-auto mr-2">
                        <span class=" h-5 flex items-center justify-center">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                               Ajouter Dossier
                            </div>
                        </span>
                    </button>
                    @endif
                
                    <div class="input-form w-1/2 sm:w-auto  px-1 ">
                            

                            <input type="text" id="name" value="" name="name" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 mr-2" required="" placeholder="Entrer nom de dossier">
              
                       </div>          
                       <div class="input-form w-1/2 sm:w-auto  mr-2 px-1 ">
                           
                     
                            <input type="date"" id="date" value="" name="date" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 mr-2" required="" >
              
                      </div>
                    <button id="search-btn" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" data-lucide="search" class="lucide lucide-search block mx-auto"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>
                        </span>
                    </button>
                              
                    @if (Auth::user()->permissions->contains('name','Print_table_Dossier'))
                    <button id="tabulator-print" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                    </button>
                    @endif
                    @if (Auth::user()->permissions->contains('name','Export_Table_Dossier'))
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
                    @endif
                </div>
            </div>
            <input id="permiConsult" type="hidden" value={{Auth::user()->permissions->contains('name','Consulter_Dossier')}}>
            <input id="permiUpdate" type="hidden" value={{Auth::user()->permissions->contains('name','Update_Dossier')}}>
            <input id="permiDelete" type="hidden" value={{Auth::user()->permissions->contains('name','Delete_Dossier')}}>
        
            <div class="overflow-x-auto scrollbar-hidden">
                <div id="liste_dossier" class="mt-5 table-report--tabulator"></div>
            </div>
        </div>
    </div>
    <!-- END: Data List -->


</div>

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
                    <form id="delet_gestion_dossier" name="delet_gestion_dossier" action="{{ route('gestion_dossier.delete') }}" method="post">
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>
                            <input type="hidden" id="delet_id_dossier" name="delet_id_dossier">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger w-24">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END: Delete Confirmation Modal -->

<!-- BEGIN: Modal update -->

<!-- END: Modal update -->
<!-- BEGIN: Modal update -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Dossier</h2>

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


                <form id="up_gestion_dossier" name="up_gestion_dossier" action="{{ route('gestion_dossier.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <input type="hidden" id="up_id_dossier" name="up_id_dossier">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_nom_dossier" class="form-label">Nom dossier</label>
                            <input type="text" id="up_nom_dossier" name="up_nom_dossier" class="form-control" placeholder="Entrer nom dossier">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_hijri_date" class="form-label">Date Hijri</label>
                            <input type='number' class="form-control" id="up_hijri_date" name="up_hijri_date" placeholder="Entrer Date Hijri" required />
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_date_debut" class="form-label">Date Début</label>
                            <input type='date' class="form-control" id="up_date_debut" name="up_date_debut" placeholder="Entrer date début" required />
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_date_fin" class="form-label">Date fin</label>
                            <input type='date' class="form-control" id="up_date_fin" name="up_date_fin" placeholder="Entrer date fin" required />
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
<!-- END: Modal Content -->



<!-- BEGIN: Ajouter Modal Dossier -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="ajouter-modal-dossier-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Ajouter Dossier</h2>
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
                <form id="ajouter_gestion" name="ajouter_gestion" action="{{ url('gestion_dossier_Store') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="nom_dossier" class="form-label">Nom dossier</label>
                            <input type="text" id="nom_dossier" name="nom_dossier" class="form-control" placeholder="Entrer nom dossier" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="hijri_date" class="form-label">Date Hijri</label>
                            <input type='number' class="form-control" id="hijri_date" name="hijri_date" placeholder="Entrer Date Hijri" required />
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="date_debut" class="form-label">Date Début</label>
                            <input type="date" id="date_debut" name="date_debut" class="form-control block mx-auto" required>
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="date_fin" class="form-label">Date Fin</label>
                            <input type="date" id="date_fin" name="date_fin" class="form-control block mx-auto" required>
                        </div>

                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Annuler</button>
                        <button type="Submit" class="btn btn-primary w-24 ml-2">Envoyer</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: Ajouter Modal dossier -->

@endsection

@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_dossier.js')}}"></script>
<script>
    function showDialogueDeletedossier(id) {
        console.log(id);
        document.getElementById("__id").value = id;
        // ajaxPost;

    }

    function ajaxPost(url, callback, datas = []) {
        const formData = new FormData();
        formData.append('_token', document.querySelector("[name='csrf-token']").content);
        datas.forEach((data) => {
            formData.append(data.key, data.value);
        })
        fetch(url, {
                method: 'POST',
                body: formData,
                credentials: 'include'
            })
            .then(response => response.json())
            .then(result => {
                callback(result)
            })
        //        .catch(error => { alert('Error:', error.nom_dossier); document.getElementById("dialogue-wait").style.display = "none"; });
    }

    // function showDialogueModifierdossier(url) {

    //     console.log(url);

    //     // document.getElementById("id_").value = id;

    //     ajaxPost(url, (obj) => {

    //         // --------------------------- fill
    //         const nv = obj.dossier;
    //         document.getElementById("_id_").value = nv.id;
    //         document.getElementById("up_nom_dossier").value = nv.nom_dossier;
    //         document.getElementById("hijri_date_").value = nv.hijri_date;
    //         document.getElementById("Date_debut_").value = nv.Date_debut;
    //         document.getElementById("Date_fin_").value = nv.Date_fin;
    //         // console.log(document.getElementById("url_update").value);
    //     });
    // }
</script>
<script>

</script>
@endsection