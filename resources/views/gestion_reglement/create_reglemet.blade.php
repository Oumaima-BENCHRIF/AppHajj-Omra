@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Gestion Réglement</title>
<style>
    #lettrage{
        display:none;
    }
 
    </style>
   
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
                <div class="font-medium text-center text-lg">gestion Réglement</div>
            </div> 
            @if (Auth::user()->permissions->contains('name','Ajouter_Accompagnateurs'))
            <form id="Add_Reglement" action="{{ url('reglement_store') }}" method="post" class="validate-form my-5">
                {{ csrf_field() }}
                <div class="py-5 px-2  container">
                    <div class="form-inline">
                        <div class="intro-y w4 px-1 @if ($errors->get('N_reglement')) has-error @endif">
                            <label for="N_reglement" class="form-label mbt-2 text-size">N°reglement</label>
                            <input type="text" id="N_reglement" name="N_reglement" value="{{$numreglement}}" class="form-control py-1 @if ($errors->get('N_reglement')) is-invalid @endif" >
                            @if ($errors->get('N_reglement'))
                            @foreach ($errors->get('N_reglement') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w4 px-1 @if ($errors->get('date_reglement')) has-error @endif">
                            <label for="date_reglement" class="form-label mbt-2 text-size">date de Réglement</label>
                            <input id="date_reglement" name="date_reglement" type="date" class="form-control py-1 @if($errors->get('date_reglement')) is-invalid @endif" >
                            @if($errors->get('date_reglement'))
                            @foreach($errors->get('date_reglement') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w4 px-1  @if ($errors->get('jornal')) has-error @endif">
                            <label for="jornal" class="form-label mbt-2 text-size">jornal</label>
                            <select name="jornal" id="jornal" class="form-control py-1 ">
                            </select>
                            
                            @if($errors->get('jornal'))
                            @foreach($errors->get('jornal') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                        <div class="intro-y w4 px-1  @if ($errors->get('Succursales')) has-error @endif">
                            <label for="Succursales" class="form-label mbt-2 text-size">Succursales</label>
                           
                            <select name="Succursales" id="Succursales" class="form-control py-1 ">
                                <option value="1">Sélectioner</option>
                            </select>
                            @if($errors->get('Succursales'))
                            @foreach($errors->get('Succursales') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                  </div>
                 <div class="form-inline mt-2">

                    <div class="intro-y w4 px-1  @if ($errors->get('user')) has-error @endif">
                            <label for="user" class="form-label mbt-2 text-size">Utilisateur</label>
                            <input  name="user" id="user" type="text" disabled value="{{Auth::user()->name}}" class="form-control py-1" >
                            
                            @if($errors->get('user'))
                            @foreach($errors->get('user') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y w4 px-1  @if ($errors->get('client')) has-error @endif">
                            <label for="client" class="form-label mbt-2 text-size">Client</label>
                           
                            <select name="client" id="client" class="form-control py-1 ">
                                <option value="1">Sélectioner un client</option>
                               
                            </select>
                            @if($errors->get('client'))
                            @foreach($errors->get('client') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                 
                        <div class="intro-y w4 px-1  @if ($errors->get('n_piece')) has-error @endif">
                            <label for="n_piece" class="form-label mbt-2 text-size">N°Piéce </label>
                            <input id="n_piece" name="n_piece" type="text" class="form-control py-1 @if($errors->get('n_piece')) is-invalid @endif" placeholder="Entrer numero de piéce">

                            @if($errors->get('n_piece'))
                            @foreach($errors->get('n_piece') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                        <div class="intro-y w4 px-1  @if ($errors->get('sens')) has-error @endif">
                            <label for="sens" class="form-label mbt-2 text-size">Sens</label>
                           
                            <select name="sens" id="sens" class="form-control py-1">
                            </select>
                            @if($errors->get('Sens'))
                            @foreach($errors->get('Sens') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                       
                  </div>
                  <div class="form-inline mt-2">
                       <div class="intro-y w4 px-1  @if ($errors->get('libelle')) has-error @endif">
                           <label for="libelle" class="form-label mbt-2 text-size">Libelle</label>
                           <input id="libelle" name="libelle" type="text" class="form-control py-1 @if($errors->get('libelle')) is-invalid @endif" >

                           @if($errors->get('libelle'))
                           @foreach($errors->get('libelle') as $message)
                           <li class="text-danger">{{$message}}</li>
                           @endforeach
                           @endif
                       </div>

                       <div class="intro-y w4 px-1  @if ($errors->get('mode')) has-error @endif">
                           <label for="mode" class="form-label mbt-2 text-size">Mode </label>
                           <select name="mode" id="mode" class="form-control py-1 ">
                            </select>
                           @if($errors->get('mode'))
                           @foreach($errors->get('mode') as $message)
                           <li class="text-danger">{{$message}}</li>
                           @endforeach
                           @endif
                       </div>
                       <div class="intro-y w4 px-1  @if ($errors->get('Montant')) has-error @endif">
                            <label for="Montant" class="form-label mbt-2 text-size">Montant</label>
                            <input id="Montant" name="Montant" type="text" class="form-control py-1 @if($errors->get('Montant')) is-invalid @endif" >

                            @if($errors->get('Montant'))
                            @foreach($errors->get('Montant') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                       <div class="intro-y w4 px-1  @if ($errors->get('M_reglement')) has-error @endif">
                           <label for="M_reglement" class="form-label mbt-2 text-size">Marge Réglement</label>
                           <input id="M_reglement" name="M_reglement" type="text" class="form-control py-1 @if($errors->get('M_reglement')) is-invalid @endif" >

                           @if($errors->get('M_reglement'))
                           @foreach($errors->get('M_reglement') as $message)
                           <li class="text-danger">{{$message}}</li>
                           @endforeach
                           @endif
                       </div>
                 </div>
                 <div class="form-inline mt-2  justify-content-end  ">  
                        <div class="intro-y w4 mt-5 px-1">
                             <button type="Submit" id="ajouter" class="btn btn-primary  w-full  p-1">Ajouter</button>
                             <button type="button" id="reglement" class="btn btn-primary  w-full  p-1">imprimer</button>
                         </div> 
                       </div>
                       <div class="overflow-x-auto scrollbar-hidden">
                                    <div id="line_Reglement" class="mt-5 table-report--tabulator"></div>
                                </div>
             </div>
            </form>
            @endif
        <div class="py-5 px-2 container" id="lettrage">
        <div class="px-5 mt-2 mb-2">
                <div class="font-medium text-center">ligne de lettrage</div>
            </div>
            <div  class="form-inline">
                <form  id="add_factures" action="{{ url('detail_store') }}" method="post" style="display: contents" >
                {{ csrf_field() }}
          <div class="intro-y w4 px-1  @if ($errors->get('factures')) has-error @endif">
          <input type="hidden" id="N_reglement2" name="N_reglement2" value="{{$numreglement}}" >
                      <label for="factures" class="form-label mbt-2 text-size">Factures</label>
                          <select name="factures" id="factures" class="form-control py-1 ">
                            </select>
                               @if($errors->get('factures'))
                               @foreach($errors->get('factures') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                        </div>
                        <div class="intro-y w4 mt-5 px-1">
                                <button type="Submit"class="btn btn-primary p-1">Go</button>
                        </div> 
 </form>

        </div>
        <div class="overflow-x-auto scrollbar-hidden">
                    <div id="liste_Reglement" class="mt-5 table-report--tabulator"></div>
          </div>
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

</div>
<!-- END: Model Ajouter Accompagnateurs -->


</div>
<!-- END: gestion fiche client -->


</div>


@endsection
@section('jqscripts')
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script type="text/javascript" src="{{URL::asset('js/Gestion_reglement.js')}}"></script>
 
@endsection