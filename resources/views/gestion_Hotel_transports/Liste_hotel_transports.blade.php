@extends('../layout/' . $layout)

@section('subhead')
<title>CRUD Data List - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')<br>
<br>
<div class="flex justify-center">
    <a title="gestion hotels transports" class="intro-y w-10 h-10 rounded-full btn bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400 text-slate-500 mx-2" href="{{ url('hotel_transports') }}">1</button>
        <a title="listes hotels transports" class="intro-y w-10 h-10 rounded-full btn btn-primary mx-2" href="{{ url('liste_hotel_transports') }}">2</a>
        <!-- <button class="intro-y w-10 h-10 rounded-full btn bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400 text-slate-500 mx-2">3</button> -->
</div>
<h2 class="intro-y text-lg font-medium mt-10">Liste hotel transports</h2>

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


<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <!-- add new hotel transport -->
        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#static-backdrop-modal-preview" class="btn btn-primary shadow-md mr-2">Add New hotel transports</a>
        <!-- <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#superlarge-modal-size-preview"  class="btn btn-primary shadow-md mr-2">Add New hotel transports</a> -->
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
        <div class="hidden md:block mx-auto text-slate-500"> Affichage (Total lignes:{{$countListeHotel_transports}})</div>
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
                    <th class="text-center whitespace-nowrap">Code</th>
                    <th class="text-center whitespace-nowrap">Nom</th>
                    <!-- <th class="text-center whitespace-nowrap">Ville</th> -->
                    <th class="text-center whitespace-nowrap">Emplacement</th>
                    <!-- <th class="text-center whitespace-nowrap">Telephone</th> -->
                    <th class="text-center whitespace-nowrap">Fax</th>
                    <!-- <th class="text-center whitespace-nowrap">Site</th> -->
                    <th class="text-center whitespace-nowrap">C C ramadan</th>
                    <th class="text-center whitespace-nowrap">C C mouloud</th>
                    <!-- <th class="text-center whitespace-nowrap">Email</th> -->
                    <!-- <th class="text-center whitespace-nowrap">Categorie</th> -->
                    <!-- <th class="text-center whitespace-nowrap">Nom en arabe</th> -->
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listes_Hotel_transports as $key => $listesHotel_transports)
                <tr class="intro-x">
                    <td>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesHotel_transports->code }}</div>
                    </td>
                    <td>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesHotel_transports->nom }}</div>
                    </td>
                    <td>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesHotel_transports->emplacement }}</div>
                    </td>
                    <td>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesHotel_transports->fax }}</div>
                    </td>
                    <td>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesHotel_transports->compte_comptable_ramadan }}</div>
                    </td>
                    <td>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$listesHotel_transports->compte_comptable_mouloud }}</div>
                    </td>
                    <?php $url_info = route('hotel_transports.infos'); ?>

                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <!-- update -->
                            <button onclick="showDialogueModifierHOTELTRANSPORTS('{{ $url_info }}?id={{ $listesHotel_transports->id }}')" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="flex items-center mr-3">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </button>



                            <!-- delete -->
                            <button onclick="showDialogueDeleteHotelTransport('{{ $listesHotel_transports->id }}')" value="{{ $listesHotel_transports->id }}" class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </button>


                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($countListeHotel_transports == 0)
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

<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                </div>
                <form action="{{ route('hotel_transports.delete') }}" method="post">

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
<!-- END: Delete Confirmation Modal -->

<!-- BEGIN: Modal update -->

