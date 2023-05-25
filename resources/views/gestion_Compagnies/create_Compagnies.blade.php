@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion compagnies</title>
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">
@endsection

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

<!-- BEGIN: gestion fiche client -->
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="py-5 px-5  mt-5">
                <div class="font-medium text-center text-lg">Ajouter Compagnie</div>
            </div>
            @if (Auth::user()->permissions->contains('name','Ajouter_Compagnie'))
            <form id="Add_compagnie" action="{{ url('Compagnies_Store') }}" method="post">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">

                        <div class="intro-y w5 px-1  @if ($errors->get('code_cie')) has-error @endif">
                            <label for="code_cie" class="form-label mbt-2 text-size">Code cie</label>

                            <input type="text" id="code_cie" name="code_cie" class="form-control py-1 @if ($errors->get('code_cie')) is-invalid @endif" placeholder="Entrer code cie">

                            @if ($errors->get('code_cie'))
                            @foreach ($errors->get('code_cie') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1  @if ($errors->get('compagnie')) has-error @endif">
                            <label for="compagnie" class="form-label mbt-2 text-size">Compagnie</label>
                            <input id="compagnie" name="compagnie" type="text" class="form-control py-1 @if($errors->get('compagnie')) is-invalid @endif" placeholder="Entrer compagnie">
                            @if($errors->get('compagnie'))
                            @foreach($errors->get('compagnie') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                        <div class="intro-y w5 px-1 @if($errors->get('telephone')) has-error @endif">
                            <label for="telephone" class="form-label mbt-2 text-size">Telephone</label>
                            <input id="telephone" name="telephone" type="text" class="form-control py-1 @if($errors->get('telephone')) is-invalid @endif" placeholder="Entrer telephone">
                            @if($errors->get('telephone'))
                            @foreach($errors->get('telephone') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if($errors->get('fax')) has-error @endif">
                            <label for="fax" class="form-label mbt-2 text-size">Fax</label>
                            <input id="fax" name="fax" type="text" class="form-control py-1 @if($errors->get('fax')) is-invalid @endif" placeholder="Entrer fax">

                            @if($errors->get('fax'))
                            @foreach($errors->get('fax') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if($errors->get('adresse')) has-error @endif">
                            <label for="adresse" class="form-label mbt-2 text-size">Adresse</label>
                            <input id="adresse" name="adresse" class="form-control py-1 @if($errors->get('adresse')) is-invalid @endif" type="text" class="form-control" placeholder="Entrer Adresse">

                            @if($errors->get('adresse'))
                            @foreach($errors->get('adresse') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                       
                  </div>
                  <div class="form-inline mt-2">
                     <div class="intro-y w5 px-1 @if($errors->get('directeur')) has-error @endif">
                            <label for="directeur" class="form-label mbt-2 text-size">Directeur</label>
                            <input id="directeur" name="directeur" type="text" class="form-control py-1 @if($errors->get('directeur')) is-invalid @endif" placeholder="Entrer directeur">
                            @if($errors->get('directeur'))
                            @foreach($errors->get('directeur') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                    </div>
                    <div class="intro-y w5 px-1 @if($errors->get('tel_directeur')) has-error @endif">
                            <label for="tel_directeur" class="form-label mbt-2 text-size">Tel directeur</label>
                            <input id="tel_directeur" name="tel_directeur" type="text" class="form-control py-1 @if($errors->get('tel_directeur')) is-invalid @endif" placeholder="Entrer tel directeur">
                            @if($errors->get('tel_directeur'))
                            @foreach($errors->get('tel_directeur') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                     </div>

                        <div class="intro-y w5 px-1 @if($errors->get('nom_en_arabe')) has-error @endif">
                            <label for="nom_en_arabe" class="form-label mbt-2 text-size">Nom en arabe</label>
                            <input id="nom_en_arabe" name="nom_en_arabe" type="text" class="form-control py-1 @if($errors->get('nom_en_arabe')) is-invalid @endif" placeholder="Entrer nom en arabe">
                            @if($errors->get('nom_en_arabe'))
                            @foreach($errors->get('nom_en_arabe') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if($errors->get('compte_comptable_BSP')) has-error @endif">
                            <label for="compte_comptable_BSP" class="form-label mbt-2 text-size">Compte comptable BSP</label>
                            <input id="compte_comptable_BSP" name="compte_comptable_BSP" type="text" class="form-control py-1 @if($errors->get('compte_comptable_BSP')) is-invalid @endif" placeholder="Entrer Tele client">
                            @if($errors->get('compte_comptable_BSP'))
                            @foreach($errors->get('compte_comptable_BSP') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w5 px-1 @if($errors->get('compte_comptable_normal')) has-error @endif">
                            <label for="compte_comptable_normal" class="form-label mbt-2 text-size">Compte comptable normal</label>
                            <input id="compte_comptable_normal" name="compte_comptable_normal" type="text" class="form-control py-1 @if($errors->get('compte_comptable_normal')) is-invalid @endif" placeholder="Entrer Compte comptable normal">
                            @if($errors->get('compte_comptable_normal'))
                            @foreach($errors->get('compte_comptable_normal') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                  </div>
                        <div class="form-inline justify-content-end">
                            {{-- <a class="btn btn-secondary w-24" >Liste</a> --}}
                            <button type="Submit" class="btn btn-primary mt-6 py-1 mr-1">Envoyer</button>
                        </div>
                
            </form>
            @endif
            </div>
             <!-- debut de liste hotel fourni -->
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
                            <input type="text" id="code_com" name="code_com" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 mr-2" required="" placeholder="Entrer le code">
                       </div>   
                       <button id="search-btn" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" data-lucide="search" class="lucide lucide-search block mx-auto"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>
                        </span>
                    </button>
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
                        <div class="overflow-x-auto scrollbar-hidden ">
                        <input id="permiUpdate" type="hidden" value={{Auth::user()->permissions->contains('name','Update_Compagnies')}}>
                               <input id="permiDelete" type="hidden" value={{Auth::user()->permissions->contains('name','Delete_Compagnies')}}>
                            <div id="liste_compagnie" class="mt-5 table-report--tabulator"></div>
                        </div>
                    </div>
                </div>
                <!-- END: Data List -->
            </div>
            <!-- Fin de liste date depart hotel fourni -->
    
</div>
</div>
<!-- END: gestion fiche client -->

<!-- BEGIN: LISTE fiche client -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">
    <!-- <h2 class="intro-y text-lg font-medium mt-10">Liste compagnies</h2> -->

  
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Êtes-vous sûr?</div>
                            <div class="text-slate-500 mt-2">
                                Voulez-vous vraiment supprimer ces enregistrements ? <br>Ce processus ne peut pas être annulé.</div>
                        </div>
                        <form id="delete_compagnie" action="{{ route('Compagnies.delete') }}" method="post">

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
                    <h2 class="font-medium text-base mr-auto">Modifier Compagnies </h2>

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

                
                <form id="update_compagnie" action="{{ route('Compagnies.update') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_code_cie" class="form-label">Code cie</label>
                            <input id="_code_cie" name="_code_cie" value="{{old('code_cie')}}" type="text" class="form-control" placeholder="Code cie">
                        </div>

                        <input type="hidden" id="_id_" name="_id_">

                        <div class="col-span-12 sm:col-span-6">
                            <label for="_compagnie" class="form-label">Compagnie</label>
                            <input id="_compagnie" name="_compagnie" value="{{old('compagnie')}}" type="text" class="form-control" placeholder="Compagnie">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_telephone" class="form-label">Telephone</label>
                            <input id="_telephone" name="_telephone" value="{{old('telephone')}}" type="text" class="form-control" placeholder="Telephone">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_fax" class="form-label">Fax</label>
                            <input id="_fax" name="_fax" value="{{old('fax')}}" type="text" class="form-control" placeholder="Fax">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_adresse" class="form-label">Adresse</label>
                            <input id="_adresse" name="_adresse" type="text" value="{{old('adresse')}}" class="form-control" placeholder="Adresse">
                        </div>

                        <div class="col-span-12 sm:col-span-6">
                            <label for="_directeur" class="form-label">Directeur</label>
                            <input id="_directeur" name="_directeur" type="text" value="{{old('directeur')}}" value="{{old('directeur')}}" class="form-control" placeholder="Directeur">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_tel_directeur" class="form-label">Tel directeur</label>
                            <input id="_tel_directeur" name="_tel_directeur" type="text" value="{{old('tel_directeur')}}" class="form-control" placeholder="Tel directeur">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_nom_en_arabe" class="form-label">Nom en arabe</label>
                            <input id="_nom_en_arabe" value="{{old('nom_en_arabe')}}" name="_nom_en_arabe" type="text" class="form-control" placeholder="Nom en arabe">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_compte_comptable_BSP" class="form-label">Compte comptable BSP</label>
                            <input id="_compte_comptable_BSP" value="{{old('compte_comptable_BSP')}}" name="_compte_comptable_BSP" type="text" class="form-control" placeholder="Compte comptable BSP">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="_compte_comptable_normal" class="form-label">Compte comptable normal</label>
                            <input id="_compte_comptable_normal" name="_compte_comptable_normal" type="text" value="{{old('compte_comptable_normal')}}" class="form-control" placeholder="Compte comptable normal">
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
                        <h2 class="font-medium text-base mr-auto">Ajouter compagnies</h2>
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

                    <form action="{{ url('Compagnies_Store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_code_cie_" class="form-label">Code cie</label>

                                    <input type="text" id="_code_cie_" name="code_cie" class="form-control @if ($errors->get('_code_cie_')) is-invalid @endif" placeholder="Entrer Code Cie">

                                    @if ($errors->get('_code_cie_'))
                                    @foreach ($errors->get('_code_cie_') as $message)
                                    <li class="text-danger">{{ $message }}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_compagnie_" class="form-label">Compagnie</label>
                                    <input id="_compagnie_" name="compagnie" type="text" class="form-control @if($errors->get('_compagnie_')) is-invalid @endif" placeholder="compagnie">
                                    @if($errors->get('_compagnie_'))
                                    @foreach($errors->get('_compagnie_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_telephone_" class="form-label">Telephone</label>
                                    <input id="_telephone_" name="telephone" type="text" class="form-control @if($errors->get('_telephone_')) is-invalid @endif" placeholder="telephone">
                                    @if($errors->get('_telephone_'))
                                    @foreach($errors->get('_telephone_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_fax_" class="form-label">Fax</label>
                                    <input id="_fax_" name="fax" type="text" class="form-control @if($errors->get('_fax_')) is-invalid @endif" placeholder="C postal">

                                    @if($errors->get('_fax_'))
                                    @foreach($errors->get('_fax_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_adresse_" class="form-label">Adresse</label>
                                    <input id="_adresse_" name="adresse" class="form-control @if($errors->get('_adresse_')) is-invalid @endif" type="text" class="form-control" placeholder="Contact commercial">

                                    @if($errors->get('_adresse_'))
                                    @foreach($errors->get('_adresse_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_directeur_" class="form-label">Directeur</label>
                                    <input id="_directeur_" name="directeur" type="text" class="form-control @if($errors->get('_directeur_')) is-invalid @endif" placeholder="Telephone commercial">
                                    @if($errors->get('_directeur_'))
                                    @foreach($errors->get('_directeur_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_tel_directeur_" class="form-label">Tel directeur</label>
                                    <input id="_tel_directeur_" name="tel_directeur" type="text" class="form-control @if($errors->get('_tel_directeur_')) is-invalid @endif" placeholder="Mobile commercial">
                                    @if($errors->get('_tel_directeur_'))
                                    @foreach($errors->get('_tel_directeur_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_nom_en_arabe_" class="form-label">Nom en arabe</label>
                                    <input id="_nom_en_arabe_" name="nom_en_arabe" type="text" class="form-control @if($errors->get('_nom_en_arabe_')) is-invalid @endif" placeholder="Ville client">
                                    @if($errors->get('_nom_en_arabe_'))
                                    @foreach($errors->get('_nom_en_arabe_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="_compte_comptable_BSP_" class="form-label">Compte comptable BSP</label>
                                    <input id="_compte_comptable_BSP_" name="compte_comptable_BSP" type="text" class="form-control @if($errors->get('_compte_comptable_BSP_')) is-invalid @endif" placeholder="Tele client">
                                    @if($errors->get('_compte_comptable_BSP_'))
                                    @foreach($errors->get('_compte_comptable_BSP_') as $message)
                                    <li class="text-danger">{{$message}}</li>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="compte_comptable_normal" class="form-label">Compte comptable normal</label>
                                    <input id="compte_comptable_normal" name="compte_comptable_normal" type="text" class="form-control @if($errors->get('compte_comptable_normal')) is-invalid @endif" placeholder="Email client">
                                    @if($errors->get('compte_comptable_normal'))
                                    @foreach($errors->get('compte_comptable_normal') as $message)
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


</div>
<!-- END: gestion fiche client -->


</div>


@endsection
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_compagnie.js')}}"></script>


<script>
    function showDialogueDeleteCompagnies(id) {
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
        //        .catch(error => { alert('Error:', error.code_cie); document.getElementById("dialogue-wait").style.display = "none"; });
    }

    function showDialogueModifierCompagnies(url) {

        console.log(url);

        // document.getElementById("id_").value = id;

        ajaxPost(url, (obj) => {

            // --------------------------- fill
            const nv = obj.compagnies;
            document.getElementById("_id_").value = nv.id;
            document.getElementById("_code_cie").value = nv.code_cie;
            document.getElementById("_compagnie").value = nv.compagnie;
            document.getElementById("_telephone").value = nv.telephone;
            document.getElementById("_fax").value = nv.fax;
            document.getElementById("_adresse").value = nv.adresse;
            document.getElementById("_directeur").value = nv.directeur;
            document.getElementById("_tel_directeur").value = nv.tel_directeur;
            document.getElementById("_nom_en_arabe").value = nv.nom_en_arabe;
            document.getElementById("_compte_comptable_BSP").value = nv.compte_comptable_BSP;
            document.getElementById("_compte_comptable_normal").value = nv.compte_comptable_normal;
            // console.log(document.getElementById("url_update").value);
        });
    }
</script>
@endsection