$(window).on("load", function () {});
$(document).ready(function () {

    liste_Jornal();
    liste_Sens();
    Liste_ModeP();
    liste_client();
    liste_factures();
});
function liste_Jornal() {
    jQuery.ajax({
        url: "/List_jornal",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            console.log("aa");
            $select_jornal = "";
           
            jQuery.each(responce.Liste_jornal, function (key, item) {
                $select_jornal =
                    $select_jornal +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.designation +
                    "</option>";
            });
            $("#jornal").html($select_jornal);
        
        },
    });
}
function liste_Sens() {
    jQuery.ajax({
        url: "/liste_Sens",
        type: "GET",
        dataType: "json",
        success: function (responce) {
     
            $select_sens = "";
           
            jQuery.each(responce.liste_Sens, function (key, item) {
                $select_sens =
                    $select_sens +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.designation +
                    "</option>";
            });
            $("#sens").html($select_sens);
        
        },
    });
}
function Liste_ModeP() {
    jQuery.ajax({
        url: "/liste_ModeP",
        type: "GET",
        dataType: "json",
        success: function (responce) {

            $select_mode = "";
           
            jQuery.each(responce.Liste_ModeP, function (key, item) {
                $select_mode =
                    $select_mode +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.designation +
                    "</option>";
            });
            $("#mode").html($select_mode);
        
        },
    });
}
function liste_client() {
    jQuery.ajax({
        url: "/liste_client",
        type: "GET",
        dataType: "json",
        success: function (responce) {
     
            $select_client = "";
           
            jQuery.each(responce.Liste_client, function (key, item) {
                $select_client =
                    $select_client +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nom +
                    "</option>";
            });
            $("#client").html($select_client);
        
        },
    });
}
function liste_factures() {
    jQuery.ajax({
        url: "/facturation_List",
        type: "GET",
        dataType: "json",
        success: function (responce) {
     
            $select_factures = "";
           
            jQuery.each(responce.Liste_Facture, function (key, item) {
                $select_factures =
                    $select_factures +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.numero_facture +
                    "</option>";
            });
            $("#factures").html($select_factures);
        
        },
    });
}