<!-- END: Modal update -->
<!-- BEGIN: Modal update -->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Modifier Hotel Transport</h2>

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

            <?php $url_update = route('hotel_transports.edit'); ?>
            <form action="{{ route('hotel_transports.update') }}" method="post">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="code" class="form-label">Code</label>
                        <input id="code" name="code" value="{{old('code')}}" type="text" class="form-control" placeholder="Code">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input id="nom" name="nom" value="{{old('nom')}}" type="text" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="ville" class="form-label">Ville</label>
                        <input id="ville" name="ville" value="{{old('ville')}}" type="text" class="form-control" placeholder="Ville">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="emplacement" class="form-label">Emplacement</label>
                        <input id="emplacement" name="emplacement" value="{{old('emplacement')}}" type="text" class="form-control" placeholder="Emplacement">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input id="telephone" name="telephone" type="text" value="{{old('telephone')}}" class="form-control" placeholder="Telephone">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="fax" class="form-label">Fax</label>
                        <input id="fax" name="fax" type="text" value="{{old('fax')}}" value="{{old('fax')}}" class="form-control" placeholder="Fax">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="site" class="form-label">Site</label>
                        <input id="site" name="site" type="text" value="{{old('site')}}" class="form-control" placeholder="Site">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="compte_comptable_ramadan" class="form-label">Compte comptable ramadan</label>
                        <input id="compte_comptable_ramadan" value="{{old('compte_comptable_ramadan')}}" name="compte_comptable_ramadan" type="text" class="form-control" placeholder="compte_comptable_ramadan">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="compte_comptable_mouloud" class="form-label">Compte comptable mouloud</label>
                        <input id="compte_comptable_mouloud" value="{{old('compte_comptable_mouloud')}}" name="compte_comptable_mouloud" type="text" class="form-control" placeholder="Compte comptable mouloud">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="contact" class="form-label">Contact</label>
                        <input id="contact" name="contact" type="text" value="{{old('contact')}}" class="form-control" placeholder="Contact">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" value="{{old('email')}}" type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="categorie" class="form-label">Categorie</label>
                        <input id="categorie" name="categorie" value="{{old('categorie')}}" type="text" class="form-control" placeholder="Categorie">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="nom_en_arabe" class="form-label">Nom en arabe</label>
                        <input id="nom_en_arabe" name="nom_en_arabe" value="{{old('nom_en_arabe')}}" type="text" class="form-control" placeholder="Nom en arabe">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="type" class="form-label">Type</label>
                        <input id="type" name="type" type="text" value="{{old('type')}}" class="form-control" placeholder="Type">
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
<!-- END: Modal Content -->

