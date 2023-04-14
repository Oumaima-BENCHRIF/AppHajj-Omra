@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion TO</title>

@endsection
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
@section('subcontent')
<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Gestion TO</h2>
</div>

<!-- BEGIN: gestion TO -->
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="px-5 mt-10 mb-6">
                <div class="font-medium text-center text-lg">Gestion TO</div>
            </div>
            @if (Auth::user()->permissions->contains('name','Ajouter_To'))
            <form id="Add_To" name="Add_to" action="{{ url('To_Store') }}" method="post">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">

                        <div class="intro-y w5 px-1 @if ($errors->get('code')) has-error @endif">
                            <label for="code" class="form-label mbt-2 text-size ">Code</label>

                            <input type="text" id="code" name="code" class="form-control py-1 @if ($errors->get('code')) is-invalid @endif" placeholder="Entrer code">

                            @if ($errors->get('code'))
                            @foreach ($errors->get('code') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('nom')) has-error @endif">
                            <label for="nom" class="form-label mbt-2 text-size">Nom</label>
                            <input id="nom" name="nom" type="text" class="form-control py-1 @if($errors->get('nom')) is-invalid @endif" placeholder="Entrer Nom">
                            @if($errors->get('nom'))
                            @foreach($errors->get('nom') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                        <div class="intro-y w5 px-1 @if ($errors->get('telephone')) has-error @endif">
                            <label for="telephone" class="form-label mbt-2 text-size ">Telephone</label>
                            <input id="telephone" name="telephone" type="text" class="form-control py-1 @if($errors->get('telephone')) is-invalid @endif" placeholder="Entrer telephone">
                            @if($errors->get('telephone'))
                            @foreach($errors->get('telephone') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('fax')) has-error @endif">
                            <label for="fax" class="form-label mbt-2 text-size">Fax</label>
                            <input id="fax" name="fax" type="text" class="form-control py-1 @if($errors->get('fax')) is-invalid @endif" placeholder="Entrer Fax">

                            @if($errors->get('fax'))
                            @foreach($errors->get('fax') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('ville')) has-error @endif">
                            <label for="ville" class="form-label mbt-2 text-size">Ville</label>
                            <select id="ville" name="ville" data-search="true" class="form-control py-1 @if ($errors->get('ville')) is-invalid @endif">
                                <option value="ville">Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->id}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>
                            @if($errors->get('ville'))
                            @foreach($errors->get('ville') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                    </div>



                    <div class="form-inline justify-content-end">
                        <button type="Submit" class="btn btn-primary mt-6 py-1 mr-1">Envoyer</button>
                    </div>
                </div>
            </form>
@endif
            <!-- debut de liste TO -->
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
                                    @if (Auth::user()->permissions->contains('name','Print_table_To'))
                                        <button id="tabulator-print-To" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                        </button>
                                        @endif
                                        @if (Auth::user()->permissions->contains('name','Export_Table_To'))
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
                                        @endif
                                    </div>
                                </div>
                                <input id="permiUpdate" type="hidden" value={{Auth::user()->permissions->contains('name','Update_To')}}>
                               <input id="permiDelete" type="hidden" value={{Auth::user()->permissions->contains('name','Delete_To')}}>
                                <div class="overflow-x-auto scrollbar-hidden">
                                    <div id="liste_Tos" class="mt-4 table-report--tabulator"></div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto scrollbar-hidden">
                            <div id="liste_Tos" class="mt-2 table-report--tabulator"></div>
                        </div>
                    </div>
                </div>
                <!-- END: Data List -->
            </div>
            <!-- Fin de liste date depart -->
        </div>

    </div>

</div>
<!-- END: gestion TO -->

<!-- BEGIN: LISTE TO -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">




    <!-- BEGIN: Delete TO Confirmation Modal -->
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Êtes-vous sûr?</div>
                            <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer ces enregistrements ? Ce processus ne peut pas être annulé.</div>
                        </div>
                        <form id="delete_To" name="delete_To" action="{{ route('To.delete') }}" method="post">

                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>


                                <input type="hidden" id="id_TOs" name="id_TOs">

                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger w-24">Supprimer</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete TO Confirmation Modal -->

<!-- BEGIN: Modal update TO-->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier TO</h2>

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
                <!-- END: Modal TO Header -->
                <!-- BEGIN: Modifier Modal TO -->

                <form id="update_to" name="update_to" action="{{ route('To.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-3 sm:col-span-3">
                            <label for="up_code_to" class="form-label">Code</label>
                            <input id="up_code_to" name="up_code_to" value="{{old('up_code_to')}}" type="text" class="form-control" placeholder="Code">
                        </div>

                        <input type="hidden" id="up_id_to" name="up_id_to">

                        <div class="col-span-3 sm:col-span-3">
                            <label for="up_nom_to" class="form-label">Nom</label>
                            <input id="up_nom_to" name="up_nom_to" value="{{old('up_nom_to')}}" type="text" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_telephone_to" class="form-label">Telephone</label>
                            <input id="up_telephone_to" name="up_telephone_to" value="{{old('up_telephone_to')}}" type="text" class="form-control" placeholder="Telephone">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_fax_to" class="form-label">Fax</label>
                            <input id="up_fax_to" name="up_fax_to" value="{{old('up_fax_to')}}" type="text" class="form-control" placeholder="Fax">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="up_ville_to" class="form-label">Ville</label>
                            <select id="up_ville_to" name="up_ville_to" data-search="true" class="form-control py-1 @if ($errors->get('ville')) is-invalid @endif">
                                <option value="ville">Sélectionner ville</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->id}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-20">Send</button>
                    </div>
                </form>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
