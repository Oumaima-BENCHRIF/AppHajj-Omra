@extends('../layout/' . $layout)
<?php

use Illuminate\Support\Facades\Session;

?>
@section('subhead')
<title>Gestion Référence Programmes</title>
@endsection

@section('subcontent')
<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Gestion Référence Programmes</h2>
</div>
<div class="px-5 sm:px-20 mt-10 pt-10 ">
    <div class="grid grid-cols-6 gap-4">
        <div class="intro-y col-span-12 sm:col-span-6">
            @if (session()->has('danger'))
            <!-- BEGIN -->

            <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
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

<ul class="nav nav-boxed-tabs" role="tablist">
    <li id="example-3-tab" class="nav-item flex-1" role="presentation">
        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3" aria-selected="true">Ajouter Référence Programmes</button>

    </li>
    <li id="example-4-tab" class="nav-item flex-1" role="presentation">
        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-4" type="button" role="tab" aria-controls="example-tab-4" aria-selected="false">
            Consulter Référence Programmes
        </button>
    </li>
</ul>
<!-- BEGIN: gestion Référence Programmes -->
<div class="tab-content mt-5">

    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
        <div class="tab-content intro-y box py-10 sm:py-20 mt-5" id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">

            <div class="px-5 mt-10">
                <div class="font-medium text-center text-lg">Gestion Référence Programmes</div>
            </div>

            <form action="{{ url('Reference_programmes_Store') }}" method="post">
                {{ csrf_field() }}
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="N_programme" class="form-label">N° programme</label>

                            <input type="number" id="N_programme" value="{{old('N_programme')}}" name="N_programme" class="form-control @if ($errors->get('N_programme')) is-invalid @endif" placeholder="Entrer N° programme">

                            @if ($errors->get('N_programme'))
                            @foreach ($errors->get('N_programme') as $message)
                            <li class="text-danger">{{ $message }}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="nom_programme" class="form-label">Nom programme</label>
                            <input id="nom_programme" name="nom_programme" type="text" value="{{old('nom_programme')}}" class="form-control @if($errors->get('nom_programme')) is-invalid @endif" placeholder="Nom programme">
                            @if($errors->get('nom_programme'))
                            @foreach($errors->get('nom_programme') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="type" class="form-label">Type</label>
                            <input id="type" name="type" type="text" value="{{old('type')}}" class="form-control @if($errors->get('type')) is-invalid @endif" placeholder="type">
                            @if($errors->get('type'))
                            @foreach($errors->get('ville') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>


                        <!-- BEGIN: Basic Select -->
                        <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="type" class="form-label">Type</label>
                            <div class="mt-2">
                                <select  data-placeholder="Select your favorite actors" class="tom-select w-full">
                                    <option value="1">Leonardo DiCaprio</option>
                                    <option value="2">Johnny Deep</option>
                                    <option value="3">Robert Downey, Jr</option>
                                    <option value="4">Samuel L. Jackson</option>
                                    <option value="5">Morgan Freeman</option>
                                </select>
                            </div>
                        </div>
                        <!-- END: Basic Select -->

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="nbre_nuitees" class="form-label">Nbre Nuitées</label>
                            <input id="nbre_nuitees" name="nbre_nuitees" value="{{old('nbre_nuitees')}}" type="number" class="form-control @if($errors->get('nbre_nuitees')) is-invalid @endif" placeholder="Nbre Nuitées">

                            @if($errors->get('nbre_nuitees'))
                            @foreach($errors->get('nbre_nuitees') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="ref_programme" class="form-label">Ref programme</label>
                            <input id="ref_programme" name="ref_programme" value="{{old('ref_programme')}}" class="form-control @if($errors->get('ref_programme')) is-invalid @endif" type="text" class="form-control" placeholder="Ref programme">

                            @if($errors->get('ref_programme'))
                            @foreach($errors->get('ref_programme') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="compagnie" class="form-label">Compagnie</label>
                            <input id="compagnie" name="compagnie" type="text" value="{{old('compagnie')}}" class="form-control @if($errors->get('compagnie')) is-invalid @endif" placeholder="Compagnie">
                            @if($errors->get('compagnie'))
                            @foreach($errors->get('compagnie') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="transfert" class="form-label">Transfert</label>
                            <input id="transfert" name="transfert" type="text" value="{{old('transfert')}}" class="form-control @if($errors->get('transfert')) is-invalid @endif" placeholder="Transfert">

                            @if($errors->get('transfert'))
                            @foreach($errors->get('transfert') as $message)
                            <li class="text-danger">{{$message}}</li>
                            @endforeach
                            @endif
                        </div>

                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                            <button type="Submit" class="btn btn-primary w-24 ml-2">Envoyer</button>
                        </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- END: gestion hotels transports -->

<!-- BEGIN: LISTE hotels transports -->
<div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <!-- add new TO -->
            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#static-backdrop-modal-preview" class="btn btn-primary shadow-md mr-2">Ajouter hotels transports</a>
            <!-- END -->
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
            <div class="hidden md:block mx-auto text-slate-500"> Affichage (Total lignes:{{$countListe_reference_programmes}})</div>
            <!-- search -->
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
            <!-- end search -->
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">N° programme</th>
                        <th class="text-center whitespace-nowrap">Nom programme</th>
                        <th class="text-center whitespace-nowrap">Type</th>
                        <th class="text-center whitespace-nowrap">Nbre nuitees</th>
                        <th class="text-center whitespace-nowrap">Ref Programme</th>
                        <th class="text-center whitespace-nowrap">Compagnie</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listes_reference_programmes as $key => $listesReference_programmes)
                    <tr class="intro-x">
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesReference_programmes->N_programme }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesReference_programmes->nom_programme }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesReference_programmes->type }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesReference_programmes->nbre_nuitees }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesReference_programmes->ref_programme }}</div>
                        </td>
                        <td>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesReference_programmes->compagnie }}</div>
                        </td>

                        <?php $url_info = route('Reference_programmes.infos'); ?>

                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <!-- update -->
                                <button onclick="showDialogueModifierReference_programmes('{{ $url_info }}?id={{ $listesReference_programmes->id }}')" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="flex items-center mr-3">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </button>



                                <!-- delete -->
                                <button onclick="showDialogueDeleteReference_programmes('{{ $listesReference_programmes->id }}')" value="{{ $listesReference_programmes->id }}" class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </button>


                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($countListe_reference_programmes== 0)
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-center">
                        <p class="text-danger">Aucune données disponible</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
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
        <!-- END: Pagination -->
    </div>

    <!-- BEGIN: Delete TO Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                    </div>
                    <form action="{{ route('Reference_programmes.delete') }}" method="post">

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
<!-- END: Delete  Confirmation Modal -->

