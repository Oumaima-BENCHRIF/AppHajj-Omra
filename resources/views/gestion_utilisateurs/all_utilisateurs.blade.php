@extends('../layout/' . $layout)

@section('subhead')
<title>All Users</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-10">Tous les utilisateurs</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <!-- <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="btn btn-primary shadow-md mr-2">
            Add New User
        </a> -->

        <div class="hidden md:block mx-auto text-slate-500">Affichage (Total lignes:{{$countListeGestion_utilisateurs}})</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="dropdown">
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
    <!-- BEGIN: Users Layout -->
    @foreach ($listes_Gestion_utilisateurs as $faker)
    <div class="intro-y col-span-12 md:col-span-6">
        <div class="box">
            <div class="flex flex-col lg:flex-row items-center p-5">
                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                    <!-- <img alt="Midone - HTML Admin Template" class="rounded-full" src=""> -->
                </div>
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <a href="" class="font-medium">{{$faker->nom_utilisateur }}</a>
                    <div class="text-center lg:text-left p-5">
                        <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5">
                            <i data-lucide="instagram" class="w-3 h-3 mr-2"></i> {{$faker->privilege }}
                        </div>
                        <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1">
                            <i data-lucide="mail" class="w-3 h-3 mr-2"></i> {{$faker->email }}
                        </div>
                    </div>
                </div>
                <div class="flex mt-4 lg:mt-0">
                    <a href="{{ url('utilisateurs_view/' . $faker->id . '/show') }}"  class="btn btn-primary py-1 px-2 mr-2">Profile</a>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    <!-- BEGIN: Users Layout -->
    <!-- END: Pagination -->
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
<!-- BEGIN: Modal Recherche utilisateus -->
<div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Rechercher utilisateus</h2>

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
            <?php $url_update = route('utilisateurs.edit'); ?>
            <form action="{{  route('utilisateurs.all')  }}" method="get">

                {{ csrf_field() }}
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="nom_utilisateur" class="form-label">Nom utilisateur</label>
                        <input id="nom_utilisateur" name="nom_utilisateur" type="text" class="form-control" placeholder="Nom utilisateur">
                    </div>

                    <input type="hidden" id="id_" name="id_">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="ville" class="form-label">Ville</label>
                        <select id="ville" name="ville" data-search="true" value="{{old('ville')}}" class="tom-select w-full  @if ($errors->get('ville')) is-invalid @endif">
                            <option value="Ville" disabled selected hidden>Sélectionner Ville</option>
                            @foreach($villes as $ville)
                            <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="address" class="form-label">Address</label>
                        <input id="address" name="address" type="text" class="form-control" placeholder="Address">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="privilege" class="form-label">Privilege</label>
                        <select id="privilege" name="privilege"  value="{{old('privilege')}}" data-search="true" class="tom-select w-full @if ($errors->get('privilege')) is-invalid @endif">
                            <option value="privilege" disabled selected hidden>Sélectionner Privilège</option>
                            @foreach($Privileges as $Privilege)
                            <option value="{{$Privilege->nom}}">{{$Privilege->nom}}</option>
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
<!-- END: recherche Modal utilisateus -->