</div>
<!-- END: Modal modifier TO -->

<!-- BEGIN: Model Ajouter TO -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">

    <div id="static-backdrop-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">

                    <!-- BEGIN: Modal Header -->
                    <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto">Ajouter TO</h2>
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

                    <form id="formmaritime" name="formmaritime" action="{{ url('To_Store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                                <div class="intro-y col-span-12 sm:col-span-6 @if ($errors->get('code')) has-error @endif">
                                    <label for="code" class="form-label">code</label>

                                    <input require="require" type="text" id="code" name="code" class="form-control @if ($errors->get('code')) is-invalid @endif" placeholder="Entrer code">

                                    @if ($errors->get('code'))
                                    @foreach ($errors->get('code') as $message)
                                    <li class="text-danger">{{ $message }}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6 @if ($errors->get('nom')) has-error @endif">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input id="nom" name="nom" type="text" class="form-control @if($errors->get('nom')) is-invalid @endif" placeholder="Nom">
                                    @if($errors->get('nom'))
                                    @foreach($errors->get('nom') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6 @if ($errors->get('telephone')) has-error @endif">
                                    <label for="telephone" class="form-label">telephone</label>
                                    <input id="telephone" name="telephone" type="text" class="form-control @if($errors->get('telephone')) is-invalid @endif" placeholder="telephone">
                                    @if($errors->get('telephone'))
                                    @foreach($errors->get('telephone') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6 @if ($errors->get('fax')) has-error @endif">
                                    <label for="fax" class="form-label">fax</label>
                                    <input id="fax" name="fax" type="text" class="form-control @if($errors->get('fax')) is-invalid @endif" placeholder="fax">

                                    @if($errors->get('fax'))
                                    @foreach($errors->get('fax') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6 @if ($errors->get('ville')) has-error @endif">
                                    <label for="ville" class="form-label">ville</label>
                                    <select id="ville" name="ville" data-search="true" class="form-control py-1 @if ($errors->get('ville')) is-invalid @endif">
                                        <option value="ville">Sélectionner ville</option>
                                        @foreach($villes as $ville)
                                        <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                    <!-- <input type="button" value="Click me" onclick="formmaritime(this)"> -->
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                    <button type="submit" data-tw-dismiss="modal" class="btn btn-primary w-24">Envoyer</button>


                                </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

</div>

<!-- END: Model Ajouter TO -->

<!-- BEGIN: Modal Recherche TO -->
<div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher TO</h2>

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
            <!-- BEGIN: Modal rechercher TO -->
            <?php $url_update = route('To.edit'); ?>
            <form action="{{  route('To.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__code__" class="form-label">code</label>
                        <input id="__code__" name="__code__" type="text" class="form-control" placeholder="code">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="__nom__" class="form-label">Nom</label>
                        <input id="__nom__" name="__nom__" type="text" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__telephone__" class="form-label">Telephone</label>
                        <input id="__telephone__" name="__telephone__" type="text" class="form-control" placeholder="telephone">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__fax__" class="form-label">Fax</label>
                        <input id="__fax__" name="__fax__" type="text" class="form-control" placeholder="telephone">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__ville__" class="form-label">Ville</label>
                        <select id="ville" name="ville" data-search="true" class="form-control py-1 @if ($errors->get('ville')) is-invalid @endif">
                            <option value="ville">Sélectionner ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="submit" class="btn btn-primary w-20">Send</button>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- END: recherche Modal TO -->

</div>
<!-- END: gestion TO-->


</div>

<script>
    function showDialogueDeleteTO(id) {
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
        //        .catch(error => { alert('Error:', error.code); document.getElementById("dialogue-wait").style.display = "none"; });
    }

    function showDialogueModifierTO(url) {

        console.log(url);

        // document.getElementById("id_").value = id;

        ajaxPost(url, (obj) => {

            // --------------------------- fill
            const nv = obj.to_s;
            document.getElementById("_id_").value = nv.id;
            document.getElementById("code_to").value = nv.code;
            document.getElementById("nom_to").value = nv.nom;
            document.getElementById("telephone_to").value = nv.telephone;
            document.getElementById("fax_to").value = nv.fax;
            document.getElementById("ville_to").value = nv.ville;
            // console.log(document.getElementById("url_update").value);
        });
    }
</script>

@endsection
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_To.js')}}"></script>

@endsection