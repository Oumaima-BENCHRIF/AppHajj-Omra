@extends('../layout/' . $layout)

@section('subhead')
<title>Gestion Fiche d'inscription</title>
@endsection

@section('subcontent')

<!-- ---------------Style -->
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/tabulator.css')}}">

<nav id="nav_liste" aria-label="breadcrumb" class="my-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a id="Dossier" href="#">Dossier</a></li>
        <li class="breadcrumb-item active" id="" aria-current="page">
            <span id="nom_dossies"></span>
        </li>
        <li class="breadcrumb-item"><a id="programme" href="#">Programme</a></li>

        <li class="breadcrumb-item active" aria-current="page">
            <span id="nom_prgramme"></span>
        </li>
        <li class="breadcrumb-item"><a id="hotel" href="#">Hotel</a></li>

        <li class="breadcrumb-item active" aria-current="page">
            <span id="nom_Hotel"></span>
        </li>
    </ol>
</nav>

<?php
$url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $url);

if (isset($url_parts[3])) {
    $id_dossier = $url_parts[3];
} else {
    echo '<script>document.getElementById("nav_liste").style.display = "none";</script>';
    $id_dossier = null;
}

if (isset($url_parts[5])) {
    $id_prg = $url_parts[5];
} else {
    $id_prg = null;
}

if (isset($url_parts[7])) {
    $id_detail_hotel = $url_parts[7];
} else {
    $id_detail_hotel = null;
}

if ($id_dossier && $id_prg) {
    $url = url('Reservation/' . $id_dossier . '/' . $id_prg);
} else {
    $url = null;
}


?>