<!-- BEGIN: Modal Ajouter Transports-->
<!-- <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Ajouter utilisateur</h2>

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

            <div class="p-5">
                <form action="{{ url('utilisateurs_Store') }}" method="post" class="validate-form">
                    {{ csrf_field() }}

                    <div class="validate-form flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="input-form @if ($errors->get('nom_utilisateur')) has-error @endif">
                                        <label for="nom_utilisateur" class="form-label w-full flex flex-col sm:flex-row">
                                            Nom utilisateur <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">
                                                Obligatoire, au moins 2 caractères</span>
                                        </label>
                                        <input id="nom_utilisateur" value="{{old('nom_utilisateur')}}" name="nom_utilisateur" type="text" class="form-control @if ($errors->get('nom_utilisateur')) is-invalid @endif" placeholder="Nom Utilisateur" minlength="2" required>

                                        @if ($errors->get('nom_utilisateur'))
                                        @foreach ($errors->get('nom_utilisateur') as $message)
                                        <li class="text-danger">{{ $message }}</li>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="input-form mt-3 @if ($errors->get('mot_passe')) has-error @endif">
                                        <label for="mot_passe" class="form-label w-full flex flex-col sm:flex-row">
                                            Mot de passe <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Obligatoire, au moins 6 caractères</span>
                                        </label>
                                        <div class="password-container_">
                                            <input id="mot_passe" name="mot_passe" value="{{old('mot_passe')}}" type="password" class="form-control @if ($errors->get('mot_passe')) is-invalid @endif" placeholder="Mot de passe" minlength="6" required>
                                            <i data-lucide="eye" id="eye" class="block mx-auto fa-eye fa-solid " onclick="mot_pass()"></i>

                                            @if ($errors->get('mot_passe'))
                                            @foreach ($errors->get('mot_passe') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 @if ($errors->get('privilege')) has-error @endif">
                                        <label for="privilege" class="form-label">Privilège</label>
                                        <select id="privilege" name="privilege" value="{{old('privilege')}}" data-search="true" class="tom-select w-full @if ($errors->get('privilege')) is-invalid @endif">
                                            <option value="privilege">Sélectionner Privilège</option>
                                            @foreach($Privileges as $Privilege)
                                            <option value="{{$Privilege->nom}}">{{$Privilege->nom}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->get('privilege'))
                                        @foreach ($errors->get('privilege') as $message)
                                        <li class="text-danger">{{ $message }}</li>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="input-form mt-3 2xl:mt-0 @if ($errors->get('Email')) has-error @endif">
                                        <label for="Email" class="form-label w-full flex flex-col sm:flex-row">
                                            Email <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">
                                                Obligatoire, format d'adresse e-mail</span>
                                        </label>
                                        <input id="Email" name="Email" value="{{old('Email')}}" type="email" class="form-control  @if ($errors->get('Email')) is-invalid @endif" placeholder="example@gmail.com" required>

                                        @if ($errors->get('Email'))
                                        @foreach ($errors->get('Email') as $message)
                                        <li class="text-danger">{{ $message }}</li>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="input-form mt-3 @if ($errors->get('new_pass')) has-error @endif">
                                        <label for="new_pass" class="form-label w-full flex flex-col sm:flex-row">
                                            Confirmer Mot de passe <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at least 6 characters</span>
                                        </label>
                                        <div class="password-container">
                                            <input id="myInput" name="new_pass" value="{{old('new_pass')}}" type="password" class="form-control @if ($errors->get('new_pass')) is-invalid @endif" placeholder="Confirmer Mot de passe" minlength="6" required>
                                            <i data-lucide="eye" id="eye" class="block mx-auto fa-eye fa-solid " onclick="myFunction()"></i>

                                            @if ($errors->get('new_pass'))
                                            @foreach ($errors->get('new_pass') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-3 @if ($errors->get('ville')) has-error @endif">
                                        <label for="ville" class="form-label">Ville</label>
                                        <select id="ville" name="ville" data-search="true" value="{{old('ville')}}" class="tom-select w-full  @if ($errors->get('ville')) is-invalid @endif">
                                            <option value="Ville">Sélectionner Ville</option>
                                            @foreach($villes as $ville)
                                            <option value="{{$ville->nom}}">{{$ville->nom}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->get('ville'))
                                        @foreach ($errors->get('ville') as $message)
                                        <li class="text-danger">{{ $message }}</li>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="col-span-12">
                                    <div class="input-form mt-3 @if ($errors->get('address')) has-error @endif">
                                        <label for="address" class="form-label w-full flex flex-col sm:flex-row">
                                            Address <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Ce champ est obligatoire</span>
                                        </label>
                                        <textarea id="address" value="{{old('address')}}" class="form-control @if ($errors->get('address')) is-invalid @endif" placeholder="Adress" name="address" required></textarea>
                                        @if ($errors->get('address'))
                                        @foreach ($errors->get('address') as $message)
                                        <li class="text-danger">{{ $message }}</li>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-20 mt-3">Envoyer</button>
                        </div>
                </form>
                <div id="success-notification-content" class="toastify-content hidden flex">
                    <i class="text-success" data-lucide="check-circle"></i>
                    <div class="ml-4 mr-4">
                        <div class="font-medium">Inscription réussie!</div>
                        <div class="text-slate-500 mt-1">
                            Please check your e-mail for further info!
                        </div>
                    </div>
                </div>
                <div id="failed-notification-content" class="toastify-content hidden flex">
                    <i class="text-danger" data-lucide="x-circle"></i>
                    <div class="ml-4 mr-4">
                        <div class="font-medium">Échec de l'enregistrement!</div>
                        <div class="text-slate-500 mt-1">
                            Please check the fileld form.
                        </div>
                    </div>
                </div>

                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                    <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('build/assets/images/' . $fakers[0]['photos'][0]) }}">
                            <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="mx-auto cursor-pointer relative mt-5">
                            <button type="button" class="btn btn-primary w-full">Change Photo</button>
                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- END: Modal Ajouter Hotel Transports -->


@endsection
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif