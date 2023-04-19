@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion Client/Agence</title>
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
@endsection

@section('subcontent')
<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Gestion Client/Agence</h2>
</div>
 <div class="px-5 sm:px-20  "></div>
   <!-- <div class="grid grid-cols-6 gap-4">
        <div class="intro-y col-span-12 sm:col-span-6">
            @if (session()->has('danger'))

            <div class="alert alert-danger alert-dismissible show flex items-center mbt-2 text-size" role="alert">
                <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> <strong class="text-light"> {{ session()->get('danger') }}</strong>
                <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            @endif
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible show flex items-center mb-5" role="alert">
                <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> <strong class="text-light"> {{ session()->get('success') }}</strong>
                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            @endif
        </div>
    </div>
 -->
<!-- <ul class="nav nav-boxed-tabs" role="tablist">
    <li id="example-3-tab" class="nav-item flex-1" role="presentation">
        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3" aria-selected="true"> Créer Société/Agence </button>
    </li>
    <li id="example-4-tab" class="nav-item flex-1" role="presentation">
        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-4" type="button" role="tab" aria-controls="example-tab-4" aria-selected="false">
            Consulter Société/Agence
        </button>
    </li>
</ul> -->
<!-- BEGIN: gestion fiche client -->
<div class="tab-content">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="px-5 mt-10 mb-6">
                <div class="font-medium text-center text-lg">Gestion Client/Agence</div>
            </div>
            @if (Auth::user()->permissions->contains('name','Ajouter_ClientAgence'))
            <form id="Ajouter_fiche_client" name="Ajouter_fiche_client" action="{{ url('fiche_clients_Store') }}" method="post">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">

                        <div class="intro-y w5 px-1  @if ($errors->get('compte')) has-error @endif">
                            <label for="compte" class="form-label mbt-2 text-size">Compte</label>

                            <input type="text" id="compte" name="compte" class="form-control py-1 @if ($errors->get('compte')) is-invalid @endif" placeholder="Entrer compte" required>

                            @if ($errors->get('compte'))
                            @foreach ($errors->get('compte') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('nom')) has-error @endif">
                            <label for="nom" class="form-label mbt-2 text-size">Nom</label>
                            <input id="nom" name="nom" type="text" class="form-control py-1 @if($errors->get('nom')) is-invalid @endif" placeholder="Entrer Nom" required>
                            @if($errors->get('nom'))
                            @foreach($errors->get('nom') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                        <div class="intro-y w5 px-1  @if ($errors->get('adresse')) has-error @endif">
                            <label for="adresse" class="form-label mbt-2 text-size">Adresse</label>
                            <input id="adresse" name="adresse" type="text" class="form-control py-1 @if($errors->get('adresse')) is-invalid @endif" placeholder="Entrer adresse" required>
                            @if($errors->get('adresse'))
                            @foreach($errors->get('adresse') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('C_postal')) has-error @endif">
                            <label for="C_postal" class="form-label mbt-2 text-size ">C postal</label>
                            <input id="C_postal" name="C_postal" type="text" class="form-control py-1 @if($errors->get('C_postal')) is-invalid @endif" placeholder="Entrer C postal" required>

                            @if($errors->get('C_postal'))
                            @foreach($errors->get('C_postal') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('contact_commercial')) has-error @endif">
                            <label for="contact_commercial" class="form-label mbt-2 text-size">Contact commercial</label>
                            <input id="contact_commercial" name="contact_commercial" class="form-control py-1 @if($errors->get('contact_commercial')) is-invalid @endif" type="text" class="form-control" placeholder="Entrer contact commercial" required>

                            @if($errors->get('contact_commercial'))
                            @foreach($errors->get('contact_commercial') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                    </div>
               <div class="form-inline mt-2">
                        <div class="intro-y w5 px-1  @if ($errors->get('telephone_commercial')) has-error @endif">
                            <label for="telephone_commercial" class="form-label mbt-2 text-size">Telephone commercial</label>
                            <input id="telephone_commercial" name="telephone_commercial" type="text" class="form-control py-1 @if($errors->get('telephone_commercial')) is-invalid @endif" placeholder="Entrer telephone commercial" required>
                            @if($errors->get('telephone_commercial'))
                            @foreach($errors->get('telephone_commercial') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('mobile_commercial')) has-error @endif">
                            <label for="mobile_commercial" class="form-label mbt-2 text-size">Mobile commercial</label>
                            <input id="mobile_commercial" name="mobile_commercial" type="text" class="form-control py-1 @if($errors->get('mobile_commercial')) is-invalid @endif" placeholder="Entrer mobile commercial" required>
                            @if($errors->get('mobile_commercial'))
                            @foreach($errors->get('mobile_commercial') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('ville_client')) has-error @endif">
                            <label for="ville_client" class="form-label mbt-2 text-size">Ville client</label>
                            <select id="ville_client" name="ville_client" data-search="true" class="form-control py-1 @if ($errors->get('ville_client')) is-invalid @endif">
                                <option value="ville_client">Sélectionner ville client</option>
                                @foreach($villes as $ville)
                                <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                @endforeach
                            </select>

                            @if($errors->get('ville'))
                            @foreach($errors->get('ville') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('tele_client')) has-error @endif">
                            <label for="tele_client" class="form-label mbt-2 text-size">Tele client</label>
                            <input id="tele_client" name="tele_client" type="text" class="form-control py-1 @if($errors->get('tele_client')) is-invalid @endif" placeholder="Entrer Tele client" required>
                            @if($errors->get('tele_client'))
                            @foreach($errors->get('tele_client') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('email_client')) has-error @endif">
                            <label for="email_client" class="form-label mbt-2 text-size">Email client</label>
                            <input id="email_client" name="email_client" type="text" class="form-control  py-1 @if($errors->get('email_client')) is-invalid @endif" placeholder="Entrer email client" required>
                            @if($errors->get('email_client'))
                            @foreach($errors->get('email_client') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
               </div>
               <div class="form-inline mt-2">
                        <div class="intro-y w5 px-1  @if ($errors->get('pays_client')) has-error @endif">
                            <label for="pays_client" class="form-label mbt-2 text-size">Pays client</label>
                            <input id="pays_client" name="pays_client" type="text" class="form-control  py-1 @if($errors->get('pays_client')) is-invalid @endif" placeholder="Entrer Pays client" required>
                            @if($errors->get('pays_client'))
                            @foreach($errors->get('pays_client') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('fax_client')) has-error @endif">
                            <label for="fax_client" class="form-label mbt-2 text-size">Fax client</label>
                            <input id="fax_client" name="fax_client" type="text" class="form-control py-1 @if($errors->get('fax_client')) is-invalid @endif" placeholder="Entrer fax client" required>
                            @if($errors->get('fax_client'))
                            @foreach($errors->get('fax_client') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if ($errors->get('marge_client')) has-error @endif">
                            <label for="marge_client" class="form-label mbt-2 text-size ">Marge client</label>
                            <input id="marge_client" name="marge_client" type="text" class="form-control py-1 @if($errors->get('marge_client')) is-invalid @endif" placeholder="Entrer marge client" required>
                            @if($errors->get('marge_client'))
                            @foreach($errors->get('marge_client') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('Remarques')) has-error @endif">
                            <label for="Remarques" class="form-label mbt-2 text-size">Remarques</label>
                            <input id="Remarques" name="Remarques" type="text" class="form-control py-1 @if($errors->get('Remarques')) is-invalid @endif" placeholder="Entrer Remarques" required>
                            @if($errors->get('Remarques'))
                            @foreach($errors->get('Remarques') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 flex items-center justify-center sm:justify-end mt-5">
                            <button type="Submit" class="btn btn-primary w-full py-1 ml-2">Envoyer</button>
                        </div>
                </div>
            </form>
            @endif
    </div>
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
                            @if (Auth::user()->permissions->contains('name','Print_Compagnies'))
                                <button id="tabulator-print-hotel-forni" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                </button>
                                @endif
                                @if (Auth::user()->permissions->contains('name','Export_Compagnies'))
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
                        <div class="overflow-x-auto scrollbar-hidden">
                        <input id="permiUpdate" type="hidden" value={{Auth::user()->permissions->contains('name','Update_Compagnies')}}>
                               <input id="permiDelete" type="hidden" value={{Auth::user()->permissions->contains('name','Delete_Compagnies')}}>
                            <div id="listeFicheClient" class="mt-5 table-report--tabulator"></div>
                        </div>
                    </div>
                </div>
                <!-- END: Data List -->
            </div>
</div>

</div>
<!-- END: gestion fiche client -->

<!-- BEGIN: LISTE fiche client -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">


    <!-- <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#static-backdrop-modal-preview" class="btn btn-primary shadow-md mr-2">Ajouter fiche client</a>
       
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500"> Affichage (Total lignes:{{$countListeFiche_client}})</div>
            <div class="w-full sm:w-auto mt-5 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">

                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn px-5 box items-center justify-center">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                <i data-lucide="search" class="block mx-auto"></i>
                            </div>
                        </span>
                    </a>

                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">Compte</th>
                        <th class="text-center whitespace-nowrap">Nom</th>
                        <th class="text-center whitespace-nowrap">C postal</th>
                        <th class="text-center whitespace-nowrap">Telephone commercial</th>
                        <th class="text-center whitespace-nowrap">Ville client</th>
                        <th class="text-center whitespace-nowrap">Tele client</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listes_Fiche_client as $key => $listesFiche_client)
                    <tr class="intro-x">
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesFiche_client->compte }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesFiche_client->nom }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesFiche_client->C_postal }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesFiche_client->telephone_commercial }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesFiche_client->ville_client }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesFiche_client->tele_client }}</div>
                        </td>

                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <button onclick="showDialogueModifierfiche_client('id={{ $listesFiche_client->id }}')" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="flex items-center mr-3">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </button>

                                <button onclick="showDialogueDeletefiche_client('{{ $listesFiche_client->id }}')" value="{{ $listesFiche_client->id }}" class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </button>


                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($countListeFiche_client == 0)
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-center">
                        <p class="text-danger">Aucune données disponible</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
    </div> -->

    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                        </div>
                        <form id="delete_fiche_client" name="delete_fiche_client" action="{{ route('fiche_client.delete') }}" method="post">

                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>


                                <input type="hidden" id="__id" name="__id">

                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger w-24">Delete</button>

                        </form>

                    </div>
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
                    <h2 class="font-medium text-base mr-auto">Modifier fiche client</h2>

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
                <form id="update_fiche_client" name="update_fiche_client" action="{{ route('fiche_client.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="compte" class="form-label">Compte</label>
                            <input id="_compte" name="_compte" value="{{old('compte')}}" type="text" class="form-control" placeholder="compte">
                        </div>

                        <input type="hidden" id="_id_" name="_id_">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="nom" class="form-label">Nom</label>
                            <input id="_nom" name="_nom" value="{{old('nom')}}" type="text" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input id="_adresse" name="_adresse" value="{{old('adresse')}}" type="text" class="form-control" placeholder="adresse">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="C_postal" class="form-label">C postal</label>
                            <input id="_C_postal" name="_C_postal" value="{{old('C_postal')}}" type="text" class="form-control" placeholder="C postal">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="contact_commercial" class="form-label">Contact commercial</label>
                            <input id="_contact_commercial" name="_contact_commercial" type="text" value="{{old('contact_commercial')}}" class="form-control" placeholder="Contact commercial">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="telephone_commercial" class="form-label">Telephone commercial</label>
                            <input id="_telephone_commercial" name="_telephone_commercial" type="text" value="{{old('telephone_commercial')}}" value="{{old('telephone_commercial')}}" class="form-control" placeholder="Telephone commercial">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="mobile_commercial" class="form-label">Mobile commercial</label>
                            <input id="_mobile_commercial" name="_mobile_commercial" type="text" value="{{old('mobile_commercial')}}" class="form-control" placeholder="Mobile commercial">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="ville_client" class="form-label">Ville client</label>
                            <input id="_ville_client" value="{{old('ville_client')}}" name="_ville_client" type="text" class="form-control" placeholder="Ville client">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="tele_client" class="form-label">Tele client</label>
                            <input id="_tele_client" value="{{old('tele_client')}}" name="_tele_client" type="text" class="form-control" placeholder="Compte comptable mouloud">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email_client" class="form-label">Email client</label>
                            <input id="_email_client" name="_email_client" type="text" value="{{old('email_client')}}" class="form-control" placeholder="Email client">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="pays_client" class="form-label">Pays client</label>
                            <input id="_pays_client" name="_pays_client" value="{{old('pays_client')}}" type="text" class="form-control" placeholder="Pays client">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="fax_client" class="form-label">Fax client</label>
                            <input id="_fax_client" name="_fax_client" value="{{old('fax_client')}}" type="text" class="form-control" placeholder="Fax client">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="marge_client" class="form-label">Marge client</label>
                            <input id="_marge_client" name="_marge_client" value="{{old('marge_client')}}" type="text" class="form-control" placeholder="Marge client">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="Remarques" class="form-label">Remarques</label>
                            <input id="_Remarques" name="_Remarques" type="text" value="{{old('Remarques')}}" class="form-control" placeholder="Remarques">
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

