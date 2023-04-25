@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion Agents</title>

@endsection
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
@section('subcontent')
<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">gestion Agents</h2>
</div>
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


<!-- BEGIN: gestion Agents -->
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="px-5 mt-10 mb-6">
                <div class="font-medium text-center text-lg">gestion Agents</div>
            </div>
            @if (Auth::user()->permissions->contains('name','Ajouter_Agents'))
            <form id="Add_Agents" action="{{  route('Agents.store')  }}" method="post">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">

                        <div class="intro-y w5 px-1 @if ($errors->get('code_agents')) has-error @endif">
                            <label for="code_agents" class="form-label mbt-2 text-size">Code agents</label>
                            <input id="code_agents" type="text" class="form-control py-1 @if($errors->get('code_agents')) is-invalid @endif" placeholder="Code agents" name="code_agents">
                            @if($errors->get('code_agents'))
                            @foreach($errors->get('code_agents') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('nom_agents')) has-error @endif">
                            <label for="nom_agents" class="form-label mbt-2 text-size">Nom agents</label>
                            <input id="nom_agents" name="nom_agents" type="text" class="form-control py-1 @if($errors->get('nom_agents')) is-invalid @endif" placeholder="Nom agents">
                            @if($errors->get('nom_agents'))
                            @foreach($errors->get('nom_agents') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('adresse')) has-error @endif">
                            <label for="adresse" class="form-label mbt-2 text-size">Adresse</label>
                            <input id="adresse" name="adresse" type="text" class="form-control py-1 @if($errors->get('adresse')) is-invalid @endif" placeholder="adresse">
                            @if($errors->get('adresse'))
                            @foreach($errors->get('adresse') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('telephone')) has-error @endif">
                            <label for="telephone" class="form-label mbt-2 text-size">Telephone</label>
                            <input id="telephone" name="telephone" type="text" class="form-control py-1 @if($errors->get('telephone')) is-invalid @endif" placeholder="Telephone">
                            @if($errors->get('telephone'))
                            @foreach($errors->get('telephone') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('fax')) has-error @endif">
                            <label for="fax" class="form-label mbt-2 text-size">Fax</label>
                            <input id="fax" name="fax" type="text" class="form-control py-1 @if($errors->get('fax')) is-invalid @endif" placeholder="Fax">
                            @if($errors->get('fax'))
                            @foreach($errors->get('fax') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                  </div>
                        <div class="form-inline justify-content-end">
                            <!-- <a class="btn btn-secondary w-24" href="{{ url('liste_Agents') }}">Liste</a> -->
                            <button type="Submit" class="btn btn-primary mt-6 py-1 mr-1">Envoyer</button>
                        </div>
                       
            </form>
            @endif  
            </div>
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
                                    @if (Auth::user()->permissions->contains('name','Print_table_Agents'))
                                        <button id="tabulator-print-To" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                        </button>
                                        @endif
                                        @if (Auth::user()->permissions->contains('name','Export_Table_Agents'))
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
                                <input id="permiUpdate" type="hidden" value={{Auth::user()->permissions->contains('name','Update_Agents')}}>
                               <input id="permiDelete" type="hidden" value={{Auth::user()->permissions->contains('name','Delete_Agents')}}>
                                <div class="overflow-x-auto scrollbar-hidden">
                                    <div id="liste_Agents" class="mt-5 table-report--tabulator"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Data List -->
                    </div>
                    <!-- Fin de liste date depart -->
    </div>

</div>
<!-- END: gestion Agents -->


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
                    <form id="delet_hotel_fourni" name="delet_hotel_fourni" action="{{ route('Agents.delete') }}" method="post">

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

</div>
<!-- END: Delete  Confirmation Modal -->

<!-- BEGIN: Modal update Agents-->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Modifier Agents</h2>

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
                <!-- END: Modal Agents Header -->
                <!-- BEGIN: Modifier Modal Agents -->

              
                <form id="update_Agents" name="update_Agents" action="{{ route('Agents.update') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="code_agents_" class="form-label">Code agent</label>
                            <input id="code_agents_" name="code_agents_" value="{{old('code_agents_')}}" type="text" class="form-control" placeholder="Code agents">
                        </div>

                        <input type="hidden" id="id_" name="id_">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="nom_agents_" class="form-label">Nom & agent</label>
                            <input id="nom_agents_" name="nom_agents_" value="{{old('nom_agents_')}}" type="text" class="form-control" placeholder="Nom & prenom">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="telephone_" class="form-label">Telephone</label>
                            <input id="telephone_" name="telephone_" type="text" value="{{old('telephone_')}}" class="form-control" placeholder="Telephone">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="fax_" class="form-label">Fax</label>
                            <input id="fax_" name="fax_" type="text" value="{{old('fax_')}}" value="{{old('fax')}}" class="form-control" placeholder="Fax">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="adresse_" class="form-label">Adresse</label>
                            <input id="adresse_" name="adresse_" type="text" value="{{old('adresse_')}}" class="form-control" placeholder="adresse">
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
                        <h2 class="font-medium text-base mr-auto">Ajouter Agents</h2>
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

                    <form action="{{  route('Agents.store')  }}" method="post">
                        {{ csrf_field() }}
                        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="code_agents" class="form-label">Code agents</label>
                                    <input id="code_agents" type="text" class="form-control" placeholder="Code agents" name="code_agents">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="nom_agents" class="form-label">Nom agents</label>
                                    <input id="nom_agents" name="nom_agents" type="text" class="form-control" placeholder="Nom agents">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input id="adresse" name="adresse" type="text" class="form-control" placeholder="adresse">
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

<!-- END: Model Ajouter Agents -->

<!-- BEGIN: Modal Recherche Agents -->
<div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Agents</h2>

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
            <!-- BEGIN: Modal rechercher Agents -->
            <?php $url_update = route('Agents.edit'); ?>
            <form action="{{  route('Agents.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__code_agents_" class="form-label">Code Agents</label>
                        <input id="__code_agents_" name="__code_agents_" type="text" class="form-control" placeholder="Code Agents">
                    </div>

                    <input type="hidden" id="id__" name="id__">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="__nom_agents_" class="form-label">Nom agents</label>
                        <input id="__nom_agents_" name="__nom_agents_" type="text" class="form-control" placeholder="Nom Agent">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__telephone__" class="form-label">Telephone</label>
                        <input id="__telephone__" name="__telephone__" type="text" class="form-control" placeholder="Telephone">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__fax__" class="form-label">Fax</label>
                        <input id="__fax__" name="__fax__" type="text" class="form-control" placeholder="Fax">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="__adresse__" class="form-label">Adresse</label>
                        <input id="__adresse__" name="__adresse__" type="text" class="form-control" placeholder="Adresse">
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
<!-- END: recherche Modal Agents -->

</div>
<!-- END: gestion Agents-->


</div>


@endsection
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_agents.js')}}"></script>

<script>
    function showDialogueDeleteAgents(id) {
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


    function showDialogueModifierAccompagnateurs(url) {



        ajaxPost(url, (obj) => {

            // --------------------------- fill
            const nv = obj.Agent;
            console.log(nv);
            document.getElementById("id_").value = nv.id;
            document.getElementById("code_agents_").value = nv.code_agents;
            document.getElementById("nom_agents_").value = nv.nom_agents;
            document.getElementById("adresse_").value = nv.adresse;
            document.getElementById("fax_").value = nv.fax;
            document.getElementById("telephone_").value = nv.telephone;
            // console.log(document.getElementById("url_update").value);
        });
    }
</script>

@endsection