<!-- BEGIN: Modal update Référence Programmess-->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Modifier Référence Programmes</h2>

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

            <?php $url_update = route('Reference_programmes.edit'); ?>
            <form action="{{ route('Reference_programmes.update') }}" method="post">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="N_programme__" class="form-label">N° programme</label>
                        <input id="N_programme__" name="N_programme__" value="{{old('N_programme__')}}" type="number" class="form-control" placeholder="N° programme">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="nom_programme__" class="form-label">Nom programme</label>
                        <input id="nom_programme__" name="nom_programme__" value="{{old('nom_programme__')}}" type="text" class="form-control" placeholder="Nom programme">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="type___" class="form-label">Type</label>
                        <input id="type___" name="type___" value="{{old('type___')}}" type="text" class="form-control" placeholder="Type">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="nbre_nuitees__" class="form-label">Nbre nuitees</label>
                        <input id="nbre_nuitees__" name="nbre_nuitees__" value="{{old('nbre_nuitees__')}}" type="number" class="form-control" placeholder="Nbre nuitees">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="ref_programme_" class="form-label">Ref programme</label>
                        <input id="ref_programme_" name="ref_programme_" type="text" value="{{old('ref_programme_')}}" class="form-control" placeholder="Ref programme">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="compagnie__" class="form-label">Compagnie</label>
                        <input id="compagnie__" name="compagnie__" type="text" value="{{old('compagnie__')}}" class="form-control" placeholder="Compagnie">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="transfert__" class="form-label">Transfert</label>
                        <input id="transfert__" name="transfert__" type="text" value="{{old('transfert__')}}" class="form-control" placeholder="Transfert">
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
<!-- END: Modal modifier Référence Programmess -->

