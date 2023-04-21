@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion hotel / fournisseur</title>
@endsection
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">

@section('subcontent')
<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Gestion hotel/ fournisseur</h2>
</div>

<!-- BEGIN: gestion hotel transports -->
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-5 px-5  mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="px-5 mt-10 mb-6">
                <div class="font-medium text-center text-lg">Gestion hotel / fournisseur</div>
            </div>
            @if (Auth::user()->permissions->contains('name','Ajouter_Hotel_Transports'))
            <form id="Add_Hotel_Fourni" name="Add_Hotel_Fourni" action="{{ url('hotel_transportsStore') }}" method="post">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline ">
                        <div class="input-form w5 px-1 @if ($errors->get('code')) has-error @endif">
                            <label for="code" class="form-label text-size w-full flex flex-col sm:flex-row mbt-2">Code</label>

                            <input type="text" id="code" value="{{old('code')}}" name="code" class="form-control py-1 @if ($errors->get('code')) is-invalid @endif" required placeholder="Entrer Code">
              
                            @if ($errors->get('code'))
                            @foreach ($errors->get('code') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('nom')) has-error @endif">
                            <label for="nom" class="form-label text-size mbt-2">Nom</label>
                            <input id="nom" name="nom" type="text" value="{{old('nom')}}" class="form-control py-1 @if($errors->get('nom')) is-invalid @endif" required placeholder="Nom">
                            @if($errors->get('nom'))
                            @foreach($errors->get('nom') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('ville')) has-error @endif">
                            <label for="ville" class="form-label text-size mbt-2">Ville</label>

                            <select id="Ville" name="ville" data-search="true" class="form-control py-1">
                            </select>

                            @if($errors->get('ville'))
                            @foreach($errors->get('ville') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('distance_harame')) has-error @endif">
                            <label for="distance_harame" class="form-label text-size mbt-2">Distance Harame</label>

                            <input id="distance_harame" required name="distance_harame" value="{{old('distance_harame')}}" type="text" class="form-control py-1 @if($errors->get('distance_harame')) is-invalid @endif" placeholder="Distance Harame">
                            @if($errors->get('distance_harame'))
                            @foreach($errors->get('distance_harame') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>


                        <div class="input-form w5 px-1 @if ($errors->get('emplacement')) has-error @endif">
                            <label for="emplacement" class="form-label text-size mbt-2">Emplacement</label>
                            <input id="emplacement" required name="emplacement" value="{{old('emplacement')}}" type="text" class="form-control py-1 @if($errors->get('emplacement')) is-invalid @endif" placeholder="Emplacement">

                            @if($errors->get('emplacement'))
                            @foreach($errors->get('emplacement') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-inline mt-2">

                        <div class="input-form w5 px-1 @if ($errors->get('telephone')) has-error @endif">
                            <label for="telephone" class="form-label text-size mbt-2">Telephone</label>
                            <input id="telephone" required name="telephone" value="{{old('telephone')}}" class="form-control py-1 @if($errors->get('telephone')) is-invalid @endif" type="text" class="form-control" placeholder="Telephone">

                        @if($errors->get('telephone'))
                        @foreach($errors->get('telephone') as $message)
                        <li class="text-danger">{{$message}}</li>
                       @endforeach
                      @endif
                   </div>

                        <div class="input-form w5 px-1 @if ($errors->get('fax')) has-error @endif">
                            <label for="fax" class="form-label text-size mbt-2">Fax</label>
                            <input id="fax" name="fax" required type="text" value="{{old('fax')}}" class="form-control py-1 @if($errors->get('fax')) is-invalid @endif" placeholder="Fax">
                            @if($errors->get('fax'))
                            @foreach($errors->get('fax') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('site')) has-error @endif">
                            <label for="site" class="form-label text-size mbt-2">Site</label>
                            <input id="site" name="site" required type="text" value="{{old('site')}}" class="form-control py-1  @if($errors->get('site')) is-invalid @endif" placeholder="Site">
                            @if($errors->get('site'))
                            @foreach($errors->get('site') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('compte_comptable_ramadan')) has-error @endif">
                            <label for="compte_comptable_ramadan" class="form-label text-size mbt-2">Compte comptable ramadan</label>
                            <input id="compte_comptable_ramadan" required value="{{old('compte_comptable_ramadan')}}" name="compte_comptable_ramadan" type="text" class="form-control py-1 @if($errors->get('compte_comptable_ramadan')) is-invalid @endif" placeholder="Compte comptable ramadan">
                            @if($errors->get('compte_comptable_ramadan'))
                            @foreach($errors->get('compte_comptable_ramadan') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('compte_comptable_mouloud')) has-error @endif">
                            <label for="compte_comptable_mouloud" class="form-label text-size mbt-2">Compte comptable mouloud</label>
                            <input id="compte_comptable_mouloud" required value="{{old('compte_comptable_mouloud')}}" name="compte_comptable_mouloud" type="text" class="form-control py-1 @if($errors->get('compte_comptable_mouloud')) is-invalid @endif" placeholder="Compte comptable mouloud">
                            @if($errors->get('compte_comptable_mouloud'))
                            @foreach($errors->get('compte_comptable_mouloud') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                        <div class="input-form w5 px-1 @if ($errors->get('contact')) has-error @endif">
                            <label for="contact" class="form-label text-size mbt-2">Contact</label>
                            <input id="contact" name="contact" required type="text" value="{{old('contact')}}" class="form-control py-1 @if($errors->get('contact')) is-invalid @endif" placeholder="Contact">
                            @if($errors->get('contact'))
                            @foreach($errors->get('contact') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('categorie')) has-error @endif">
                            <label for="categorie" class="form-label text-size mbt-2">Categorie</label>
                            <input id="categorie" name="categorie" required type="text" value="{{old('categorie')}}" class="form-control py-1 @if($errors->get('categorie')) is-invalid @endif" placeholder="Contact">
                            @if($errors->get('categorie'))
                            @foreach($errors->get('categorie') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('email')) has-error @endif">
                            <label for="email" class="form-label text-size mbt-2">Email</label>
                            <input id="email" name="email" type="text" required value="{{old('email')}}" class="form-control py-1 @if($errors->get('email')) is-invalid @endif" placeholder="Email">
                            @if($errors->get('email'))
                            @foreach($errors->get('email') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('nom_en_arabe')) has-error @endif">
                            <label for="nom_en_arabe" class="form-label text-size mbt-2">Nom en arabe</label>
                            <input id="nom_en_arabe" name="nom_en_arabe" required value="{{old('nom_en_arabe')}}" type="text" class="form-control py-1 @if($errors->get('nom_en_arabe')) is-invalid @endif" placeholder="Nom en arabe">
                            @if($errors->get('nom_en_arabe'))
                            @foreach($errors->get('nom_en_arabe') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="input-form w5 px-1 @if ($errors->get('type')) has-error @endif">
                            <label for="type" class="form-label text-size mbt-2">Type</label>
                            <select name="type" id="type" class="form-control py-1 ">
                                <!-- <option value="">Transport</option>
                                <option value="">Guide</option>
                                <option value="">Restaurant </option>
                                <option value="">Autre</option> -->
                            </select>
                            @if($errors->get('type'))
                            @foreach($errors->get('type') as $message)
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
                            <div class="input-form w-1/2 sm:w-auto mr-2 px-1 ">
                           

                           <input type="text" id="code_Ghotel"  name="code_Ghotel" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0 mr-2" required="" placeholder="Entrer le Code">
             
                     </div>
                   <button id="search-btn" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview" class="btn btn-outline-danger w-1/2 sm:w-auto mr-2">
                       <span class="w-5 h-5 flex items-center justify-center">
                           <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" data-lucide="search" class="lucide lucide-search block mx-auto"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                           </div>
                       </span>
                   </button>
                            <div class="flex mt-2 sm:mt-0">
                            @if (Auth::user()->permissions->contains('name','Print_Hotel_Transport'))
                                <button id="tabulator-print-hotel-forni" class="btn btn-outline-primary  w-1/2 sm:w-auto mr-2">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                </button>
                                @endif
                                @if (Auth::user()->permissions->contains('name','Export_Hotel_Transport'))
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
                        <div class="overflow-x-auto scrollbar-hidden">
                        <input id="permiUpdate" type="hidden" value={{Auth::user()->permissions->contains('name','Update_Hotel_Transport')}}>
                               <input id="permiDelete" type="hidden" value={{Auth::user()->permissions->contains('name','Delete_Hotel_Transport')}}>
                            <div id="liste_Hotel_fourni" class="mt-2 table-report--tabulator"></div>
                        </div>
                    </div>
                </div>
                <!-- END: Data List -->
            </div>
            <!-- Fin de liste date depart hotel fourni -->
        </div>
    </div>

</div>
</div>
<!-- END: gestion hotels transports -->

<!-- BEGIN: LISTE hotels transports -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">




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
                    <form id="delet_hotel_fourni" name="delet_hotel_fourni" action="{{ route('hotel_transports.delete') }}" method="post">

                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Annuler</button>
                            <input type="hidden" id="id_delete_hotel" name="id_delete_hotel">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger w-24">Supprimer</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- END: Delete  Confirmation Modal -->

<!-- BEGIN: Modal update Hotel Transports-->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Modifier Hotel / fournisseur</h2>

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


            <form id="update_houtel_fourni" name="update_houtel_fourni" action="{{ route('hotel_transports.update') }}" method="post">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-2 sm:col-span-2">
                        <label for="up_code" class="form-label">Code</label>
                        <input id="up_code" name="up_code" value="{{old('up_code')}}" type="text" class="form-control" placeholder="Code">
                    </div>

                    <input type="hidden" id="update_id" name="update_id">

                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_nom" class="form-label">Nom</label>
                        <input id="up_nom" name="up_nom" value="{{old('up_nom')}}" type="text" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_ville" class="form-label">Ville</label>
                        <select id="up_ville" name="up_ville" data-search="true" class="form-control py-1">

                        </select>
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_emplacement" class="form-label">Emplacement</label>
                        <input id="up_emplacement" name="up_emplacement" value="{{old('up_emplacement')}}" type="text" class="form-control" placeholder="Emplacement">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_telephone" class="form-label">Telephone</label>
                        <input id="up_telephone" name="up_telephone" type="text" value="{{old('up_telephone')}}" class="form-control" placeholder="Telephone">
                    </div>

                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_fax" class="form-label">Fax</label>
                        <input id="up_fax" name="up_fax" type="text" value="{{old('up_fax')}}" class="form-control" placeholder="Fax">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_site" class="form-label">Site</label>
                        <input id="up_site" name="up_site" type="text" value="{{old('up_site')}}" class="form-control" placeholder="Site">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_compte_comptable_ramadan" class="form-label">Compte comptable ramadan</label>
                        <input id="up_compte_comptable_ramadan" value="{{old('up_compte_comptable_ramadan')}}" name="_compte_comptable_ramadan_" type="text" class="form-control" placeholder="Compte comptable ramadan">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_compte_comptable_mouloud" class="form-label">Compte comptable mouloud</label>
                        <input id="up_compte_comptable_mouloud" value="{{old('up_compte_comptable_mouloud')}}" name="up_compte_comptable_mouloud" type="text" class="form-control" placeholder="Compte comptable mouloud">
                    </div>
                     
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_email" class="form-label">Email</label>
                        <input id="up_email" name="up_email" value="{{old('up_email')}}" type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_categorie" class="form-label">Categorie</label>
                        <input id="up_categorie" name="up_categorie" value="{{old('up_categorie')}}" type="text" class="form-control" placeholder="Categorie">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_nom_en_arabe" class="form-label">Nom en arabe</label>
                        <input id="up_nom_en_arabe" name="up_nom_en_arabe" value="{{old('up_nom_en_arabe')}}" type="text" class="form-control" placeholder="Nom en arabe">
                    </div>
                    <div class="col-span-3 sm:col-span-3">
                        <label for="up_type" class="form-label">Type</label>
                        <select id="up_type" name="up_type" data-search="true" class="form-control py-1">

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
<!-- END: Modal modifier Hotel Transports -->

<!-- BEGIN: Model Ajouter Hotel Transports -->
<div id="static-backdrop-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body px-5 py-10">

                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Ajouter Hotel Transport</h2>
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

                <form action="{{ url('hotel_transportsStore') }}" method="post">
                    {{ csrf_field() }}
                    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="code" class="form-label">Code</label>

                                <input type="text" id="code_" name="code" class="form-control @if ($errors->get('code')) is-invalid @endif" placeholder="Entrer Code">

                                @if ($errors->get('code'))
                                @foreach ($errors->get('code') as $message)
                                <li class="text-danger">{{ $message }}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input id="nom_" name="nom" type="text" class="form-control  @if($errors->get('nom')) is-invalid @endif" placeholder="Nom">
                                @if($errors->get('nom'))
                                @foreach($errors->get('nom') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="ville" class="form-label">Ville</label>
                                <input id="ville_" name="ville" type="text" class="form-control px-1 @if($errors->get('ville')) is-invalid @endif" placeholder="Ville">
                                @if($errors->get('ville'))
                                @foreach($errors->get('ville') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="emplacement" class="form-label">Emplacement</label>
                                <input id="emplacement_" name="emplacement" type="text" class="form-control px-1 @if($errors->get('emplacement')) is-invalid @endif" placeholder="Emplacement">

                                @if($errors->get('emplacement'))
                                @foreach($errors->get('emplacement') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="telephone" class="form-label">Telephone</label>
                                <input id="telephone_" name="telephone" class="form-control px-1 @if($errors->get('telephone')) is-invalid @endif" type="text" class="form-control" placeholder="Telephone">

                                @if($errors->get('telephone'))
                                @foreach($errors->get('telephone') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="fax" class="form-label">Fax</label>
                                <input id="fax_" name="fax" type="text" class="form-control px-1 @if($errors->get('fax')) is-invalid @endif" placeholder="Fax">
                                @if($errors->get('fax'))
                                @foreach($errors->get('fax') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="site" class="form-label">Site</label>
                                <input id="site_" name="site" type="text" class="form-control px-1 @if($errors->get('site')) is-invalid @endif" placeholder="Site">
                                @if($errors->get('site'))
                                @foreach($errors->get('site') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="compte_comptable_ramadan" class="form-label">Compte comptable ramadan</label>
                                <input id="compte_comptable_ramadan_" name="compte_comptable_ramadan" type="text" class="form-control px-1 @if($errors->get('compte_comptable_ramadan')) is-invalid @endif" placeholder="Compte comptable ramadan">
                                @if($errors->get('compte_comptable_ramadan'))
                                @foreach($errors->get('compte_comptable_ramadan') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="compte_comptable_mouloud" class="form-label">Compte comptable mouloud</label>
                                <input id="compte_comptable_mouloud_" name="compte_comptable_mouloud" type="text" class="form-control px-1 @if($errors->get('compte_comptable_mouloud')) is-invalid @endif" placeholder="Compte comptable mouloud">
                                @if($errors->get('compte_comptable_mouloud'))
                                @foreach($errors->get('compte_comptable_mouloud') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="contact" class="form-label">Contact</label>
                                <input id="contact_" name="contact" type="text" class="form-control px-1 @if($errors->get('contact')) is-invalid @endif" placeholder="Contact">
                                @if($errors->get('contact'))
                                @foreach($errors->get('contact') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="categorie" class="form-label">Categorie</label>
                                <input id="categorie_" name="categorie" type="text" class="form-control px-1 @if($errors->get('categorie')) is-invalid @endif" placeholder="Contact">
                                @if($errors->get('categorie'))
                                @foreach($errors->get('categorie') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="email" class="form-label">Email</label>
                                <input id="email_" name="email" type="text" class="form-control @if($errors->get('email')) is-invalid @endif" placeholder="Email">
                                @if($errors->get('email'))
                                @foreach($errors->get('email') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="nom_en_arabe" class="form-label">Nom en arabe</label>
                                <input id="nom_en_arabe_" name="nom_en_arabe" type="text" class="form-control @if($errors->get('nom_en_arabe')) is-invalid @endif" placeholder="Nom en arabe">
                                @if($errors->get('nom_en_arabe'))
                                @foreach($errors->get('nom_en_arabe') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="type" class="form-label">Type</label>
                                <input id="type_" name="type" type="text" class="form-control @if($errors->get('nom_en_arabe')) is-invalid @endif" placeholder="type">
                                @if($errors->get('type'))
                                @foreach($errors->get('type') as $message)
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
<!-- END: Model Ajouter Hotel Transports -->


</div>
<!-- END: gestion Hotel Transports-->
</div>
@endsection
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/gestion_Hotel_fornisseur.js')}}"></script>
@endsection
