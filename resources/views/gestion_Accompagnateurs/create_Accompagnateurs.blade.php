@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Gestion Accompagnateurs</title>
@endsection
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

@section('subcontent')

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

<!-- BEGIN: gestion Accompagnateurs -->
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="px-5 mt-10 mb-6">
                <div class="font-medium text-center text-lg">gestion Accompagnateurs</div>
            </div>
            @if (Auth::user()->permissions->contains('name','Ajouter_Accompagnateurs'))
            <form id="Add_Acompagnateur" action="{{ url('Accompagnateurs_Stores') }}" method="post" class="validate-form my-5">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">

                        <div class="intro-y w3 px-1 @if ($errors->get('code')) has-error @endif">
                            <label for="code" class="form-label mbt-2 text-size">Code</label>

                            <input type="text" id="code" name="code" class="form-control py-1 @if ($errors->get('code')) is-invalid @endif" placeholder="Entrer code">

                            @if ($errors->get('code'))
                            @foreach ($errors->get('code') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w3 px-1 @if ($errors->get('nom_prenom')) has-error @endif">
                            <label for="nom_prenom" class="form-label mbt-2 text-size">Nom & prenom</label>
                            <input id="nom_prenom" name="nom_prenom" type="text" class="form-control py-1 @if($errors->get('nom_prenom')) is-invalid @endif" placeholder="Entrer Nom & prenom">
                            @if($errors->get('nom_prenom'))
                            @foreach($errors->get('nom_prenom') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w3 px-1  @if ($errors->get('telephone')) has-error @endif">
                            <label for="telephone" class="form-label mbt-2 text-size">Telephone</label>
                            <input id="telephone" name="telephone" type="text" class="form-control py-1 @if($errors->get('telephone')) is-invalid @endif" placeholder="Entrer telephone">
                            @if($errors->get('telephone'))
                            @foreach($errors->get('telephone') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                  </div>
                 <div class="form-inline mt-2">
                        <div class="intro-y w3 px-1  @if ($errors->get('fax')) has-error @endif">
                            <label for="fax" class="form-label mbt-2 text-size">Fax</label>
                            <input id="fax" name="fax" type="text" class="form-control py-1 @if($errors->get('fax')) is-invalid @endif" placeholder="Entrer Fax">

                            @if($errors->get('fax'))
                            @foreach($errors->get('fax') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w3 px-1  @if ($errors->get('adresse')) has-error @endif">
                            <label for="adresse" class="form-label mbt-2 text-size">Adresse</label>
                            <input id="adresse" name="adresse" type="text" class="form-control py-1 @if($errors->get('adresse')) is-invalid @endif" placeholder="Entrer adresse">

                            @if($errors->get('adresse'))
                            @foreach($errors->get('adresse') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w3 px-1  @if ($errors->get('prix')) has-error @endif">
                            <label for="prix" class="form-label mbt-2 text-size">Prix</label>
                            <input id="prix" name="prix" type="text" class="form-control py-1 @if($errors->get('prix')) is-invalid @endif" placeholder="Entrer prix">

                            @if($errors->get('prix'))
                            @foreach($errors->get('prix') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                  </div>
                        <div class="form-inline justify-content-end">
                            {{-- <a class="btn btn-secondary w-24" >Liste</a> --}}
                            <button type="Submit" class="btn btn-primary mt-6 py-1 mr-1">Envoyer</button>
                        </div>
               
             </div>
            </form>
            @endif
        
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
                                    @if (Auth::user()->permissions->contains('name','Print_table_Accompagnateur'))
                                        <button id="tabulator-print-To" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                        </button>
                                        @endif
                                        @if (Auth::user()->permissions->contains('name','Export_Table_Accompagnateur'))
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
                                <input id="permiUpdate" type="hidden" value={{Auth::user()->permissions->contains('name','Update_Accompagnateur')}}>
                               <input id="permiDelete" type="hidden" value={{Auth::user()->permissions->contains('name','Delete_Accompagnateur')}}>
                                <div class="overflow-x-auto scrollbar-hidden">
                                    <div id="liste_Accompagnateur" class="mt-5 table-report--tabulator"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Data List -->
                    </div>
                    <!-- Fin de liste date depart -->
    </div>
    </div></div>
</div>

<!-- END: Accompagnateurs  -->

<!-- BEGIN: LISTE Accompagnateurs -->


    <!-- BEGIN: Delete TO Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Êtes-vous sûr?</div>
                        <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer ces enregistrements ? Ce <br>processus ne peut pas être annulé.</div>
                    </div>
                    <form id="delet_hotel_fourni" name="delet_hotel_fourni" action="{{ route('Accompagnateurs.delete') }}" method="post">

                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>
                            <input type="hidden" id="__id" name="__id">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger w-24">Supprimer</button>

                    </form>

                </div>
            </div>
        </div>
    </div>


<!-- END: Delete  Confirmation Modal -->

<!-- BEGIN: Modal update -->

<!-- END: Modal update -->
<!-- BEGIN: Modal update -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Accompagnateurs</h2>

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

                
                <form id="update_Acompagnateur" action="{{ route('Accompagnateurs.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_code" class="form-label">Code</label>
                            <input id="_code" name="_code" value="{{old('_code')}}" type="text" class="form-control" placeholder="Code">
                        </div>

                        <input type="hidden" id="id__" name="id__">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="_nom_prenom" class="form-label">Nom prenom</label>
                            <input id="_nom_prenom" name="_nom_prenom" value="{{old('_nom_prenom')}}" type="text" class="form-control" placeholder="Nom prenom">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_adresse" class="form-label">Adresse</label>
                            <input id="_adresse" name="_adresse" value="{{old('_adresse')}}" type="text" class="form-control" placeholder="Adresse">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_fax" class="form-label">Fax</label>
                            <input id="_fax" name="_fax" value="{{old('_fax')}}" type="text" class="form-control" placeholder="Fax">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_telephone" class="form-label">Telephone</label>
                            <input id="_telephone" name="_telephone" type="text" value="{{old('_telephone')}}" class="form-control" placeholder="Telephone">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="_prix" class="form-label">prix</label>
                            <input id="_prix" name="_prix" type="text" value="{{old('_prix')}}" value="{{old('_prix')}}" class="form-control" placeholder="prix">
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
<!-- END: Modal Content -->

<!-- BEGIN: Model Ajouter Accompagnateurs-->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">

    <div id="static-backdrop-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">

                    <!-- BEGIN: Modal Header -->
                    <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto">Ajouter Accompagnateur</h2>
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

                    <form id="Add_Acompagnateur" action="{{  route('Accompagnateurs.store')  }}" method="post">
                        {{ csrf_field() }}
                        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="code" class="form-label">Code</label>
                                    <input id="code" type="text" class="form-control" placeholder="code" name="code">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="nom_prenom" class="form-label">Nom prenom</label>
                                    <input id="nom_prenom" name="nom_prenom" type="text" class="form-control" placeholder="Nom prenom">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="adresse" class="form-label">adresse</label>
                                    <input id="adresse" name="adresse" type="text" class="form-control" placeholder="Adresse">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="prix" class="form-label">prix</label>
                                    <input id="prix" name="prix" type="text" class="form-control" placeholder="Prix">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input id="telephone" name="telephone" type="text" class="form-control" placeholder="Telephone">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="fax" class="form-label">Fax</label>
                                    <input id="fax" name="fax" type="text" class="form-control" placeholder="Fax">
                                </div>
                                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                    <button type="Submit" class="btn btn-primary w-24 ml-2">Envoyer</button>
                                </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- END: Model Ajouter Accompagnateurs -->

<!-- BEGIN: Modal Recherche Accompagnateurs -->
<div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Accompagnateurs</h2>

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
           
            <form  action="{{  route('Accompagnateurs.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="code__" class="form-label">Code</label>
                        <input id="code__" name="code__" type="text" class="form-control" placeholder="Code">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="nom_prenom__" class="form-label">Nom prenom</label>
                        <input id="nom_prenom__" name="nom_prenom__" type="text" class="form-control" placeholder="Nom prenom">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="adresse__" class="form-label">Adresse</label>
                        <input id="adresse__" name="adresse__" type="text" class="form-control" placeholder="Adresse">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="fax__" class="form-label">Fax</label>
                        <input id="fax__" name="fax__" type="text" class="form-control" placeholder="C postal">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="telephone__" class="form-label">Telephone</label>
                        <input id="telephone__" name="telephone__" type="text" class="form-control" placeholder="Telephone">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="prix__" class="form-label">Prix</label>
                        <input id="prix__" name="prix__" type="text" class="form-control" placeholder="Prix">
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
<!-- END: search Modal Content -->

</div>
<!-- END: gestion fiche client -->


</div>


@endsection
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_accompagnateurs.js')}}"></script>
<script>
    function showDialogueDeleteAccompagnateurs(id) {
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
        //        .catch(error => { alert('Error:', error.compte); document.getElementById("dialogue-wait").style.display = "none"; });
    }

    function showDialogueModifierAccompagnateurs(url) {

        console.log(url);

        // document.getElementById("id_").value = id;

        ajaxPost(url, (obj) => {

            // --------------------------- fill
            const nv = obj.Accompa;
            console.log(nv);
            document.getElementById("id__").value = nv.id;
            document.getElementById("_code").value = nv.code;
            document.getElementById("_nom_prenom").value = nv.nom_prenom;
            document.getElementById("_adresse").value = nv.adresse;
            document.getElementById("_fax").value = nv.fax;
            document.getElementById("_telephone").value = nv.telephone;
            document.getElementById("_prix").value = nv.prix;
            // console.log(document.getElementById("url_update").value);
        });
    }
</script>
@endsection