<div class="intro-y box col-span-12 px-5 pt-5 mt-5 bettwin style-pad" style="background-color:#D6E8EE;">

    <div class="w-full items-center pr-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-900">
        <div class="flex">

            <a href="{{ url('Reservation/'.$id_dossier.'/'.$id_prg)??'' }}" class="mr-5 tooltip btn btn-primary w-1/2 sm:w-auto mr-10" style="border-radius:20px; background-color:#015C92;" title="Retour a la page précédent!">
                <span class="w-5 h-5 flex items-center mt-1 justify-center">
                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="arrow-left" data-lucide="arrow-left" class="lucide lucide-arrow-left block mx-auto">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </div>
                </span>
            </a>

            <div class="font-medium py-2 px-5  btn-G text-center text-lg ">
                <div class="mt-2 xl:mt-0">

                    <h3 class="intro-y text-lg font-medium mr-auto">Gestion Fiche d'inscription</h3>

                </div>
            </div>
        </div>
    </div>


    <!-- BEGIN: Profile Info -->
    <form id="form_gestion_fiche_insc" name="form_gestion_fiche_insc" action="{{ url('Fiche_inscription_store') }}" method="post">
        {{ csrf_field() }}
        <div class="intro-y">
            <div class="form-inline mt-2">
                <div class="flex flex-1   items-center justify-center lg:justify-start">
                    <div class="intro-y w4 px-1">
                        <input type="hidden" id="id_fiche" name="id_fiche">
                        <label for="num_fichier" class="form-label  mbt-2 text-size">N° Fiche</label>
                        <select id="num_fichier" name="num_fichier" class="form-control py-1">
                            <option value="">Sélectionnez</option>
                        </select>
                    </div>
                    <input type="hidden"  id="Num_Fich_insc" name="Num_Fich_insc">
                    <div class="intro-y w4 px-1">
                        <label for="date_fiche_inscription" class="form-label mbt-2 text-size">Date</label>
                        <input id="date_fiche_inscription" name="date_fiche_inscription" type="date" class="form-control py-1" required>
                    </div>

                    <div class="intro-y w4 px-1 ">
                        <label for="num_prg_inscription" class="form-label mbt-2 text-size mbt-2 text-size">N° programme</label>
                        <select id="num_prg_inscription" name="num_prg_inscription" data-search="true" class="form-control w-full py-1" required>
                        </select>
                    </div>

                    <div class="intro-y w4 px-1 ">
                        <label for="Nouveau_inscription" class="form-label mbt-2 text-size">Nouveau</label>
                        <button id="Nouveau_inscription" name="Nouveau_inscription" onclick="Nouveau_insc()" type="Submit" class="btn  w-full " style="background-color: #015C92  ; color: #ffffff; padding:0.5%">Nouveau</button>
                    </div>



                </div>
            </div>
            <!-- END: Profile Info -->

            <!--BEGIN:Informations société -->
            <div class="flex items-center px-5 py-5 sm:py-3 mt-5 border-b border-slate-200/60 dark:border-darkmode-900 bettwin">
                <h2 class="font-medium text-base mr-auto">Informations société</h2>
            </div>
            <div class="form-inline mt-2">

                <div class="intro-y w4 px-1 ">
                    <label for="code_societe" class="form-label mbt-2 text-size">Code société</label>
                    <select id="code_societe" name="code_societe" data-search="true" class="form-control py-1" required>
                    </select>
                </div>

                <div class="intro-y w4 px-1">
                    <label for="nom_societe" class="form-label mbt-2 text-size">Nom société</label>
                    <input id="nom_societe" name="nom_societe" type="text" class="form-control py-1" required>
                </div>

                <div class="intro-y w4 px-1">
                    <label for="bon_commande" class="form-label mbt-2 text-size">N°Bon commande</label>
                    <input id="bon_commande" name="bon_commande" type="number" min="0" class="form-control py-1" required>
                </div>
                <div class="intro-y w4 px-1">
                    <button type="Submit" class="btn w-full mt-6" style="background-color: #015C92  ; color: #ffffff; padding: 0.5%;">Ajouter</button>
                </div>
            </div>

    </form>


    <div class="tiny-slider" id="important-notes">
        <form id="Informations_clients" name="Informations_clients" action="{{ url('inscription_Store') }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <!-- **Begin:Informations client** -->
            <div class="flex items-center mt-5 px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-900 bettwin">
                <h2 class="font-medium text-base mr-auto">Informations client</h2>
            </div>
            <div class="form-inline">

                <div class="intro-y w78">
                    <div class="form-inline mt-2">
                        <div class="intro-y w4 px-1">
                            <label for="num_ligne" class="form-label mbt-2 text-size">N° ligne</label>
                            <input id="num_ligne" name="num_ligne" type="number" min="0" class="form-control py-1" placeholder="Entrer num ligne" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="nom_client" class="form-label mbt-2 text-size">Nom</label>
                            <input id="nom_client" name="nom_client" type="text" placeholder="Entrer le Nom" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="prenom_client" class="form-label mbt-2 text-size">Prénom</label>
                            <input id="prenom_client" name="prenom_client" type="text" placeholder="Entrer le Prénom" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="num_GSM" class="form-label mbt-2 text-size">GSM</label>
                            <input id="num_GSM" name="num_GSM" type="number" min="0" placeholder="Entrer GSM" class="form-control py-1" required>
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                        <div class="intro-y w4 px-1">
                            <label for="type_chambre_medina" class="form-label mbt-2 text-size">Type de chambre Medina</label>

                            <select id="type_chambre_medina" name="type_chambre_medina" data-placeholder="Sélectionnez Type de chambre" class="form-control py-1">
                            </select>
                        </div>
                        <div class="intro-y w4 px-1">
                            <label for="nom_arabe" class="form-label mbt-2 text-size">الاسم الشخصي</label>
                            <input id="nom_arabe" name="nom_arabe" type="text" dir="rtl" placeholder="الاسم الشخصي" class="form-control keyboardInput py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="prenom_arabe" class="form-label mbt-2 text-size">الاسم العائلي</label>
                            <input id="prenom_arabe" name="prenom_arabe" dir="rtl" type="text" placeholder="الاسم العائلي" class="form-control keyboardInput py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="num_CIN" class="form-label mbt-2 text-size">CIN °</label>
                            <input id="num_CIN" name="num_CIN" type="text" placeholder="Entrer CIN °" class="form-control py-1" required>
                        </div>
                    </div>
                    <div class="form-inline mt-2">

                        <div class="intro-y w4 px-1">
                            <label for="Email" class="form-label mbt-2 text-size">Email</label>
                            <input id="Email" name="Email" type="email" placeholder="Entrer l'email" class="form-control py-1" required>
                        </div>
                        <div class="intro-y w4 px-1">
                            <label for="chambre_medina" class="form-label mbt-2 text-size">Chambre Medina</label>
                            <select id="chambre_medina" name="chambre_medina" data-placeholder="Sélectionnez chambre" class="form-control py-1">
                            </select>

                        </div>
                        <div class="intro-y w4 px-1">
                            <label for="genre" class="form-label mbt-2 text-size">Genre</label>
                            <select id="genre" name="genre" data-placeholder="Sélectionnez le Genre" class="form-control py-1">
                                <option value="1">Femme</option>
                                <option value="2">Homme</option>
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="date_naissance" class="form-label mbt-2 text-size">Date de naissance</label>
                            <input id="date_naissance" name="date_naissance" type="date" class="form-control py-1" required>
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                        <div class="intro-y w4 px-1">
                            <label for="adresse" class="form-label mbt-2 text-size">Adresse</label>
                            <input id="adresse" name="adresse" type="text" placeholder="Entrer l'Adresse" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="num_Accompagnateur" class="form-label mbt-2 text-size">N° Accompagnateur</label>
                            <select id="num_Accompagnateur" name="num_Accompagnateur" data-placeholder="Sélectionnez Situation Accompagnateur" class="form-control py-1">

                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="type_chambre_makka" class="form-label mbt-2 text-size">Type de chambre Makka</label>
                            <select id="type_chambre_makka" name="type_chambre_makka" data-placeholder="Sélectionnez Type de chambre" class="form-control py-1">
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="date_expiration" class="form-label mbt-2 text-size">Date d'expiration</label>
                            <input id="date_expiration" name="date_expiration" type="date" class="form-control py-1" required>
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                        <div class="intro-y w4 px-1">
                            <label for="situation_familiale" class="form-label mbt-2 text-size">Situation familiale</label>
                            <select id="situation_familiale" name="situation_familiale" data-placeholder="Sélectionnez Situation familiale" class="form-control py-1">
                                <option value="1">Célibataire</option>
                                <option value="2">Marié</option>
                                <option value="3">Divorcé</option>
                                <option value="4">Veuf</option>
                                <option value="5">Autre</option>
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="telephone" class="form-label mbt-2 text-size">Téléphone</label>
                            <input id="telephone" name="telephone" type="number" min="0" placeholder="Entrer Téléphone" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="num_prg_inscription" class="form-label mbt-2 text-size">Inclus</label>
                            <div class="dropdown inline-block form-control py-1">
                                <select aria-expanded="false" data-tw-toggle="dropdown" class="form-control py-1">

                                    <option id="select_Inclus">Sélectionné</option>
                                </select>
                                <div class="overSelect"></div>

                                <div class="dropdown-menu">
                                    <div class="dropdown-content">
                                        <div class="p-2">
                                            <div class="mt-1">
                                                <div class="text-xs">Inclus</div>

                                                <div>
                                                    <input type="hidden" name="Billet" id="Billet">
                                                    <label for="Billet"><input class="mycheckboxs" type="checkbox" name="Billetcheq" value="Billet" id="Billetcheq" checked /> Billet </label>
                                                    <div class="grid gap-3 grid-cols-2">
                                                        <input type="number" min="0" name="Reduction_Billet" id="Reduction_Billet" placeholder="Réduction" class="form-control">
                                                        <input type="text" name="raison_billet" id="raison_billet" placeholder="Raison" class="form-control">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="Transport"><input class="mycheckboxs" type="checkbox" name="Transportcheq" value="Transport" id="Transportcheq" checked /> Transport</label>
                                                    <div class="grid gap-3 grid-cols-2">
                                                        <input type="hidden" name="Transport" id="Transport">
                                                        <input type="number" min="0" name="Reduction_Transport" id="Reduction_Transport" placeholder="Réduction" class="form-control">
                                                        <input type="text" name="raison_Transport" id="raison_Transport" placeholder="Raison" class="form-control">

                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="hotel_meedina"><input class="mycheckboxs" type="checkbox" name="hotel_meedinacheq" value="hotel meedina" id="hotel_meedinacheq" checked /> Hotel Meedina</label>
                                                    <div class="grid gap-3 grid-cols-2">
                                                        <input type="hidden" name="Hotel_Meedina" id="Hotel_Meedina">
                                                        <input type="number" min="0" name="Reduction_Hotel_Meedina" id="Reduction_Hotel_Meedina" placeholder="Réduction" class="form-control">
                                                        <input type="text" name="raison_hotel_medina" id="raison_hotel_medina" placeholder="Raison" class="form-control">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="hotel_makka"><input class="mycheckboxs" type="checkbox" name="hotel_makkacheq" value="hotel makka" id="hotel_makkacheq" checked /> Hotel Makka</label>
                                                    <div class="grid gap-3 grid-cols-2">
                                                        <input type="hidden" id="Hotel_Makka" name="Hotel_Makka">
                                                        <input type="number" min="0" name="Reduction_Hotel_Makka" id="Reduction_Hotel_Makka" placeholder="Réduction" class="form-control">
                                                        <input type="text" name="raison_hotel_makka" id="raison_hotel_makka" placeholder="Raison" class="form-control">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="Visa"><input class="mycheckboxs" type="checkbox" name="Visacheq" value="Visa" id="Visacheq" checked /> Visa</label>
                                                    <div class="grid gap-3 grid-cols-2">
                                                        <input type="hidden" name="Visa" id="Visa">
                                                        <input type="number" min="0" name="Reduction_Visa" id="Reduction_Visa" placeholder="Réduction" class="form-control">
                                                        <input type="text" name="raison_visa" id="raison_visa" placeholder="Raison" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center mt-3">
                                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Anuuler</button>
                                                <button onclick="showChecked()" class="btn btn-primary w-32 ml-2">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="chambre_makka" class="form-label mbt-2 text-size">Chambre Makka</label>
                            <select id="chambre_makka" name="chambre_makka" data-placeholder="Sélectionnez chambre" class="form-control py-1">
                            </select>

                        </div>

                    </div>
                    <div class="form-inline mt-2">
                  <div class="intro-y w4 px-1">
                        <label for="prix" class="form-label mbt-2 text-size">Prix vente programme</label>
                        <input id="prix" name="prix" type="number" min="0" placeholder="Entre Prix" class="form-control py-1" required>
                    </div>
                    <div class="intro-y w4  px-1">
                        <label for="remis" class="form-label mbt-2 text-size">Remis</label>
                        <input id="remis" name="remis" onblur="javascript:calculeRemis(document.getElementById('Totale_prg').value, document.getElementById('remis').value);" type="number" min="0" placeholder="Remis" class="form-control py-1" required>
                    </div>
                    <div class="intro-y w4 px-1">
                        <label for="Totale_prg" class="form-label mbt-2 text-size">Totale</label>
                        <input id="Totale_prg" name="Totale_prg" type="number" min="0" placeholder="Totale" class="form-control py-1" required>
                    </div>
                    <div class="intro-y w4 px-1">
                        <label for="num_bill" class="form-label mbt-2 text-size">Numero billet </label>
                        <input id="num_bill" name="num_bill" type="text" min="0" placeholder="numero billet" class="form-control py-1" required>
                    </div>
                </div>
                    <!-- **End:Informations client** -->
                </div>
                <div class="intro-y w22">
                    <div class="w-52 ">
                        <div class="border-2 mt-3 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img class="rounded-md" id="blah" alt="Sélectionnez votre image" data-action="zoom" class="w-full rounded-md" src="{{ asset('build/assets/images/update_img.jpg') }}">
                                <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="button" class="btn w-full" style="background-color: #015C92; color: #ffffff;">Change Photo</button>
                                <input accept="image/*" type='file' id="imgInp" name="imgInp" class="w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>
                   
                </div>
               
            </div>
            <!-- Begin: Informations passeport -->
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">Informations passeport</h2>
            </div>
            <div class="form-inline">

                <div class="intro-y w78">

                    <div class="form-inline mt-2">

                        <div class="intro-y w4 px-1">
                            <label for="num_passeport" class="form-label mbt-2 text-size">N° passeport</label>
                            <input id="num_passeport" name="num_passeport" type="text" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="date_obtention_visa" class="form-label mbt-2 text-size ">Date d'obtention Visa</label>
                            <input id="date_obtention_visa" name="date_obtention_visa" type="date" placeholder="Entrer le Nom" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="num_visa" class="form-label mbt-2 text-size">N° Visa</label>
                            <input id="num_visa" name="num_visa" type="number" min="0" placeholder="Entrer N° visa" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="date_delivrance" class="form-label form-label mbt-2 text-size">Date délivrance</label>
                            <input id="date_delivrance" name="date_delivrance" type="date" placeholder="Entrer Date délivrance" class="form-control py-1" required>
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                        <div class="intro-y w4 px-1">
                            <label for="etat_passeport" class="form-label mbt-2 text-size">Etat passeport</label>
                            <select id="etat_passeport" name="etat_passeport" data-placeholder="Sélectionnez Situation familiale" class="form-control py-1">
                                <option value="1">En Cours</option>
                                <option value="2">Au Consulat</option>
                                <option value="3">Visé</option>
                                <option value="4">Passe Remis</option>
                                <option value="5">Sans Visa</option>
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="Province" class="form-label mbt-2 text-size">Province</label>
                            <input id="Province" name="Province" type="text" placeholder="Entrer Province" class="form-control py-1" required>
                        </div>


                        <div class="intro-y w4 px-1">
                            <label for="date_expiration_visa" class="form-label mbt-2 text-size">Date d'expiration</label>
                            <input id="date_expiration_visa" name="date_expiration_visa" type="date" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="num_Accompagnateur" class="form-label mbt-2 text-size">N°Inscription(HAJ)</label>
                            <input id="Num_Inscription" name="Num_Inscription" type="text" placeholder="Entrer N°Inscription" class="form-control py-1" required>
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                        <div class="intro-y w4 px-1">
                            <label for="Type_visa" class="form-label mbt-2 text-size">Type de visa</label>
                            <select id="Type_visa" name="Type_visa" data-search="true" class="form-control py-1" required>
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="date_expiration" style="text-align: start; margin-right:0px;" class="form-label mbt-2 text-size">Lieu de délivrance(محل الاصدار)</label>
                            <input id="Lieu_delivrance" name="Lieu_delivrance" type="text" class="form-control py-1" required>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="num_agence" class="form-label mbt-2 text-size">Agence</label>
                            <select id="code_societe" name="num_agence" data-search="true" class="form-control py-1" required>
                            </select>
                        </div>

                        <div class="intro-y w4 px-1">
                            <label for="type_passport" class="form-label mbt-2 text-size">Type</label>
                            <input id="type_passport" name="type_passport" type="text" class="form-control py-1" required>
                        </div>


                    </div>
                </div>
                <div class="intro-y w22">
                    <div class="w-52">
                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img class="rounded-md" id="img_passp" alt="Sélectionnez votre image" data-action="zoom" class="w-full rounded-md" src="{{ asset('build/assets/images/update_img.jpg') }}">
                                <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-5">
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn w-full" style="background-color: #015C92; color: #ffffff;">
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                                <i data-lucide="image" class="block mx-auto"></i>
                                            </div>
                                        </button>
                                        <input type="file" accept="image/*" id="photo" name="photo" class="inp-file w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                                <div class="form-control col-span-5">
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn w-full btn-success" onClick="afficherinfo()" style="color: #ffffff;">
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                                <i data-lucide="thumbs-up" class="block mx-auto"></i>
                                            </div>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End: Informations passeport -->
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end  w-52 mx-auto ">
                <button type="Submit" class="btn  w-full" style="background-color: #015C92   ; color: #ffffff;">Ajouter</button>
                
            </div>

            <input type="hidden" id="parsed">
        </form>
    </div>
    <div class="overflow-x-auto scrollbar-hidden">
        <div id="liste_fiche_insc" class="mt-5 table-report--tabulator"></div>
    </div>
   
    <input type="hidden" id="id_fiche" name="id_fiche">

   
   
