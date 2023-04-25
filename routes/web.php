<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\hotel_transportsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function () {
  Route::get('login', 'loginView')->name('login.index');
  Route::post('login', 'login')->name('login.check');
});

Route::middleware('auth')->group(function () {
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');
  Route::controller(PageController::class)->group(function () {
    Route::get('/', 'dashboardOverview1')->name('dashboard-overview-1');


    // hotel_transports
    // Route::get('/hotel_transports','App\Http\Controllers\hotel_transportsController@wizardLayout1')->name('hotel_transports.index');

    Route::get('/test', function () {
      return view('test');;
    });
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('Dashboard.index')->middleware('checkPermission:Consult_Dashboard');

    //gestion hotel transports


    Route::get('/hotel_transports_liste', 'App\Http\Controllers\hotel_transportsController@liste')->name('hotel_transports.create');
    Route::get('/hotel_transports', 'App\Http\Controllers\hotel_transportsController@index')->name('hotel_transports.index')->middleware('checkPermission:G.hotelTransports');
    // Route::get('/hotel_transportsCreate', 'App\Http\Controllers\hotel_transportsController@create')->name('hotel_transports.create');
    Route::post('hotel_transportsStore', 'App\Http\Controllers\hotel_transportsController@store')->name('hotel_transports.store');
    Route::post('hotel_transportsEdit', 'App\Http\Controllers\hotel_transportsController@update')->name('hotel_transports.edit');
    Route::post('hotel_transportsUpdate', 'App\Http\Controllers\hotel_transportsController@update')->name('hotel_transports.update');
    Route::get('hotel_transportsinfos/{id}', 'App\Http\Controllers\hotel_transportsController@infos')->name('hotel_transports.infos');
    Route::post('hotel_transportsDelete', 'App\Http\Controllers\hotel_transportsController@destroy')->name('hotel_transports.delete');
    Route::get('/liste_hotel_transports', 'App\Http\Controllers\hotel_transportsController@index')->name('liste_hotel_transports.index');
    //gestion Accompagnateurs

    Route::get('/Accompagnateurs', 'App\Http\Controllers\AccompagnateursController@index')->name('Accompagnateurs.index')->middleware('checkPermission:G.Accompagnateurs');
    Route::get('/Accompagnateurs_Liste', 'App\Http\Controllers\AccompagnateursController@Accompagnateurs_Liste')->name('Accompagnateurs.Accompagnateurs_Liste');
    Route::get('/Accompagnateurs_infos/{id}', 'App\Http\Controllers\AccompagnateursController@infos')->name('Accompagnateurs.infos');
    Route::post('/Accompagnateurs_edit', 'App\Http\Controllers\AccompagnateursController@update')->name('Accompagnateurs.edit');
    Route::post('/Accompagnateurs_update', 'App\Http\Controllers\AccompagnateursController@update')->name('Accompagnateurs.update');
    Route::post('/Accompagnateurs_delete', 'App\Http\Controllers\AccompagnateursController@destroy')->name('Accompagnateurs.delete');
    Route::post('Accompagnateurs_Stores', 'App\Http\Controllers\AccompagnateursController@store')->name('Accompagnateurs.store');
    Route::get('/liste_Accompagnateurs', 'App\Http\Controllers\AccompagnateursController@liste_Accompagnateurs')->name('liste_Accompagnateurs.index');

    // 
    //gestion Agents

    Route::get('/Agents', 'App\Http\Controllers\AgentsController@index')->name('Agents.index')->middleware('checkPermission:G.Agents');
    Route::get('/Agents_Liste', 'App\Http\Controllers\AgentsController@Agents_Liste')->name('Agents.Agents_Liste');
    Route::post('/Agents_Store', 'App\Http\Controllers\AgentsController@store')->name('Agents.store');
    Route::post('Agents_Edit', 'App\Http\Controllers\AgentsController@update')->name('Agents.edit');
    Route::post('Agents_Update', 'App\Http\Controllers\AgentsController@update')->name('Agents.update');
    Route::get('Agents_infos/{id}', 'App\Http\Controllers\AgentsController@infos')->name('Agents.infos');
    Route::post('Agents_Delete', 'App\Http\Controllers\AgentsController@destroy')->name('Agents.delete');
    Route::get('/liste_Agents', 'App\Http\Controllers\AgentsController@liste_Compagnies')->name('liste_Agents.index');

    // 
    //gestion Compagnies

    Route::get('/Compagnies', 'App\Http\Controllers\CompagniesController@index')->name('Compagnies.index')->middleware('checkPermission:G.Compagnies');
    Route::get('/Compagnies_Create', 'App\Http\Controllers\CompagniesController@create')->name('Compagnies.create');
    Route::post('/Compagnies_Store', 'App\Http\Controllers\CompagniesController@store')->name('Compagnies.store');
    Route::post('/Compagnies_Edit', 'App\Http\Controllers\CompagniesController@update')->name('Compagnies.edit');
    Route::post('/Compagnies_Update', 'App\Http\Controllers\CompagniesController@update')->name('Compagnies.update');
    Route::post('/Compagnies_infos', 'App\Http\Controllers\CompagniesController@infos')->name('Compagnies.infos');
    Route::post('/Compagnies_Delete', 'App\Http\Controllers\CompagniesController@destroy')->name('Compagnies.delete');
    Route::get('/liste_Compagnies', 'App\Http\Controllers\CompagniesController@liste_Compagnies')->name('liste_Agents.index');
    Route::get('/infos_Compagnie/{id}', 'App\Http\Controllers\CompagniesController@infosCompagnie')->name('infosCompagnie');


   // gestion_facturation
   Route::GET('/facturation/{id}', 'App\Http\Controllers\FactureController@index')->name('facturation.index');
   Route::GET('/generate/{id}','App\Http\Controllers\FactureController@print')->name('generate.print');
   Route::get('/facturation_List', 'App\Http\Controllers\FactureController@Liste_facture')->name('facturation.list');
 
   Route::post('facturation_store', 'App\Http\Controllers\FactureController@store')->name('facturation.store');
    //gestion gestion_fiche_client

    Route::get('/fiche_client', 'App\Http\Controllers\Fiche_clientsController@index')->name('fiche_client.index')->middleware('checkPermission:G.ClientAgente');
    Route::get('/fiche_clients_list', 'App\Http\Controllers\Fiche_clientsController@liste_Fiche_client')->name('fiche_client.liste');
    Route::post('fiche_clients_Store', 'App\Http\Controllers\Fiche_clientsController@store')->name('fiche_client.store');
    Route::post('fiche_clients_Edit', 'App\Http\Controllers\Fiche_clientsController@update')->name('fiche_client.edit');
    Route::post('fiche_clients_Update', 'App\Http\Controllers\Fiche_clientsController@update')->name('fiche_client.update');
    Route::get('fiche_clients_infos/{id}', 'App\Http\Controllers\Fiche_clientsController@infos')->name('fiche_client.infos');
    Route::post('fiche_clients_Delete', 'App\Http\Controllers\Fiche_clientsController@destroy')->name('fiche_client.delete');
    Route::get('/rech_fiche_client', 'App\Http\Controllers\Fiche_clientsController@rechercher_fiche')->name('fiche_client.rech');

    // 
    //gestion gestion_fiche_client

    Route::get('/To', 'App\Http\Controllers\TosController@index')->name('To.index')->middleware('checkPermission:G.To');

    Route::get('/To_Liste', 'App\Http\Controllers\TosController@liste')->name('To.create');
    Route::post('To_Store', 'App\Http\Controllers\TosController@store')->name('To.store');
    Route::post('To_Edit', 'App\Http\Controllers\TosController@update')->name('To.edit');
    Route::post('To_Update', 'App\Http\Controllers\TosController@update')->name('To.update');
    Route::post('To_infos', 'App\Http\Controllers\TosController@infos')->name('To.infos');
    Route::post('To_Delete', 'App\Http\Controllers\TosController@destroy')->name('To.delete');
    Route::get('Info_To/{id}', 'App\Http\Controllers\TosController@info_To')->name('info_To.infos');


    //gestion gestion_Utilisateur

    Route::get('/gestion_Utilisateur', 'App\Http\Controllers\Gestion_UtilisateursController@index')->name('utilisateurs.index')->middleware('checkPermission:AjouterUtilisateurs');
    Route::get('/gestion_Utilisateur_Create', 'App\Http\Controllers\Gestion_UtilisateursController@create')->name('utilisateurs.create');
    Route::post('utilisateurs_Store', 'App\Http\Controllers\Gestion_UtilisateursController@store')->name('utilisateurs.store');
    Route::post('gestion_Utilisateur_Edit', 'App\Http\Controllers\Gestion_UtilisateursController@update')->name('utilisateurs.edit');
    Route::post('gestion_Utilisateur_Update', 'App\Http\Controllers\Gestion_UtilisateursController@update')->name('utilisateurs.update');
    Route::post('gestion_Utilisateur_infos', 'App\Http\Controllers\Gestion_UtilisateursController@infos')->name('utilisateurs.infos');
    Route::post('gestion_Utilisateur_Delete', 'App\Http\Controllers\Gestion_UtilisateursController@destroy')->name('utilisateurs.delete');
    Route::get('gestion_Utilisateur_all', 'App\Http\Controllers\Gestion_UtilisateursController@all')->name('utilisateurs.all');
    Route::get('utilisateurs_view/{id}/show', 'App\Http\Controllers\Gestion_UtilisateursController@view')->name('utilisateurs.view');

    // test
    Route::get('/gestion_Utilisateurup', 'App\Http\Controllers\Gestion_UtilisateursController@upd')->name('utilisateurs.upd');


    // gestion dossier
    Route::get('/gestion_dossier', 'App\Http\Controllers\Gestion_DossierController@index')->name('gestion_dossier.index')->middleware('checkPermission:GestionDossier');;
    Route::post('gestion_dossier_Store', 'App\Http\Controllers\Gestion_DossierController@store')->name('gestion_dossier.store');
    Route::get('/liste_gestion_dossier', 'App\Http\Controllers\Gestion_DossierController@liste_gestion_dossier');
    Route::get('gestion_dossier_infos/{id}', 'App\Http\Controllers\Gestion_DossierController@info_update_dossier')->name('gestion_dossier.upinfos');
    Route::post('gestion_dossier_Update', 'App\Http\Controllers\Gestion_DossierController@update')->name('gestion_dossier.update');
    Route::post('gestion_dossier_Delete', 'App\Http\Controllers\Gestion_DossierController@destroy')->name('gestion_dossier.delete');

    Route::get('/rech_dossier', 'App\Http\Controllers\Gestion_DossierController@recherche_dossier')->name('gestion_dossier.recherche_dossier');

    // prog lier dossier
    Route::get('liste_pro_data/{id}', 'App\Http\Controllers\GestionProgrammesController@liste_pro_data')->name('test.test');
    Route::get('liste_prog/{id}', 'App\Http\Controllers\GestionProgrammesController@index');
    Route::get('liste_prog', 'App\Http\Controllers\GestionProgrammesController@index')->name('Liste_prg.liste');
    Route::get('info_prog/{id}', 'App\Http\Controllers\GestionProgrammesController@info_prog')->name('prg.upinfos');
    Route::post('prg_Delete', 'App\Http\Controllers\GestionProgrammesController@destroy')->name('prg.delete');
    Route::post('prg_Update', 'App\Http\Controllers\GestionProgrammesController@update')->name('prg.update');
    Route::get('liste_G_itineraires', 'App\Http\Controllers\GestionProgrammesController@liste_itineraires')->name('prg.itineraires');

    // gestion allot
    Route::get('/gestion_programme', 'App\Http\Controllers\GestionAllotementsController@index')->name('gestion_programme.index');
    Route::get('/gestion_programme_Create', 'App\Http\Controllers\GestionAllotementsController@create')->name('gestion_programme.create');
    Route::post('gestion_programme_Edit', 'App\Http\Controllers\GestionAllotementsController@update')->name('gestion_programme.edit');
    Route::post('gestion_programme_Update', 'App\Http\Controllers\GestionAllotementsController@update')->name('gestion_programme.update');
    Route::post('gestion_programme_infos', 'App\Http\Controllers\GestionAllotementsController@infos')->name('gestion_programme.infos');
    Route::post('gestion_programme_Delete', 'App\Http\Controllers\GestionAllotementsController@destroy')->name('gestion_programme.delete');
    Route::get('/programmes_dossier/{id}', 'App\Http\Controllers\GestionAllotementsController@index')->name('programmes_dossier.index');
    // **************************************
    Route::get('/programmes_info/{id}', 'App\Http\Controllers\GestionAllotementsController@programmes_info');
    Route::get('/Allotement_id/{id}', 'App\Http\Controllers\Gestion_AllotementController@Allotement_id');
    Route::get('liste_Allotement_id/{id}', 'App\Http\Controllers\Gestion_AllotementController@liste_gestion_allot')->name('Allotement.select');

    // -------------------->info prg <--------------------
    Route::get('/gestion_programme/{id}', 'App\Http\Controllers\GestionAllotementsController@index');

    // Gestion Programme
    Route::post('Programme_Update', 'App\Http\Controllers\Gestion_ProgrammeController@update_Programme')->name('Programme.update');
    Route::post('Programme_Delete', 'App\Http\Controllers\Gestion_ProgrammeController@destroy_Programme')->name('Programme.delete');
    Route::post('Programme_Store', 'App\Http\Controllers\Gestion_ProgrammeController@store_Programme')->name('Programme.store');
    Route::get('Programme_index', 'App\Http\Controllers\Gestion_ProgrammeController@index_Programme')->name('Programme.index');
    Route::get('Programme_infos/{id}/{FKdossier}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_Programme')->name('Programme.infos');
    Route::get('Programme_info/{id}/{FKdossier}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_Programme')->name('Programme.infos');

    Route::get('liste_programme/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@liste_gestion_programmes')->name('programe.select');

    // Gestion hotel prog
    Route::post('hotel_Update', 'App\Http\Controllers\Gestion_ProgrammeController@update_hotel')->name('hotel.update');
    Route::post('hotel_Stores', 'App\Http\Controllers\Gestion_ProgrammeController@store_hotels')->name('hotel.store');
    Route::get('liste_hotel_prg', 'App\Http\Controllers\Gestion_ProgrammeController@index_hotel_prg')->name('hotel.index');
    Route::get('hotel_prg_infos/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_Hotel')->name('hotel.infos');
    Route::post('hotel_Delete', 'App\Http\Controllers\Gestion_ProgrammeController@destroy_hotel')->name('hotel.delete');
    Route::get('hotel_infos_Delet/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_hotel');
    // Route::get('infos_hotel_prog/{id}/{FKdossier}/{ref_prg}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_hotel_prog')->name('hotel.info');
    Route::get('infos_hotel_prog/{id}/{FKdossier}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_hotel_prog')->name('hotel.info');

    // Itineraire
    Route::post('Itineraire_Stores', 'App\Http\Controllers\Gestion_ProgrammeController@store_Itinerair')->name('Itinerair.store');
    Route::get('liste_Itineraire', 'App\Http\Controllers\Gestion_ProgrammeController@index_Itinerair')->name('Itinerair.index');
    Route::post('Itineraire_Update', 'App\Http\Controllers\Gestion_ProgrammeController@update_Itinerair')->name('itinerair.update');
    Route::post('Itineraire_Delete', 'App\Http\Controllers\Gestion_ProgrammeController@destroy_Itineraire')->name('itinerair.delete');
    Route::get('Itineraire_infos/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_Itineraire')->name('Itineraire.infos');
    Route::get('update_info_itineraire/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@up_info_itineraire')->name('Itineraire.Upinfos');

    // liste hotel & transport 
    Route::get('liste_hotel_transport', 'App\Http\Controllers\Gestion_ProgrammeController@liste_hotel_transport')->name('Hoteltransport.infos');
    Route::get('liste_hotel_transport/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@Hotel_transports')->name('Hotel_transports.infos');

    // Gestion service
    Route::post('Service_Stores', 'App\Http\Controllers\Gestion_ProgrammeController@Service_Stores')->name('Service.store');
    Route::get('Service_Stores/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@infos_service')->name('Service.infos');
    Route::get('update_info_service/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@up_info_service')->name('Service.Upinfos');
    Route::post('Service_Delete', 'App\Http\Controllers\Gestion_ProgrammeController@destroy_service')->name('Service.delete');
    Route::post('sercice_Update', 'App\Http\Controllers\Gestion_ProgrammeController@update_service')->name('Service.update');

    // type progremme
    Route::get('type_prg', 'App\Http\Controllers\Gestion_ProgrammeController@index_type_prg')->name('index.type_prog');

    // Gestion fiche inscription
    Route::get('Fiche_inscription', 'App\Http\Controllers\GestionFichesInscriptionController@index')->name('ficheInscip.index')->middleware('checkPermission:G.fichesInscription');;
    Route::post('Fiche_inscription_store', 'App\Http\Controllers\GestionFichesInscriptionController@store')->name('ficheInscip.store');
    Route::get('info_prg', 'App\Http\Controllers\GestionFichesInscriptionController@info_prg')->name('prg.info');
    Route::get('info_Fiche_inscription/id_prg/{id_prg}/id_hotel/{id_detail_hotel}', 'App\Http\Controllers\GestionFichesInscriptionController@info_fiche_insc')->name('ficheInscip.info');
    Route::get('type_visa', 'App\Http\Controllers\GestionFichesInscriptionController@type_visa')->name('type_visa.info');
    Route::get('info_GFiche_Insc/{id}', 'App\Http\Controllers\GestionFichesInscriptionController@info_GFiche_Insc');

    Route::get('Fiche_inscription/Dossier_id/{id_dossier}/Programe_id/{id_prg}/Detail_hotel/{id_hotel}', 'App\Http\Controllers\GestionFichesInscriptionController@index');
    Route::get('information_client/{Fk_fiche}', 'App\Http\Controllers\GestionFichesInscriptionController@information_client')->name('ficheInscip.info');
    Route::get('Detail_Fiche_Insc/id_fiche/{Fk_fiche}/id_prg/{id_prg}/id_hotel/{id_hotel}', 'App\Http\Controllers\GestionFichesInscriptionController@Detail_Fiche_Insc')->name('ficheInscip.info');

    Route::get('Trajet_Dossier/Dossier/{id_dossier}/programme/{id_prg}/Hotel/{id_detail_hotel}', 'App\Http\Controllers\GestionFichesInscriptionController@Trajet_Dossier')->name('Trajet_Dossier');
    Route::post('FichesInscriptionDelete', 'App\Http\Controllers\GestionFichesInscriptionController@destroy')->name('FichesInscription.delete');
    Route::post('FichesInscriptionUpdate', 'App\Http\Controllers\GestionFichesInscriptionController@update')->name('FichesInscription.update');


    Route::post('categorie_store', 'App\Http\Controllers\GestionFichesInscriptionController@store_categorie')->name('categorie.store');
    Route::get('categorie_info', 'App\Http\Controllers\GestionFichesInscriptionController@info_categorie')->name('categorie.info');
    Route::get('categorie_info/{id}', 'App\Http\Controllers\GestionFichesInscriptionController@search_categorie');
    Route::get('societe_info', 'App\Http\Controllers\GestionFichesInscriptionController@search_societe')->name('societe.info');
    Route::get('societe_info/{id}', 'App\Http\Controllers\GestionFichesInscriptionController@search_societe_info');
    Route::get('type_chambre_info', 'App\Http\Controllers\GestionFichesInscriptionController@type_chambre')->name('chambre.info');
    Route::get('accom_info', 'App\Http\Controllers\GestionFichesInscriptionController@accompagnateur_info')->name('accompagnateur.info');

    Route::post('Fiche_inscription_Delete', 'App\Http\Controllers\GestionFichesInscriptionController@destroy_service')->name('ficheInscip.delete');
    Route::post('Fiche_inscription_Update', 'App\Http\Controllers\GestionFichesInscriptionController@update_service')->name('ficheInscip.update');
    Route::get('liste_fiche_inscription/{id}', 'App\Http\Controllers\GestionFichesInscriptionController@info_inscription')->name('ficheInscip.info');

    // inscription
    Route::post('inscription_Store', 'App\Http\Controllers\GestionFichesInscriptionController@inscription_Store')->name('inscription.store');
    // update data in prg
    Route::post('/updat_prg_chamb/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@updat_prg_chamb');

    // G alottement
    // Route::get('Allotement', 'App\Http\Controllers\Gestion_AllotementController@index')->name('allotements.index');
    Route::get('Allotement/{id}', 'App\Http\Controllers\Gestion_AllotementController@index');
    Route::get('liste_nv_allotement/{id}', 'App\Http\Controllers\Gestion_AllotementController@select_liste_allotemet')->name('allotement.select');
    Route::post('vole_depart_Store', 'App\Http\Controllers\Gestion_AllotementController@store_vole_depart')->name('vole_depart.store');
    Route::get('vole_depart_index', 'App\Http\Controllers\Gestion_AllotementController@indexVoledeapart')->name('vole_depart.index');
    Route::get('compagnie_index', 'App\Http\Controllers\Gestion_AllotementController@indexcompagnie')->name('compagnie.index');
    Route::get('vole_depart_specifi/{id}', 'App\Http\Controllers\Gestion_AllotementController@specifiVoledeapart')->name('vole_depart.specifi');
    Route::post('vole_retour_Store', 'App\Http\Controllers\Gestion_AllotementController@store_vole_retour')->name('vole_retour.store');
    Route::get('vole_retour_index', 'App\Http\Controllers\Gestion_AllotementController@indexVoleRetour')->name('vole_retour.index');
    Route::get('vole_retour_specifi/{id}', 'App\Http\Controllers\Gestion_AllotementController@specifiVoleretour')->name('vole_retour.specifi');
    Route::get('vole_retour_allotement/{id}', 'App\Http\Controllers\Gestion_AllotementController@infosVoleRetourAllot')->name('vole_retour.info');
    Route::post('/gestion_programme_Store', 'App\Http\Controllers\Gestion_AllotementController@store')->name('gestion_programme.store');

    // Route::get('allotement_Delet/{id}', 'App\Http\Controllers\Gestion_AllotementController@allotement_depart')->name('allot.delete');

    // vole retour
    Route::post('vole_retour_Update', 'App\Http\Controllers\Gestion_AllotementController@update_vole_retour')->name('vole_retour.update');
    Route::get('vole_retour_infos/{id}', 'App\Http\Controllers\Gestion_AllotementController@infos_vole_retour')->name('vole_retour.infos');
    Route::get('vole_retour_infos_Delet/{id}', 'App\Http\Controllers\Gestion_AllotementController@infos_vole_retour');
    Route::post('vole_retour_Delete', 'App\Http\Controllers\Gestion_AllotementController@destroy_vole_retour')->name('vole_retour.delete');
    // vole depat
    Route::post('vole_depart_Edit', 'App\Http\Controllers\Gestion_AllotementController@update_vole_depart')->name('vole_depart.edit');
    Route::post('vole_depart_Update', 'App\Http\Controllers\Gestion_AllotementController@update_vole_depart')->name('vole_depart.update');
    Route::get('vole_depart_infos/{id}', 'App\Http\Controllers\Gestion_AllotementController@infos_vole_depart');
    Route::post('vole_depart_Delete', 'App\Http\Controllers\Gestion_AllotementController@destroy_vole_depart')->name('vole_depart.delete');
    Route::get('vole_depart_infos_Delet/{id}', 'App\Http\Controllers\Gestion_AllotementController@infos_vole_depart');
    Route::get('vole_depart_allotement/{id}', 'App\Http\Controllers\Gestion_AllotementController@infosVoleDepartAllot')->name('vole_depart.info');
    // Gestion allotement
    Route::post('allotement_Update', 'App\Http\Controllers\Gestion_AllotementController@update_allotement')->name('allotement.update');
    Route::get('allotement_infos/{id}', 'App\Http\Controllers\Gestion_AllotementController@infos_allotement')->name('allotement.infos');
    Route::post('allotement_Delete', 'App\Http\Controllers\Gestion_AllotementController@destroy_allotement')->name('allotement.delete');
    Route::post('allotement_Store', 'App\Http\Controllers\Gestion_AllotementController@store_allotement')->name('allotement.store');
    Route::get('allotement_index', 'App\Http\Controllers\Gestion_AllotementController@indexallotement')->name('allotement.index');
    Route::get('liste_prg_FKdossier/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@liste_prg_FKdossier')->name('FK_dossier_prg.select');
    // G reservation
    Route::get('Reservation/{id_dossier}/{id_prg}', 'App\Http\Controllers\Gestion_reservation@index')->name('reservation.index');
    Route::get('Liste_Reservation/{id_dossier}/{id_prg}', 'App\Http\Controllers\Gestion_reservation@Liste_Reservation')->name('reservation.liste');
    Route::post('Add_gender_prg_hotel/{id}', 'App\Http\Controllers\Gestion_reservation@Add_gender');

    Route::post('update_type_chambre/{id}', 'App\Http\Controllers\Gestion_ProgrammeController@update_type_chambre');
    // *****************************************
    // Gestion état par Hôtel
    Route::get('gestion_Etat/', 'App\Http\Controllers\Gestion_reservation@index')->name('Etat_hotel.index');

    Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
    Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
    Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
    Route::get('categories-page', 'categories')->name('categories');
    Route::get('add-product-page', 'addProduct')->name('add-product');
    Route::get('product-list-page', 'productList')->name('product-list');
    Route::get('product-grid-page', 'productGrid')->name('product-grid');
    Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
    Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
    Route::get('seller-list-page', 'sellerList')->name('seller-list');
    Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
    Route::get('reviews-page', 'reviews')->name('reviews');
    Route::get('inbox-page', 'inbox')->name('inbox');
    Route::get('file-manager-page', 'fileManager')->name('file-manager');
    Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
    Route::get('chat-page', 'chat')->name('chat');
    Route::get('post-page', 'post')->name('post');
    Route::get('calendar-page', 'calendar')->name('calendar');
    Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
    Route::get('crud-form-page', 'crudForm')->name('crud-form');
    Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
    Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
    Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
    Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
    Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
    Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
    Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
    Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
    Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
    Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
    Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
    Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
    Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
    Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
    Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
    Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
    Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
    Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
    Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
    Route::get('login-page', 'login')->name('login');
    Route::get('register-page', 'register')->name('register');
    Route::get('error-page-page', 'errorPage')->name('error-page');
    Route::get('update-profile-page', 'updateProfile')->name('update-profile');
    Route::get('change-password-page', 'changePassword')->name('change-password');
    Route::get('regular-table-page', 'regularTable')->name('regular-table');
    Route::get('tabulator-page', 'tabulator')->name('tabulator');
    Route::get('modal-page', 'modal')->name('modal');
    Route::get('slide-over-page', 'slideOver')->name('slide-over');
    Route::get('notification-page', 'notification')->name('notification');
    Route::get('tab-page', 'tab')->name('tab');
    Route::get('accordion-page', 'accordion')->name('accordion');
    Route::get('button-page', 'button')->name('button');
    Route::get('alert-page', 'alert')->name('alert');
    Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
    Route::get('tooltip-page', 'tooltip')->name('tooltip');
    Route::get('dropdown-page', 'dropdown')->name('dropdown');
    Route::get('typography-page', 'typography')->name('typography');
    Route::get('icon-page', 'icon')->name('icon');
    Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
    Route::get('regular-form-page', 'regularForm')->name('regular-form');
    Route::get('datepicker-page', 'datepicker')->name('datepicker');
    Route::get('tom-select-page', 'tomSelect')->name('tom-select');
    Route::get('file-upload-page', 'fileUpload')->name('file-upload');
    Route::get('wysiwyg-editor-classic', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
    Route::get('wysiwyg-editor-inline', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
    Route::get('wysiwyg-editor-balloon', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
    Route::get('wysiwyg-editor-balloon-block', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
    Route::get('wysiwyg-editor-document', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
    Route::get('validation-page', 'validation')->name('validation');
    Route::get('chart-page', 'chart')->name('chart');
    Route::get('slider-page', 'slider')->name('slider');
    Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
  });
});