<!-- END: Large Modal Content -->
<!-- BEGIN: update To add new hotel transport -->


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
                                <input id="nom_" name="nom" type="text" class="form-control @if($errors->get('nom')) is-invalid @endif" placeholder="Nom">
                                @if($errors->get('nom'))
                                @foreach($errors->get('nom') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="ville" class="form-label">Ville</label>
                                <input id="ville_" name="ville" type="text" class="form-control @if($errors->get('ville')) is-invalid @endif" placeholder="Ville">
                                @if($errors->get('ville'))
                                @foreach($errors->get('ville') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="emplacement" class="form-label">Emplacement</label>
                                <input id="emplacement_" name="emplacement" type="text" class="form-control @if($errors->get('emplacement')) is-invalid @endif" placeholder="Emplacement">

                                @if($errors->get('emplacement'))
                                @foreach($errors->get('emplacement') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="telephone" class="form-label">Telephone</label>
                                <input id="telephone_" name="telephone" class="form-control @if($errors->get('telephone')) is-invalid @endif" type="text" class="form-control" placeholder="Telephone">

                                @if($errors->get('telephone'))
                                @foreach($errors->get('telephone') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="fax" class="form-label">Fax</label>
                                <input id="fax_" name="fax" type="text" class="form-control @if($errors->get('fax')) is-invalid @endif" placeholder="Fax">
                                @if($errors->get('fax'))
                                @foreach($errors->get('fax') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="site" class="form-label">Site</label>
                                <input id="site_" name="site" type="text" class="form-control @if($errors->get('site')) is-invalid @endif" placeholder="Site">
                                @if($errors->get('site'))
                                @foreach($errors->get('site') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="compte_comptable_ramadan" class="form-label">Compte comptable ramadan</label>
                                <input id="compte_comptable_ramadan_" name="compte_comptable_ramadan" type="text" class="form-control @if($errors->get('compte_comptable_ramadan')) is-invalid @endif" placeholder="Compte comptable ramadan">
                                @if($errors->get('compte_comptable_ramadan'))
                                @foreach($errors->get('compte_comptable_ramadan') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="compte_comptable_mouloud" class="form-label">Compte comptable mouloud</label>
                                <input id="compte_comptable_mouloud_" name="compte_comptable_mouloud" type="text" class="form-control @if($errors->get('compte_comptable_mouloud')) is-invalid @endif" placeholder="Compte comptable mouloud">
                                @if($errors->get('compte_comptable_mouloud'))
                                @foreach($errors->get('compte_comptable_mouloud') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="contact" class="form-label">Contact</label>
                                <input id="contact_" name="contact" type="text" class="form-control @if($errors->get('contact')) is-invalid @endif" placeholder="Contact">
                                @if($errors->get('contact'))
                                @foreach($errors->get('contact') as $message)
                                <li class="text-danger">{{$message}}</li>
                                @endforeach
                                @endif
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="categorie" class="form-label">Categorie</label>
                                <input id="categorie_" name="categorie" type="text" class="form-control @if($errors->get('categorie')) is-invalid @endif" placeholder="Contact">
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
<!-- END: Super Large Modal Content -->
<!-- add Model to add new hotel -->

<!-- BEGIN: search Modal Content -->
<div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher Hotel Transport</h2>

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
            <?php $url_update = route('hotel_transports.edit'); ?>
            <!-- <form action="{{  route('liste_hotel_transports.index')  }}" method="get">

                                                {{ csrf_field() }}
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="code" class="form-label">Code</label>
                                                            <input id="code__" name="code__" type="text" class="form-control" placeholder="Code">
                                                        </div>

                                                        <input type="hidden" id="id_" name="id_" >

                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="nom" class="form-label">Nom</label>
                                                            <input id="nom__" name="nom__" type="text" class="form-control" placeholder="Nom">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="ville" class="form-label">Ville</label>
                                                            <input id="ville__" name="ville__" type="text" class="form-control" placeholder="Ville">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="emplacement" class="form-label">Emplacement</label>
                                                            <input id="emplacement__" name="emplacement__"  type="text" class="form-control" placeholder="Emplacement">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="telephone" class="form-label">Telephone</label>
                                                            <input id="telephone__" name="telephone__" type="text" class="form-control" placeholder="Telephone">
                                                        </div>
                                                     
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="fax" class="form-label">Fax</label>
                                                            <input id="fax__" name="fax__" type="text"   class="form-control" placeholder="Fax">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="site" class="form-label">Site</label>
                                                            <input id="site__" name="site__" type="text" class="form-control" placeholder="Site">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="compte_comptable_ramadan" class="form-label">Compte comptable ramadan</label>
                                                            <input id="compte_comptable_ramadan__" name="compte_comptable_ramadan__" type="text" class="form-control" placeholder="compte_comptable_ramadan">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="compte_comptable_mouloud" class="form-label">Compte comptable mouloud</label>
                                                            <input id="compte_comptable_mouloud__"  name="compte_comptable_mouloud__" type="text" class="form-control" placeholder="Compte comptable mouloud">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="contact" class="form-label">Contact</label>
                                                            <input id="contact__" name="contact__" type="text" class="form-control" placeholder="Contact">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input id="email__" name="email__"  type="text" class="form-control" placeholder="Email">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="categorie" class="form-label">Categorie</label>
                                                            <input id="categorie__" name="categorie__"  type="text" class="form-control" placeholder="Categorie">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="nom_en_arabe" class="form-label">Nom en arabe</label>
                                                            <input id="nom_en_arabe__" name="nom_en_arabe__"  type="text" class="form-control" placeholder="Nom en arabe">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="type" class="form-label">Type</label>
                                                            <input id="type__" name="type__" type="text" class="form-control" placeholder="Type">
                                                        </div>
                                                              
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                                        <button type="submit" class="btn btn-primary w-20">Send</button>
                                                    </div>
                                            </form>
 -->


        </div>
    </div>
</div>
<!-- END: search Modal Content -->

@endsection
<script>
    function showDialogueDeleteHotelTransport(id) {
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

    function showDialogueModifierHOTELTRANSPORTS(url) {

        // console.log(id);

        // document.getElementById("id_").value = id;

        ajaxPost(url, (obj) => {

            // --------------------------- fill
            const nv = obj.Hotel_transports;
            document.getElementById("id_").value = nv.id;
            document.getElementById("code").value = nv.code;
            document.getElementById("nom").value = nv.nom;
            document.getElementById("ville").value = nv.ville;
            document.getElementById("emplacement").value = nv.emplacement;
            document.getElementById("telephone").value = nv.telephone;
            document.getElementById("fax").value = nv.fax;
            document.getElementById("site").value = nv.site;
            document.getElementById("compte_comptable_ramadan").value = nv.compte_comptable_ramadan;
            document.getElementById("compte_comptable_mouloud").value = nv.compte_comptable_mouloud;
            document.getElementById("contact").value = nv.contact;
            document.getElementById("email").value = nv.email;
            document.getElementById("categorie").value = nv.categorie;
            document.getElementById("nom_en_arabe").value = nv.nom_en_arabe;
            document.getElementById("type").value = nv.type;
            // console.log(document.getElementById("url_update").value);
        });
    }
</script>