<!-- BEGIN: Model Ajouter fiche client -->
<div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">

    <div id="static-backdrop-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">

                    <!-- BEGIN: Modal Header -->
                    <div class="modal-header">
                        <h2 class="font-medium text-base mr-auto">Ajouter fiche client</h2>
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
                                    <label for="_compte_" class="form-label">Compte</label>

                                    <input type="text" id="_compte_" name="compte" class="form-control @if ($errors->get('_compte_')) is-invalid @endif" placeholder="Entrer compte">

                                    @if ($errors->get('_compte_'))
                                    @foreach ($errors->get('_compte_') as $message)
                                    <li class="text-danger">{{ $message }}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_nom_" class="form-label">Nom</label>
                                    <input id="_nom_" name="nom" type="text" class="form-control @if($errors->get('_nom_')) is-invalid @endif" placeholder="Nom">
                                    @if($errors->get('_nom_'))
                                    @foreach($errors->get('_nom_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_adresse_" class="form-label">Adresse</label>
                                    <input id="_adresse_" name="adresse" type="text" class="form-control @if($errors->get('_adresse_')) is-invalid @endif" placeholder="Adresse">
                                    @if($errors->get('_adresse_'))
                                    @foreach($errors->get('_adresse_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_C_postal_" class="form-label">C postal</label>
                                    <input id="_C_postal_" name="C_postal" type="text" class="form-control @if($errors->get('_C_postal_')) is-invalid @endif" placeholder="C postal">

                                    @if($errors->get('_C_postal_'))
                                    @foreach($errors->get('_C_postal_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_contact_commercial_" class="form-label">Contact commercial</label>
                                    <input id="_contact_commercial_" name="contact_commercial" class="form-control @if($errors->get('_contact_commercial_')) is-invalid @endif" type="text" class="form-control" placeholder="Contact commercial">

                                    @if($errors->get('_contact_commercial_'))
                                    @foreach($errors->get('_contact_commercial_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_telephone_commercial_" class="form-label">Telephone commercial</label>
                                    <input id="_telephone_commercial_" name="telephone_commercial" type="text" class="form-control @if($errors->get('_telephone_commercial_')) is-invalid @endif" placeholder="Telephone commercial">
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
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                    <button type="Submit" data-tw-dismiss="modal" class="btn btn-primary w-24">Envoyer</button>

                                </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</div>

<!-- END: Model Ajouter fiche client -->

<!-- BEGIN: Modal Recherche fiche client -->
<div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher fiche client</h2>

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
            <form id="rech_fiche_client" name="rech_fiche_client" action="{{  route('fiche_client.rech')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="compte__" class="form-label">Compte</label>
                        <input id="compte__" name="compte__" type="text" class="form-control" placeholder="Compte">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="nom__" class="form-label">Nom</label>
                        <input id="nom__" name="nom__" type="text" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="adresse__" class="form-label">Adresse</label>
                        <input id="adresse__" name="adresse__" type="text" class="form-control" placeholder="Adresse">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="C_postal__" class="form-label">C postal</label>
                        <input id="C_postal__" name="C_postal__" type="text" class="form-control" placeholder="C postal">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="contact_commercial__" class="form-label">Contact commercial</label>
                        <input id="contact_commercial__" name="contact_commercial__" type="text" class="form-control" placeholder="contact_commercial">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="telephone_commercial__" class="form-label">Telephone commercial</label>
                        <input id="telephone_commercial__" name="telephone_commercial__" type="text" class="form-control" placeholder="Telephone commercial">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="mobile_commercial__" class="form-label">Mobile commercial</label>
                        <input id="mobile_commercial__" name="mobile_commercial__" type="text" class="form-control" placeholder="Mobile commercial">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="ville_client__" class="form-label">Ville client</label>
                        <input id="ville_client__" name="ville_client__" type="text" class="form-control" placeholder="Ville client">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="tele_client__" class="form-label">Tele client</label>
                        <input id="tele_client__" name="tele_client__" type="text" class="form-control" placeholder="Tele client">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="email_client__" class="form-label">Email client</label>
                        <input id="email_client__" name="email_client__" type="text" class="form-control" placeholder="Email client">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="email_client__" class="form-label">Email client</label>
                        <input id="email_client__" name="email_client__" type="text" class="form-control" placeholder="Email client">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="pays_client" class="form-label">Pays client</label>
                        <input id="pays_client__" name="pays_client__" type="text" class="form-control" placeholder="Pays client">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="marge_client__" class="form-label">Marge client</label>
                        <input id="marge_client__" name="marge_client__" type="text" class="form-control" placeholder="Marge client">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="Remarques" class="form-label">Remarques</label>
                        <input id="Remarques" name="Remarques" type="text" class="form-control" placeholder="Remarques">
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

<script>
    function showDialogueDeletefiche_client(id) {
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

    function showDialogueModifierfiche_client(url) {

        console.log(url);

        // document.getElementById("id_").value = id;

        ajaxPost(url, (obj) => {

            // --------------------------- fill
            const nv = obj.Hotel_transports;
            document.getElementById("_id_").value = nv.id;
            document.getElementById("_compte").value = nv.compte;
            document.getElementById("_nom").value = nv.nom;
            document.getElementById("_adresse").value = nv.adresse;
            document.getElementById("_C_postal").value = nv.C_postal;
            document.getElementById("_contact_commercial").value = nv.contact_commercial;
            document.getElementById("_telephone_commercial").value = nv.telephone_commercial;
            document.getElementById("_mobile_commercial").value = nv.mobile_commercial;
            document.getElementById("_ville_client").value = nv.ville_client;
            document.getElementById("_tele_client").value = nv.tele_client;
            document.getElementById("_email_client").value = nv.email_client;
            document.getElementById("_pays_client").value = nv.pays_client;
            document.getElementById("_fax_client").value = nv.fax_client;
            document.getElementById("_marge_client").value = nv.marge_client;
            document.getElementById("_Remarques").value = nv.Remarques;
            // console.log(document.getElementById("url_update").value);
        });
    }
</script>
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_Fiche_client.js')}}"></script>
@endsection