<!-- BEGIN: Model Ajouter Référence Programmess -->
<div id="static-backdrop-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body px-5 py-10">

                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Ajouter Référence Programmes</h2>
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

                <form action="{{ url('Reference_programmes_Store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="N_programme" class="form-label">N° programme</label>

                                <input type="number" id="N_programme" value="{{old('N_programme')}}" name="N_programme" class="form-control @if ($errors->get('N_programme')) is-invalid @endif" placeholder="Entrer N° programme">

                                @if ($errors->get('N_programme'))
                                @foreach ($errors->get('N_programme') as $message)
                                <li class="text-danger">{{ $message }}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="nom_programme" class="form-label">Nom programme</label>
                                <input id="nom_programme" name="nom_programme" type="text" value="{{old('nom_programme')}}" class="form-control @if($errors->get('nom_programme')) is-invalid @endif" placeholder="Nom programme">
                                @if($errors->get('nom_programme'))
                                @foreach($errors->get('nom_programme') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="type" class="form-label">Type</label>
                                <input id="type" name="type" type="text" value="{{old('type')}}" class="form-control @if($errors->get('type')) is-invalid @endif" placeholder="type">
                                @if($errors->get('type'))
                                @foreach($errors->get('ville') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="nbre_nuitees" class="form-label">Nbre Nuitées</label>
                                <input id="nbre_nuitees" name="nbre_nuitees" value="{{old('nbre_nuitees')}}" type="number" class="form-control @if($errors->get('nbre_nuitees')) is-invalid @endif" placeholder="Nbre Nuitées">

                                @if($errors->get('nbre_nuitees'))
                                @foreach($errors->get('nbre_nuitees') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="ref_programme" class="form-label">Ref programme</label>
                                <input id="ref_programme" name="ref_programme" value="{{old('ref_programme')}}" class="form-control @if($errors->get('ref_programme')) is-invalid @endif" type="text" class="form-control" placeholder="Ref programme">

                                @if($errors->get('ref_programme'))
                                @foreach($errors->get('ref_programme') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="compagnie" class="form-label">Compagnie</label>
                                <input id="compagnie" name="compagnie" type="text" value="{{old('compagnie')}}" class="form-control @if($errors->get('compagnie')) is-invalid @endif" placeholder="Compagnie">
                                @if($errors->get('compagnie'))
                                @foreach($errors->get('compagnie') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="transfert" class="form-label">Transfert</label>
                                <input id="transfert" name="transfert" type="text" value="{{old('transfert')}}" class="form-control @if($errors->get('transfert')) is-invalid @endif" placeholder="Transfert">

                                @if($errors->get('transfert'))
                                @foreach($errors->get('transfert') as $message)
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
<!-- END: Model Ajouter Référence Programmess -->

<!-- BEGIN: Modal Recherche Référence Programmess -->
<div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Référence Programmes</h2>

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
            <?php $url_update = route('Reference_programmes.edit'); ?>
            <form action="{{  route('Reference_programmes.index')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="_N_programme" class="form-label">N° programme</label>
                        <input id="_N_programme" name="_N_programme" type="number" class="form-control" placeholder="N° programme">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="_nom_programme" class="form-label">Nom programme</label>
                        <input id="_nom_programme" name="_nom_programme" type="text" class="form-control" placeholder="Nom programme">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="_type" class="form-label">Type</label>
                        <input id="_type" name="_type" type="text" class="form-control" placeholder="Type">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="_nbre_nuitees" class="form-label">Nbre Nuitees</label>
                        <input id="_nbre_nuitees" name="_nbre_nuitees" type="number" class="form-control" placeholder="Nbre Nuitees">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="_ref_programme" class="form-label">Ref Programme</label>
                        <input id="_ref_programme" name="_ref_programme" type="text" class="form-control" placeholder="Ref Programme">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="_compagnie" class="form-label">Compagnie</label>
                        <input id="_compagnie" name="_compagnie" type="text" class="form-control" placeholder="Compagnie">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="_transfert" class="form-label">Transfert</label>
                        <input id="_transfert" name="_transfert" type="text" class="form-control" placeholder="Transfert">
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
<!-- END: recherche Modal Référence Programmess -->

</div>
<!-- END: gestion Référence Programmess-->


</div>


@endsection
<script>
    function showDialogueDeleteReference_programmes(id) {
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

    function showDialogueModifierReference_programmes(url) {

        // console.log(id);

        // document.getElementById("id_").value = id;

        ajaxPost(url, (obj) => {

            // --------------------------- fill
            const nv = obj.Reference_Programmes;
            document.getElementById("id_").value = nv.id;
            document.getElementById("N_programme__").value = nv.N_programme;
            document.getElementById("nom_programme__").value = nv.nom_programme;
            document.getElementById("type___").value = nv.type;
            document.getElementById("nbre_nuitees__").value = nv.nbre_nuitees;
            document.getElementById("ref_programme_").value = nv.ref_programme;
            document.getElementById("compagnie__").value = nv.compagnie;
            document.getElementById("transfert__").value = nv.transfert;
            // console.log(document.getElementById("url_update").value);
        });
    }
</script>