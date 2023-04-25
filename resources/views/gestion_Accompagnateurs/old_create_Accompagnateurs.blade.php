@extends('../layout/' . $layout)

@section('subhead')
    <title>Gestion Accompagnateurs</title>
@endsection

@section('subcontent')
    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">gestion Accompagnateurs</h2>
    </div>
    <!-- BEGIN: gestion Accompagnateurs -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="flex justify-center">
            <button title="gestion Accompagnateurs" class="intro-y w-10 h-10 rounded-full btn btn-primary mx-2">1</button>
            <!-- <button class="intro-y w-10 h-10 rounded-full btn bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400 text-slate-500 mx-2" type="submit" href="{{ url('test') }}">2</button> -->
            <a title="listes Accompagnateurs" class="intro-y w-10 h-10 rounded-full btn bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400 text-slate-500 mx-2" href="{{ url('liste_Accompagnateurs') }}">2</a>
        </div>
        <div class="px-5 mt-10">
            <div class="font-medium text-center text-lg">gestion Accompagnateurs</div>
        </div>
          <form action="{{  route('Accompagnateurs.store')  }}" method="post">
                        {{ csrf_field() }}
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
           
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="code" class="form-label">Code</label>
                    <input id="code" type="text" class="form-control" placeholder="code" name="code">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="nom_prenom" class="form-label">Nom prenom</label>
                    <input id="nom_prenom" name="nom_prenom" type="text" class="form-control" placeholder="nom_prenom">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="adresse" class="form-label">adresse</label>
                    <input id="adresse" name="adresse" type="text" class="form-control" placeholder="adresse">
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="prix" class="form-label">prix</label>
                    <input id="prix" name="prix" type="text" class="form-control" placeholder="prix">
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
                    <a class="btn btn-secondary w-24" href="{{ url('liste_Accompagnateurs') }}">Liste</a>
                    <button type="Submit" class="btn btn-primary w-24 ml-2">Envoyer</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- END: gestion Accompagnateurs -->
@endsection