</div>
<div class="mt-5 form-inline justify-content-end">
<button id="facture"class="btn btn-primary mr-5"  >facturation</button>
<button id="reglement"class="btn btn-primary"  >reglement</button>
</div>

<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Êtes-vous sûr?</div>
                    <div class="text-slate-500 mt-2">Voulez-vous vraiment supprimer ces enregistrements ?<br>Ce processus ne peut pas être annulé.</div>
                </div>
                <form id="delet_Client" name="delet_Client" action="{{ route('FichesInscription.delete') }}" method="post">

                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Anuuler</button>
                        <input type="hidden" id="delete_id_client" name="delete_id_client">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger w-24">Supprimer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->

<!-- BEGIN: Update Confirmation Modal -->
<div id="update-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-success mx-auto mt-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    <div class="text-3xl mt-5">Êtes-vous sûr?</div>
                    <div class="text-slate-500 mt-2">Voulez-vous vraiment modifier ces enregistrements ?<br>Ce processus ne peut pas être annulé.</div>
                </div>
                <form id="up_Client" name="up_Client" action="{{ url('FichesInscriptionUpdate') }}" enctype="multipart/form-data" method="post">

                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn  text-white  btn-danger w-24 mr-1">Anuuler</button>
                        <input type="hidden" id="update_id_client" name="update_id_client">
                        {{ csrf_field() }}
                        <button type="submit" class="btn text-white btn-success w-24">Modifier</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- END: Update Confirmation Modal -->
