@extends('../layout/' . $layout)

@section('subhead')
<title>Gestion Utilisateurs</title>
@endsection
<style>
    .password-container {

        position: relative;
    }

    .password-container input[type="password"] {

        box-sizing: border-box;
    }

    .fa-eye {
        position: absolute;
        top: 28%;
        right: 4%;
        cursor: pointer;
        color: lightgray;
    }

    .password-container_ {
        position: relative;
    }

    .password-container_ input[type="password"] {

        box-sizing: border-box;
    }

    .container {
        border: 2px solid #ccc;
        height: 200px;
        overflow-y: scroll;
    }
</style>
@section('subcontent')
<!-- debut -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Gestion Utilisateurs</h2>
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
<!-- Fin -->

<div class="intro-y grid grid-cols-12 gap-5 mt-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y col-span-12 lg:col-span-8">

        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__content tab-content">
                    <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">

                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                Information
                            </div>
                            <div class="mt-5">
                                <form action="{{ url('utilisateurs_Store') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div @if(Auth()->user()->privilege != 'Admin' ) style="display:none" @endif  class="input-form @if ($errors->get('Nom_DB')) has-error @endif">
                                            <!-- <label for="name" class="form-label">Nom Utilisateur</label> -->
                                            <label for="Nom_DB" class="form-label w-full flex flex-col sm:flex-row">
                                                Nom DB <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">
                                                    Obligatoire</span>
                                            </label>
                                            <input id="Nom_DB" value="{{old('Nom_DB')}}" name="Nom_DB" type="text" class="form-control @if ($errors->get('Nom_DB')) is-invalid @endif" placeholder="Nom BD" required>

                                            @if ($errors->get('Nom_DB'))
                                            @foreach ($errors->get('Nom_DB') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="input-form @if ($errors->get('name')) has-error @endif">
                                            <!-- <label for="name" class="form-label">Nom Utilisateur</label> -->
                                            <label for="name" class="form-label w-full flex flex-col sm:flex-row">
                                                Nom utilisateur <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">
                                                    Obligatoire, au moins 2 caractères</span>
                                            </label>
                                            <input id="name" value="{{old('name')}}" name="name" type="text" class="form-control @if ($errors->get('name')) is-invalid @endif" placeholder="Nom Utilisateur" minlength="2" required>

                                            @if ($errors->get('name'))
                                            @foreach ($errors->get('name') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="input-form mt-3 2xl:mt-0 @if ($errors->get('email')) has-error @endif">
                                            <!-- <label for="email" class="form-label">email</label> -->
                                            <label for="email" class="form-label w-full flex flex-col sm:flex-row">
                                                email <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">
                                                    Obligatoire, format d'adresse e-mail</span>
                                            </label>
                                            <input id="email" name="email" value="{{old('email')}}" type="email" class="form-control  @if ($errors->get('email')) is-invalid @endif" placeholder="example@gmail.com" required>

                                            @if ($errors->get('email'))
                                            @foreach ($errors->get('email') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                        <!-- gender -->
                                        <div class="mt-3 @if ($errors->get('gender')) has-error @endif">
                                            <label for="gender" class="form-label">Le genre</label>
                                            <select id="gender" name="gender" value="{{old('gender')}}" data-search="true" class="tom-select w-full @if ($errors->get('gender')) is-invalid @endif">
                                                <option value="gender" disabled selected hidden>Sélectionner Le genre</option>

                                                <option value="Femme">Femme</option>
                                                <option value="Homme">Homme</option>

                                            </select>
                                            @if ($errors->get('gender'))
                                            @foreach ($errors->get('gender') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                        <!-- fin gender -->

                                        <div class="mt-3 @if ($errors->get('privilege')) has-error @endif">
                                            <label for="privilege" class="form-label">Privilège</label>
                                            <select id="privilege" name="privilege" value="{{old('privilege')}}" data-search="true" class="tom-select w-full @if ($errors->get('privilege')) is-invalid @endif">
                                                <option value="privilege" disabled selected hidden>Sélectionner Privilège</option>
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
                                        <!-- Telephone debut -->
                                        <div class="mt-3 @if ($errors->get('telephone')) has-error @endif">
                                            <label for="telephone" class="form-label w-full flex flex-col sm:flex-row">
                                                Telephone utilisateur <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">
                                                    Obligatoire, au moins 10 caractères</span>
                                            </label>
                                            <input id="telephone" value="{{old('telephone')}}" name="telephone" type="text" class="form-control @if ($errors->get('telephone')) is-invalid @endif" placeholder="telephone Utilisateur" minlength="10" required>

                                            @if ($errors->get('telephone'))
                                            @foreach ($errors->get('telephone') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                        <!-- Telephone fin  -->

                                    </div>
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="input-form mt-3 @if ($errors->get('mot_passe')) has-error @endif">
                                            <!-- <label for="mot_passe" class="form-label">Mot de passe</label> -->
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
                                        <div class="input-form mt-3 @if ($errors->get('password')) has-error @endif">
                                            <!-- <label for="password" class="form-label">Confirmer Mot de passe</label> -->
                                            <label for="password" class="form-label w-full flex flex-col sm:flex-row">
                                                Confirmer Mot de passe <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at least 6 characters</span>
                                            </label>
                                            <div class="password-container">
                                                <input id="myInput" name="password" value="{{old('password')}}" type="password" class="form-control @if ($errors->get('password')) is-invalid @endif" placeholder="Confirmer Mot de passe" minlength="6" required>
                                                <i data-lucide="eye" id="eye" class="block mx-auto fa-eye fa-solid " onclick="myFunction()"></i>

                                                @if ($errors->get('password'))
                                                @foreach ($errors->get('password') as $message)
                                                <li class="text-danger">{{ $message }}</li>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-3 @if ($errors->get('ville')) has-error @endif">
                                            <label for="ville" class="form-label">Ville</label>
                                            <select id="ville" name="ville" data-search="true" value="{{old('ville')}}" class="tom-select w-full  @if ($errors->get('ville')) is-invalid @endif">
                                                <option value="Ville" disabled selected hidden>Sélectionner Ville</option>
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
                                        <div class="input-form mt-3 @if ($errors->get('adress')) has-error @endif">
                                            <!-- <label for="adress" class="form-label">adress</label> -->
                                            <label for="adress" class="form-label w-full flex flex-col sm:flex-row">
                                                adress <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Ce champ est obligatoire</span>
                                            </label>
                                            <textarea id="adress" value="{{old('adress')}}" class="form-control @if ($errors->get('adress')) is-invalid @endif" placeholder="Adress" name="adress" required></textarea>
                                            @if ($errors->get('adress'))
                                            @foreach ($errors->get('adress') as $message)
                                            <li class="text-danger">{{ $message }}</li>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-20 mt-3">Envoyer</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Item List -->
    <!-- BEGIN: Ticket -->
    <div class="col-span-12 lg:col-span-4">
        <div class="intro-y pr-1">
            <div class="box p-2">
                <ul class="nav nav-pills" role="tablist">
                    <li id="ticket-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#ticket" type="button" role="tab" aria-controls="ticket" aria-selected="true">
                            Permission utilisateur
                        </button>
                    </li>
                    <li id="details-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">
                            Permission Dossier
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="ticket" class="tab-pane active" role="tabpanel" aria-labelledby="ticket-tab">
                <div class="box flex p-5 mt-5">
                    <input type="text" class="form-control py-3 px-4 w-full bg-slate-100 border-slate-200/60 pr-10" placeholder="Use coupon code...">
                    <button class="btn btn-primary ml-2">Apply</button>
                </div>
                <div class="box p-2 mt-5">
                    <div class="intro-y inbox box mt-5 ">
                        <div class="p-5 flex flex-col-reverse sm:flex-row text-slate-500 border-b border-slate-200/60">
                            <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-slate-200/60 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                                <input class="form-check-input" type="checkbox">
                            </div>
                            <div class="flex items-center sm:ml-auto">
                                <div class="">1 - 50 of 5,238</div>
                            </div>
                        </div>
                        <div class="overflow-x-auto sm:overflow-x-visible container">
                            @foreach ($gestion_permissions as $gestion_permission)
                            <div class="intro-y">
                                <div class="inbox__item{{ $gestion_permission->id ? ' inbox__item--active' : '' }} inline-block sm:block text-slate-600 dark:text-slate-500 bg-slate-100 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                                    <div class="flex px-5 py-3">
                                        <div class="w-72 flex-none flex items-center mr-5">
                                            <input class="form-check-input flex-none" type="checkbox">
                                            <div class="inbox__item--sender truncate ml-3">{{ $gestion_permission->nom_permission }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="flex mt-5">
                    <button class="btn btn-primary w-32 shadow-md ml-auto">Charge</button>
                </div>
            </div>
            <div id="details" class="tab-pane" role="tabpanel" aria-labelledby="details-tab">
                <div class="box flex p-5 mt-5">
                    <input type="text" class="form-control py-3 px-4 w-full bg-slate-100 border-slate-200/60 pr-10" placeholder="Use coupon code...">
                    <button class="btn btn-primary ml-2">Apply</button>
                </div>

                <div class="box p-2 mt-5">
                    <div class="intro-y inbox box mt-5 ">
                        <div class="p-5 flex flex-col-reverse sm:flex-row text-slate-500 border-b border-slate-200/60">
                            <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-slate-200/60 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                                <input class="form-check-input" type="checkbox">
                            </div>
                            <div class="flex items-center sm:ml-auto">
                                <div class="">1 - 50 of 5,238</div>
                            </div>
                        </div>
                        <div class="overflow-x-auto sm:overflow-x-visible container">
                            @foreach ($gestion_permissions as $gestion_permissions)
                            <div class="intro-y">
                                <div class="inbox__item{{ $gestion_permissions->id ? ' inbox__item--active' : '' }} inline-block sm:block text-slate-600 dark:text-slate-500 bg-slate-100 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                                    <div class="flex px-5 py-3">
                                        <div class="w-72 flex-none flex items-center mr-5">
                                            <input class="form-check-input flex-none" type="checkbox">
                                            <div class="inbox__item--sender truncate ml-3">{{ $gestion_permissions->nom_permission }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- END: Ticket -->
</div>
<!-- BEGIN: New Order Modal -->
<div id="new-order-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">New Order</h2>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label">Name</label>
                    <input id="pos-form-1" type="text" class="form-control flex-1" placeholder="Customer name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-2" class="form-label">Table</label>
                    <input id="pos-form-2" type="text" class="form-control flex-1" placeholder="Customer table">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Number of People</label>
                    <input id="pos-form-3" type="text" class="form-control flex-1" placeholder="People">
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                <button type="button" class="btn btn-primary w-32">Create Ticket</button>
            </div>
        </div>
    </div>
</div>
<!-- END: New Order Modal -->
<!-- BEGIN: Add Item Modal -->
<div id="add-item-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">{{ $fakers[0]['foods'][0]['name'] }}</h2>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-4" class="form-label">Quantity</label>
                    <div class="flex mt-2 flex-1">
                        <button type="button" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 mr-1">-</button>
                        <input id="pos-form-4" type="text" class="form-control w-24 text-center" placeholder="Item quantity" value="2">
                        <button type="button" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 ml-1">+</button>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="pos-form-5" class="form-label">Notes</label>
                    <textarea id="pos-form-5" class="form-control w-full mt-2" placeholder="Item notes"></textarea>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                <button type="button" class="btn btn-primary w-24">Add Item</button>
            </div>
        </div>
    </div>
</div>
<!-- END: Add Item Modal -->
@endsection
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function mot_pass() {
        var x = document.getElementById("mot_pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
</script>