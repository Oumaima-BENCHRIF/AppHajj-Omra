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
    .row {
        display: flex;
        flex-wrap: wrap;
    }
    .col-md-4 {
        flex: 0 0 33.33%;
        max-width: 33.33%;
        padding: 0 15px;
    }
    .form-check {
        margin-bottom: 10px;
    }
</style>
@section('subcontent')
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


<div class="tab-content mt-5">

    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">Information</h2>
            </div>
            <div class="p-5">
                <form id="create_user" name="create_user" action="{{ url('utilisateurs_Store') }}" method="post" >
                    {{ csrf_field() }}

                    <div class="validate-form flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 2xl:col-span-6">
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
                                </div>
                                <div class="col-span-12 2xl:col-span-6">
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
                                    <div class="input-form mt-3 @if ($errors->get('phone')) has-error @endif">
                                        <!-- <label for="adress" class="form-label">adress</label> -->
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row">
                                            telephone <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Ce champ est obligatoire</span>
                                        </label>
                                        <textarea id="phone" value="{{old('phone')}}" class="form-control @if ($errors->get('phone')) is-invalid @endif" placeholder="phone" name="phone" required></textarea>
                                        @if ($errors->get('phone'))
                                        @foreach ($errors->get('phone') as $message)
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

                                <div class="col-span-12 mt-3">
                                    <h2>Liste des permissions</h2>
                                    <div class="input-form mt-3 @if ($errors->get('permission')) has-error @endif">
                                <div class="row ">
                                  @php $i = 0; @endphp
                                  @foreach ($permissions as $permission)
                                 <div class="col-md-4">
                                <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission-{{ $permission->id }}">
                                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                                       {{ $permission->description }}
                                       </label>
                              </div>
                             </div>
                               @php $i++; @endphp
                               @if ($i % 3 == 0)
                               </div><div class="row">
                              @endif
                             @endforeach
                             </div>
                              </div>    </div>
                                </div>
                            <button type="submit" class="btn btn-primary w-20 mt-3">Envoyer</button>
                        </div>
                </form>
             

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

</div>
</div>
@endsection
@section('jqscripts')
<script type="text/javascript" src="{{URL::asset('js/Gestion_utilisateur.js')}}"></script>
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
@endsection