<!--BEGIN: liste detail hotel -->

                                    
                                       
                                        <!-- BEGIN: Modal Content -->
                                        <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- BEGIN: Modal Header -->
                                                    <div class="modal-header">
                                                        <h2 class="font-medium text-base mr-auto">Broadcast Message</h2>
                                                        <button class="btn btn-outline-secondary hidden sm:flex">
                                                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs
                                                        </button>
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
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-1" class="form-label">From</label>
                                                            <input id="modal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-2" class="form-label">To</label>
                                                            <input id="modal-form-2" type="text" class="form-control" placeholder="example@gmail.com">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-3" class="form-label">Subject</label>
                                                            <input id="modal-form-3" type="text" class="form-control" placeholder="Important Meeting">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-4" class="form-label">Has the Words</label>
                                                            <input id="modal-form-4" type="text" class="form-control" placeholder="Job, Work, Documentation">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-5" class="form-label">Doesn't Have</label>
                                                            <input id="modal-form-5" type="text" class="form-control" placeholder="Job, Work, Documentation">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-6" class="form-label">Size</label>
                                                            <select id="modal-form-6" class="form-select">
                                                                <option>10</option>
                                                                <option>25</option>
                                                                <option>35</option>
                                                                <option>50</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- END: Modal Body -->
                                                    <!-- BEGIN: Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                                        <button type="button" class="btn btn-primary w-20">Send</button>
                                                    </div>
                                                    <!-- END: Modal Footer -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    
                                
<!--BEGIN: liste detail hotel -->

@endsection
@section('jqscripts')
<script type="text/javascript" src="{{URL::asset('js/Gestion_fiche_inscription.js')}}"></script>
<script>
 
</script>
@endsection