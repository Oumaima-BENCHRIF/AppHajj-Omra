$(window).on("load", function () {
    var v = window.location.href;
    var id_dossier = v.split("/")[5];
    var id_prg = v.split("/")[7];
    var id_detail_hotel = v.split("/")[9];

    Trajet_Dossier(id_dossier, id_prg, id_detail_hotel);

    cpt_fiche_ins(id_prg, id_detail_hotel);

    Liste_type();
    liste_categorie();
    Liste_societe();
    Liste_type_chambre();
    Liste_accompagnateur();
    Liste_type_visa();
    Liste_chambre();
});
imgInp.onchange = (evt) => {
    const [file] = imgInp.files;
    if (file) {
        blah.src = URL.createObjectURL(file);
    }
};
photo.onchange = (evt) => {
    const [file] = photo.files;
    if (file) {
        img_passp.src = URL.createObjectURL(file);
    }
};
function Trajet_Dossier(id_dossier, id_prg, id_detail_hotel) {
    jQuery.ajax({
        url:
            "/Trajet_Dossier/Dossier/" +
            id_dossier +
            "/programme/" +
            id_prg +
            "/Hotel/" +
            id_detail_hotel,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_prg = "";
            $select_dossier = "";
            $select_hotel = "";
            $num_prg = "";
            $prix_prg = "";
            jQuery.each(responce.Trajet_Dossier, function (key, item) {
                $select_dossier = item.nom_dossier;
                $select_prg = item.nom_programme;
                $select_hotel = item.hotel_prg;
                $num_prg = item.FK_programme;
                $prix_prg = item.prix_prg;
                document.getElementById("num_prg_inscription").value =
                    item.FK_programme;
            });

            $("#nom_dossies").html($select_dossier);

            document.getElementById("nom_prgramme").innerHTML = $select_prg;
            document.getElementById("nom_Hotel").innerHTML = $select_hotel;
            document.getElementById("prix").value = $prix_prg;
        },
    });
}




// liste prg
function liste_prg() {
    jQuery.ajax({
        url: "/info_prg",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_prg = "";
            jQuery.each(responce.inf_prg, function (key, item) {
                $select_prg =
                    $select_prg +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nom_programme +
                    "</option>";
            });
            $("#num_prg_inscription").html($select_prg);
        },
    });
}
cpt1 =34210001;
// liste ref prg
function cpt_fiche_ins(id_prg, id_detail_hotel) {
    jQuery.ajax({
        url:
            "/info_Fiche_inscription/id_prg/" +
            id_prg +
            "/id_hotel/" +
            id_detail_hotel,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_fiche_insc = "";
          
            jQuery.each(responce.info_fiche, function (key, item) {
                $select_fiche_insc =
                    $select_fiche_insc +
                    '<option value="' +
                    item.id_fiche_ins +
                    '">' +
                    item.num_fichier +
                    "</option>";
                if (cpt1 < item.id) {
                    cpt1 = item.id;
                }
                console.log(item);
                document.getElementById("date_fiche_inscription").value =
                    item.date_fiche_inscription;
                    document.getElementById("id_fiche").value =
                    item.id;
                document.getElementById("num_prg_inscription").value =
                    item.FK_programme;
                document.getElementById("code_societe").value = item.FK_societe;
                document.getElementById("nom_societe").value = item.nom_societe;
                document.getElementById("bon_commande").value =
                    item.bon_commande;
                    document.getElementById("Num_Fich_insc").value =item.id;
                table_fiche_insc(item.id_fiche_ins, id_prg, id_detail_hotel);
                
            });
            $("#num_fichier").html($select_fiche_insc);
        },
    });
}

function Nouveau_insc() {
    cpt1 = cpt1 + 1;
    $("#num_fichier").append(
        '<option value="' + cpt1 + '" selected="selected">' + cpt1 + "</option>"
    );
    viderchamp();
}
// liste categorie
function liste_categorie() {
    jQuery.ajax({
        url: "/categorie_info",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_fiche_insc = "";
            newval = 0;
            jQuery.each(responce.inf_Categorie, function (key, item) {
                $select_fiche_insc =
                    $select_fiche_insc +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.id +
                    "</option>";

                if (newval < item.id) {
                    newval = item.id;
                }
            });
            $("#num_categorie").html($select_fiche_insc);
        },
    });
}
// type
function Liste_type() {
    jQuery.ajax({
        url: "/type_prg",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_fiche_insc = "";
            newval = 0;
            jQuery.each(responce.liste_type_prg, function (key, item) {
                $select_fiche_insc =
                    $select_fiche_insc +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nom_type_programme +
                    "</option>";
            });
            $("#type_prg").html($select_fiche_insc);
        },
    });
}
// liste code societe
function Liste_societe() {
    jQuery.ajax({
        url: "/societe_info",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_societe = "";
            newval = 0;
            jQuery.each(responce.societe_info, function (key, item) {
                $select_societe =
                    $select_societe +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.compte +
                    "</option>";
            });
            $("#code_societe").html($select_societe);
        },
    });
}
//liste type chambre
function Liste_type_chambre() {
    jQuery.ajax({
        url: "/type_chambre_info",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_societe = "";

            jQuery.each(responce.type_chambre_info, function (key, item) {
                $select_societe =
                    $select_societe +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.type_chambre +
                    "</option>";
            });
            $("#type_chambre_medina").html($select_societe);
            $("#type_chambre_makka").html($select_societe);
        },
    });
}
// chambre
function Liste_chambre() {
    jQuery.ajax({
        url: "/type_chambre_info",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_societe = "";

            jQuery.each(responce.Gestion_chambres, function (key, item) {
                $select_societe =
                    $select_societe +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nom_chambre +
                    "</option>";
            });
            $("#chambre_medina").html($select_societe);
            $("#chambre_makka").html($select_societe);
        },
    });
}

//liste Accompagnateur
function Liste_accompagnateur() {
    jQuery.ajax({
        url: "/accom_info",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_accompagnateur = "";
            jQuery.each(responce.accomp_info, function (key, item) {
                $select_accompagnateur =
                    $select_accompagnateur +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nom_prenom +
                    "</option>";
            });
            $("#num_Accompagnateur").html($select_accompagnateur);
        },
    });
}
//liste type visa
function Liste_type_visa() {
    jQuery.ajax({
        url: "/type_visa",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_accompagnateur = "";
            jQuery.each(responce.type_visa_info, function (key, item) {
                $select_accompagnateur =
                    $select_accompagnateur +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.type +
                    "</option>";
            });
            $("#Type_visa").html($select_accompagnateur);
        },
    });
}

$(document).ready(function () {
    document.getElementById("Reduction_Billet").style.display = "none";
    document.getElementById("raison_billet").style.display = "none";

    document.getElementById("Reduction_Transport").style.display = "none";
    document.getElementById("raison_Transport").style.display = "none";

    document.getElementById("Reduction_Hotel_Meedina").style.display = "none";
    document.getElementById("raison_hotel_medina").style.display = "none";

    document.getElementById("Reduction_Hotel_Makka").style.display = "none";
    document.getElementById("raison_hotel_makka").style.display = "none";

    document.getElementById("Reduction_Visa").style.display = "none";
    document.getElementById("raison_visa").style.display = "none";

    // ajouter categorie
    $("#form_Categorie").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function (response) {
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
            },
        });
    });
    // ******Ajouter info client******
    $("#Informations_clients").on("submit", function (e) {
        e.preventDefault();
        var v = window.location.href;
        var id_dossier = v.split("/")[5];
        var id_prg = v.split("/")[7];
        var id_detail_hotel = v.split("/")[9];
        var num_fichier = $("#Num_Fich_insc").val();
console.log(num_fichier);
        var formData = new FormData($(this)[0]);
        var $this = jQuery(this);

        // var num_prg_inscription = $("#num_prg_inscription").val();
        formData.append("num_fichier", num_fichier);
        formData.append("id_prg", id_prg);
        formData.append("detail_hotel_prg", id_detail_hotel);

        jQuery.ajax({
            url: $this.attr("action"),
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: "multipart/form-data",
            processData: false,
            success: function (response) {
                if (response.messages != null) {
                    toastr.success(response.messages);
                }

                table_fiche_insc(num_fichier, id_prg, id_detail_hotel);
                if (response.errors != null) {
                    toastr.error(response.errors);
                }
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
            },
        });

        return false;
    });
    // ******Ajouter fiche inscription******
    $("#form_gestion_fiche_insc").on("submit", function (e) {
        e.preventDefault();
      
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function (response) {
                toastr.success(response.message);
                // viderchamp();
                jQuery.each(
                    response.update_fiche_insc,
                    function (key, item) {
                        
                        // console.log(response.update_gestion_allot);
                        document.getElementById("Num_Fich_insc").value =
                            item.id;
                        console.log(
                            document.getElementById("Num_Fich_insc").value
                        );
                    }
                );
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
            },
        });
    });

     // ******redirection facture*******
    $("#facture").on("click",function()
    {
        let id=$('#id_fiche').val();
      
        jQuery.ajax({
            url: "/facturation/"+id,
            type: "GET",
            data: id,
            success: function(response){
                window.location.href = "/facturation/"+id;
            },
            error: function(xhr, status, error){
                // handle any errors that occur during the AJAX request
                console.log("Error:", error);
            }
        });
    })
  
    // ******delete fiche inscription*******
    $("#delet_Client").on("submit", function (e) {
        e.preventDefault();
        var v = window.location.href;
        var id_dossier = v.split("/")[5];
        var id_prg = v.split("/")[7];
        var id_detail_hotel = v.split("/")[9];
        var num_fichier = $("#num_fichier").val();

        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#delete-confirmation-modal").trigger("click");
                table_fiche_insc(num_fichier, id_prg, id_detail_hotel);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
    // ******update fiche insc******
    $("#up_Client").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var v = window.location.href;
        var id_dossier = v.split("/")[5];
        var id_prg = v.split("/")[7];
        var id_detail_hotel = v.split("/")[9];
        var num_fichier = $("#num_fichier").val();

        var formData = new FormData($(this)[0]);

        var up_genre = $("#genre").val();
        var up_date_naissance = $("#date_naissance").val();
        var up_adresse = $("#adresse").val();
        var up_num_Accompagnateur = $("#num_Accompagnateur").val();
        var up_prix = $("#prix").val();
        var up_date_expiration = $("#date_expiration").val();
        var up_situation_familiale = $("#situation_familiale").val();
        var up_telephone = $("#telephone").val();
        var up_num_ligne = $("#num_ligne").val();
        var up_nom_client = $("#nom_client").val();
        var up_prenom_client = $("#prenom_client").val();
        var up_num_GSM = $("#num_GSM").val();
        var up_type_chambre_medina = $("#type_chambre_medina").val();
        var up_type_passport = $("#type_passport").val();
        var up_nom_arabe = $("#nom_arabe").val();
        var up_prenom_arabe = $("#prenom_arabe").val();
        var up_num_CIN = $("#num_CIN").val();
        var up_Email = $("#Email").val();
        var up_chambre_medina = $("#chambre_medina").val();
        var up_date_expiration_visa = $("#date_expiration_visa").val();
        var up_Num_Inscription = $("#Num_Inscription").val();
        var up_Type_visa = $("#Type_visa").val();
        var up_Lieu_delivrance = $("#Lieu_delivrance").val();
        var up_num_passeport = $("#num_passeport").val();
        var up_date_obtention_visa = $("#date_obtention_visa").val();
        var up_num_visa = $("#num_visa").val();
        var up_date_delivrance = $("#date_delivrance").val();
        var up_etat_passeport = $("#etat_passeport").val();
        var up_Province = $("#Province").val();
        var up_type_chambre_makka = $("#type_chambre_makka").val();
        var up_chambre_makka = $("#chambre_makka").val();
        var up_blah = imgInp;
        var up_img_passp = photo;

        var up_Fk_prg = id_prg;
        var up_Fk_hotel = id_detail_hotel;

        formData.append("up_Fk_prg", up_Fk_prg);
        formData.append("up_Fk_hotel", up_Fk_hotel);
        formData.append("up_genre", up_genre);
        formData.append("up_date_naissance", up_date_naissance);
        formData.append("up_adresse", up_adresse);
        formData.append("up_num_Accompagnateur", up_num_Accompagnateur);
        formData.append("up_prix", up_prix);
        formData.append("up_date_expiration", up_date_expiration);
        formData.append("up_situation_familiale", up_situation_familiale);
        formData.append("up_telephone", up_telephone);
        formData.append("up_num_ligne", up_num_ligne);
        formData.append("up_nom_client", up_nom_client);
        formData.append("up_prenom_client", up_prenom_client);
        formData.append("up_num_GSM", up_num_GSM);
        formData.append("up_type_chambre_medina", up_type_chambre_medina);
        formData.append("up_type_passport", up_type_passport);
        formData.append("up_nom_arabe", up_nom_arabe);
        formData.append("up_prenom_arabe", up_prenom_arabe);
        formData.append("up_num_CIN", up_num_CIN);
        formData.append("up_Email", up_Email);
        formData.append("up_chambre_medina", up_chambre_medina);
        formData.append("up_date_expiration_visa", up_date_expiration_visa);
        formData.append("up_Num_Inscription", up_Num_Inscription);
        formData.append("up_Type_visa", up_Type_visa);
        formData.append("up_Lieu_delivrance", up_Lieu_delivrance);
        formData.append("up_num_passeport", up_num_passeport);
        formData.append("up_date_obtention_visa", up_date_obtention_visa);
        formData.append("up_num_visa", up_num_visa);
        formData.append("up_date_delivrance", up_date_delivrance);
        formData.append("up_Province", up_Province);
        formData.append("up_etat_passeport", up_etat_passeport);
        formData.append("up_type_chambre_makka", up_type_chambre_makka);
        formData.append("up_blah", up_blah);
        formData.append("up_img_passp", up_img_passp);
        formData.append("up_chambre_makka", up_chambre_makka);

        jQuery.ajax({
            url: $this.attr("action"),
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: "multipart/form-data",
            processData: false,
            success: function (response) {
                toastr.success(response.messages);
                jQuery("#update-confirmation-modal").trigger("click");
                table_fiche_insc(num_fichier, id_prg, id_detail_hotel);
            },
            error: function (response) {
                toastr.error(response.Error);
            },
        });
    });
   
});

function viderchamp() {
    document.getElementById("date_fiche_inscription").value = "";
    document.getElementById("code_societe").value = "";
    document.getElementById("nom_societe").value = "";
    document.getElementById("bon_commande").value = "";
    document.getElementById("genre").value = "";
    document.getElementById("date_naissance").value = "";
    document.getElementById("adresse").value = "";
    document.getElementById("num_Accompagnateur").value = "";
    document.getElementById("prix").value = "";
    document.getElementById("date_expiration").value = "";
    document.getElementById("situation_familiale").value = "";
    document.getElementById("telephone").value = "";
    document.getElementById("num_ligne").value = "";
    document.getElementById("nom_client").value = "";
    document.getElementById("prenom_client").value = "";
    document.getElementById("num_GSM").value = "";
    document.getElementById("type_passport").value = "";
    document.getElementById("nom_arabe").value = "";
    document.getElementById("prenom_arabe").value = "";
    document.getElementById("num_CIN").value = "";
    document.getElementById("Email").value = "";
    document.getElementById("date_expiration_visa").value = "";
    document.getElementById("Num_Inscription").value = " ";
    document.getElementById("Type_visa").value = "";
    document.getElementById("Lieu_delivrance").value = "";
    document.getElementById("num_passeport").value = " ";
    document.getElementById("date_obtention_visa").value = "";
    document.getElementById("num_visa").value = "";
    document.getElementById("date_delivrance").value = "";
    document.getElementById("etat_passeport").value = "";
    document.getElementById("Province").value = "";

    var img_CIN = document.getElementById("blah");
    img_CIN.src = "/build/assets/images/update_img.jpg";

    var img_passp = document.getElementById("img_passp");
    img_passp.src = "/build/assets/images/update_img.jpg";
}
// selecte change
$("#num_categorie").change(function () {
    var value = $(this).val();
    jQuery.ajax({
        url: "/categorie_info/" + value,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            jQuery.each(responce.info_categorie, function (key, item) {
                // document.getElementById("nom_allot").value = item.num_categorie;
                document.getElementById("nom_categorie").value =
                    item.nom_categorie;
                document.getElementById("nbr_pax").value = item.Nbre_pax;
                document.getElementById("remis").value = item.remis;
                document.getElementById("date_categorie").value = item.date;
                document.getElementById("type_prg").value = item.FK_type;
            });
        },
    });
});
$("#code_societe").change(function () {
    var value = $(this).val();
    jQuery.ajax({
        url: "/societe_info/" + value,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            // affichage select
            jQuery.each(responce.societe_info, function (key, item) {
                // document.getElementById("nom_allot").value = item.num_categorie;
                document.getElementById("nom_societe").value = item.nom;
            });
        },
    });
});

function showChecked() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    var langPref = [];
    jQuery.each($("input[class='mycheckboxs']:checked"), function () {
        langPref.push($(this).val());
    });
    // alert("Votre langage de programmation préféré est: " + langPref.join(", "));

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            document.getElementById("select_Inclus").innerText =
                "" + langPref.join(", ");
        } else {
            document.getElementById("select_Inclus").innerText =
                "" + langPref.join(", ");
        }
    });
}

$(document).ready(function () {
    // liste des prog
    liste_prg();
    var ckbox = $("input[name='mycheckboxs']");
    var chkId = "";
    $("input").on("click", function () {
        if ($("#Billetcheq").is(":checked")) {
            document.getElementById("Billet").value='';
            document.getElementById("Reduction_Billet").style.display = "none";
            document.getElementById("raison_billet").style.display = "none";
        } else {
            document.getElementById("Billet").value='Billet';
            document.getElementById("Reduction_Billet").style.display = "block";
            document.getElementById("raison_billet").style.display = "block";
        }

        if ($("#Transportcheq").is(":checked")) {
            document.getElementById("Transport").value='';
            document.getElementById("Reduction_Transport").style.display ="none";
            document.getElementById("raison_Transport").style.display = "none";
        } else {
            document.getElementById("Transport").value='Transport';
            document.getElementById("Reduction_Transport").style.display ="block";
            document.getElementById("raison_Transport").style.display = "block";
        }

        if ($("#hotel_meedinacheq").is(":checked")) {
            document.getElementById("Hotel_Meedina").value='';
            document.getElementById("Reduction_Hotel_Meedina").style.display ="none";
            document.getElementById("raison_hotel_medina").style.display ="none";
        } else {
            document.getElementById("Hotel_Meedina").value='Hotel Meedina';
            document.getElementById("Reduction_Hotel_Meedina").style.display ="block";
            document.getElementById("raison_hotel_medina").style.display ="block";
        }

        if ($("#hotel_makkacheq").is(":checked")) {
            document.getElementById("Hotel_Makka").value='';
            document.getElementById("Reduction_Hotel_Makka").style.display ="none";
            document.getElementById("raison_hotel_makka").style.display ="none";
        } else {
            document.getElementById("Hotel_Makka").value='Hotel_Makka';
            document.getElementById("Reduction_Hotel_Makka").style.display ="block";
            document.getElementById("raison_hotel_makka").style.display ="block";
        }

        if ($("#Visacheq").is(":checked")) {
            document.getElementById("Visa").value='';
            document.getElementById("Reduction_Visa").style.display = "none";
            document.getElementById("raison_visa").style.display = "none";
        } else {
            document.getElementById("Visa").value='Visa';
            document.getElementById("Reduction_Visa").style.display = "block";
            document.getElementById("raison_visa").style.display = "block";
        }
    });
});

function afficherinfo() {
    let value = document.getElementById("parsed").firstElementChild.textContent;
    obj = JSON.parse(value);
    document.getElementById("nom_client").value = obj.lastName;
    document.getElementById("prenom_client").value = obj.firstName;
    document.getElementById("Province").value = obj.nationality;
    document.getElementById("num_CIN").value = obj.personalNumber;
    document.getElementById("num_passeport").value = obj.documentNumber;
    document.getElementById("type_passport").value = obj.documentCode;

    const birthDateStr = obj.birthDate;
    const expirationDateStr = obj.expirationDate;

    const birthYear = parseInt(birthDateStr.substring(0, 2));
    const birthMonth = parseInt(birthDateStr.substring(2, 4)) - 1; // months are zero-indexed in JavaScript
    const birthDay = parseInt(birthDateStr.substring(4, 6));
    const birthDate = new Date(1900 + birthYear, birthMonth, birthDay);

    const expirationYear = parseInt(expirationDateStr.substring(0, 2));
    const expirationMonth = parseInt(expirationDateStr.substring(2, 4)) - 1; // months are zero-indexed in JavaScript
    const expirationDay = parseInt(expirationDateStr.substring(4, 6));
    const expirationDate = new Date(
        2000 + expirationYear,
        expirationMonth,
        expirationDay
    ); // assuming the expiration year is in the 21st century

    const formatDate = (date) => {
        const month = date.getMonth() + 1; // months are zero-indexed in JavaScript, so add 1
        const day = date.getDate();
        const year = date.getFullYear();

        return `${day.toString().padStart(2, "0")}-${month
            .toString()
            .padStart(2, "0")}-${year.toString()}`;
    };

    const inputDateexp = formatDate(expirationDate);
    const inputFormat = "DD/MM/YYYY";
    const outputFormat = "YYYY-MM-DD";

    const date_expiration_visa = moment(inputDateexp, inputFormat).format(
        outputFormat
    );
    document.getElementById("date_expiration_visa").value =
        date_expiration_visa;

    const inputDatebirth = formatDate(birthDate);

    const date_naissance = moment(inputDatebirth, inputFormat).format(
        outputFormat
    );
    document.getElementById("date_naissance").value = date_naissance;

    if (obj.sex == "female") {
        document.getElementById("genre").value = 1;
    } else {
        document.getElementById("genre").value = 2;
    }
}
$("#num_fichier").change(function () {
    var value = $(this).val();
    console.log(value);
    jQuery.ajax({
        url: "/info_GFiche_Insc/" + value,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            // affichage select info_GFiche_Insc
            jQuery.each(responce.info_fiche_Insc, function (key, item) {
                document.getElementById("date_fiche_inscription").value =
                    item.date_fiche_inscription;
               
                document.getElementById("num_prg_inscription").value =
                    item.FK_programme;
                document.getElementById("code_societe").value = item.FK_societe;
                document.getElementById("nom_societe").value = item.nom_societe;
                document.getElementById("bon_commande").value =
                    item.bon_commande;
                info_fiche_inscription(item.id);
                table_fiche_insc(item.id);
            });
        },
    });
});
function info_fiche_inscription(Fk_fiche_inscription) {
    jQuery.ajax({
        url: "/Detail_Fiche_Insc/" + Fk_fiche_inscription,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            if (responce.Detail_Fiche_Insc.length == 0) {
                document.getElementById("genre").value = "";
                document.getElementById("date_naissance").value = "";
                document.getElementById("adresse").value = "";
                document.getElementById("num_Accompagnateur").value = "";
                document.getElementById("prix").value = "";
                document.getElementById("date_expiration").value = "";
                document.getElementById("situation_familiale").value = "";
                document.getElementById("telephone").value = "";
                document.getElementById("num_ligne").value = "";
                document.getElementById("nom_client").value = "";
                document.getElementById("prenom_client").value = "";
                document.getElementById("num_GSM").value = "";
                document.getElementById("type_passport").value = "";
                document.getElementById("nom_arabe").value = "";
                document.getElementById("prenom_arabe").value = "";
                document.getElementById("num_CIN").value = "";
                document.getElementById("Email").value = "";
                document.getElementById("chambre_medina").value = "";
                document.getElementById("date_expiration_visa").value = "";
                document.getElementById("Num_Inscription").value = "";
                document.getElementById("Type_visa").value = "";
                document.getElementById("Lieu_delivrance").value = "";
                document.getElementById("num_passeport").value = "";
                document.getElementById("date_obtention_visa").value = "";
                document.getElementById("num_visa").value = "";
                document.getElementById("date_delivrance").value = "";
                document.getElementById("etat_passeport").value = "";
                document.getElementById("Province").value = "";

                document.getElementById("type_chambre_makka").value = "";
                document.getElementById("Province").value = "";

                var img_CIN = document.getElementById("blah");
                img_CIN.src = "/build/assets/images/update_img.jpg";
                var img_passp = document.getElementById("img_passp");
                img_passp.src = "/build/assets/images/update_img.jpg";
            } else {
                jQuery.each(responce.Detail_Fiche_Insc, function (key, item) {
                    document.getElementById("genre").value = item.genre;
                    document.getElementById("date_naissance").value =
                        item.date_naissance;
                    document.getElementById("adresse").value = item.adresse;
                    document.getElementById("num_Accompagnateur").value =
                        item.FK_accompagnateurs;
                    document.getElementById("prix").value = item.prix;
                    document.getElementById("date_expiration").value =
                        item.date_expiration;
                    document.getElementById("situation_familiale").value =
                        item.situation_familiale;
                    document.getElementById("telephone").value = item.telephone;
                    document.getElementById("num_ligne").value = item.num_ligne;
                    document.getElementById("nom_client").value =
                        item.nom_client;
                    document.getElementById("prenom_client").value =
                        item.prenom_client;
                    document.getElementById("num_GSM").value = item.num_GSM;
                    // ***
                    document.getElementById("type_chambre_medina").value =
                        item.FK_type_chambre;
                    document.getElementById("type_passport").value =
                        item.type_passport;
                    document.getElementById("nom_arabe").value = item.nom_arabe;
                    document.getElementById("prenom_arabe").value =
                        item.prenom_arabe;
                    document.getElementById("num_CIN").value = item.num_CIN;
                    document.getElementById("Email").value = item.Email;
                    // **
                    document.getElementById("chambre_medina").value =
                        item.Fk_chambre_medina;
                    document.getElementById("date_expiration_visa").value =
                        item.date_expiration_visa;
                    document.getElementById("Num_Inscription").value =
                        item.Num_Inscription;
                    document.getElementById("Type_visa").value = item.Type_visa;
                    document.getElementById("Lieu_delivrance").value =
                        item.Lieu_delivrance;
                    document.getElementById("num_passeport").value =
                        item.num_passeport;
                    document.getElementById("date_obtention_visa").value =
                        item.date_obtention_visa;
                    document.getElementById("num_visa").value = item.num_visa;
                    document.getElementById("date_delivrance").value =
                        item.date_delivrance;
                    document.getElementById("etat_passeport").value =
                        item.etat_passeport;
                    document.getElementById("Province").value = item.Province;

                    document.getElementById("type_chambre_makka").value =
                        item.FK_type_chambre_makka;
                    document.getElementById("chambre_makka").value =
                        item.chambre_makka;

                    var img_CIN = document.getElementById("blah");
                    if (item.upload_img == undefined) {
                        img_CIN.src = "/build/assets/images/update_img.jpg";
                    } else {
                        img_CIN.src = "/uploads/" + item.upload_img;
                    }
                    var img_passp = document.getElementById("img_passp");
                    if (item.upload_img == undefined) {
                        img_CIN.src = "/build/assets/images/update_img.jpg";
                    } else {
                        img_passp.src = "/uploads/" + item.img_pass;
                    }
                    if (item.img_pass == null) {
                        img_passp.src = "/build/assets/images/update_img.jpg";
                    }
                    if (item.upload_img == null) {
                        img_CIN.src = "/build/assets/images/update_img.jpg";
                    }
                });
            }
        },
    });
}

// function de rechercher par FK_prg
function table_fiche_insc(Fk_fiche_inscription, id_prg, id_hotel) {
    jQuery.ajax({
        url:
            "/Detail_Fiche_Insc/id_fiche/" +
            Fk_fiche_inscription +
            "/id_prg/" +
            id_prg +
            "/id_hotel/" +
            id_hotel,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            jQuery.each(responce.Detail_Fiche_Insc, function (key, item) {
                
                if (responce.Detail_Fiche_Insc.length == 0) {
                    
                }
                $tabledata = responce.Detail_Fiche_Insc;
                
            });
            var table = new Tabulator("#liste_fiche_insc", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                pagination: "local",
                printHeader:
                    '<div class="center intro-x w-10 h-10 image-fit">\n <img alt="Midone - HTML Admin Template" class="rounded-full " src="dist/images/download.jpg">\n  </div>  <h1 style=\'color:#92400e; margin-left:10px;\'>عمرة رمضان موسم 2023 </h1>    \n ',
                printFooter:
                    "<h3>28,Bd Hassane Bnou Tabit - Hay Ezzahraa - Berrchid - 26100 - Maroc Tél.:05 22 32 80 50/52 - Fax: 05 22 32 55 11 - E-mail: info@almaqamtrips.com</h3>",
                paginationSize: 5,
                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "No matching records found",
                tooltips: true,
                //custom formatter definition

                columns: [
                    {
                        title: "Nom",
                        width: 95,
                        field: "nom_client",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Prenom",
                        minWidth: 100,
                        width: 43,
                        field: "prenom_client",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Num passeport",
                        minWidth: 100,
                        width: 43,
                        field: "num_passeport",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "telephone",
                        field: "telephone",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "GSM",
                        field: "num_GSM",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "CIN",
                        field: "num_CIN",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Email",
                        field: "Email",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Action",
                        minWidth: 110,
                        field: "actions",
                        responsive: 1,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                                        <a class="view flex items-center text-success tooltip mr-3" title="Consulter">
                                            <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="eye " data-lucide="eye " class="lucide lucide-eye w-4 h-4 mr-1 "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z "></path><circle cx="12 " cy="12 " r="3 "></circle></svg>
                                        </a>
                                            <a  class="edit lex items-center text-success tooltip mr-3" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#update-confirmation-modal">
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                                        </a>
                                        <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                        </a>
                            </div>`);

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/information_client/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.info_client,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "delete_id_client"
                                                    ).value = item.id;
                                                }
                                            );
                                        },
                                    });
                                });

                            $(a)
                                .find(".view")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/information_client/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        success: function (responce) {
                                            // affichage select
                                            if (
                                                responce.info_client.length == 0
                                            ) {
                                                document.getElementById(
                                                    "genre"
                                                ).value = "";
                                                document.getElementById(
                                                    "date_naissance"
                                                ).value = "";
                                                document.getElementById(
                                                    "adresse"
                                                ).value = "";
                                                document.getElementById(
                                                    "num_Accompagnateur"
                                                ).value = "";
                                                document.getElementById(
                                                    "prix"
                                                ).value = "";
                                                document.getElementById(
                                                    "date_expiration"
                                                ).value = "";
                                                document.getElementById(
                                                    "situation_familiale"
                                                ).value = "";
                                                document.getElementById(
                                                    "telephone"
                                                ).value = "";
                                                document.getElementById(
                                                    "num_ligne"
                                                ).value = "";
                                                document.getElementById(
                                                    "nom_client"
                                                ).value = "";
                                                document.getElementById(
                                                    "prenom_client"
                                                ).value = "";
                                                document.getElementById(
                                                    "num_GSM"
                                                ).value = "";
                                                document.getElementById(
                                                    "type_passport"
                                                ).value = "";
                                                document.getElementById(
                                                    "nom_arabe"
                                                ).value = "";
                                                document.getElementById(
                                                    "prenom_arabe"
                                                ).value = "";
                                                document.getElementById(
                                                    "num_CIN"
                                                ).value = "";
                                                document.getElementById(
                                                    "Email"
                                                ).value = "";
                                                document.getElementById(
                                                    "chambre_medina"
                                                ).value = "";
                                                document.getElementById(
                                                    "date_expiration_visa"
                                                ).value = "";
                                                document.getElementById(
                                                    "Num_Inscription"
                                                ).value = "";
                                                document.getElementById(
                                                    "Type_visa"
                                                ).value = "";
                                                document.getElementById(
                                                    "Lieu_delivrance"
                                                ).value = "";
                                                document.getElementById(
                                                    "num_passeport"
                                                ).value = "";
                                                document.getElementById(
                                                    "date_obtention_visa"
                                                ).value = "";
                                                document.getElementById(
                                                    "num_visa"
                                                ).value = "";
                                                document.getElementById(
                                                    "date_delivrance"
                                                ).value = "";
                                                document.getElementById(
                                                    "etat_passeport"
                                                ).value = "";
                                                document.getElementById(
                                                    "Province"
                                                ).value = "";

                                                document.getElementById(
                                                    "type_chambre_makka"
                                                ).value = "";
                                                document.getElementById(
                                                    "Province"
                                                ).value = "";

                                                var img_CIN =
                                                    document.getElementById(
                                                        "blah"
                                                    );
                                                img_CIN.src =
                                                    "/build/assets/images/update_img.jpg";
                                                var img_passp =
                                                    document.getElementById(
                                                        "img_passp"
                                                    );
                                                img_passp.src =
                                                    "/build/assets/images/update_img.jpg";
                                            } else {
                                                jQuery.each(
                                                    responce.info_client,
                                                    function (key, item) {
                                                        document.getElementById(
                                                            "genre"
                                                        ).value = item.genre;
                                                        document.getElementById(
                                                            "date_naissance"
                                                        ).value =
                                                            item.date_naissance;
                                                        document.getElementById(
                                                            "adresse"
                                                        ).value = item.adresse;
                                                        document.getElementById(
                                                            "num_Accompagnateur"
                                                        ).value =
                                                            item.FK_accompagnateurs;
                                                        document.getElementById(
                                                            "prix"
                                                        ).value = item.prix;
                                                        document.getElementById(
                                                            "date_expiration"
                                                        ).value =
                                                            item.date_expiration;
                                                        document.getElementById(
                                                            "situation_familiale"
                                                        ).value =
                                                            item.situation_familiale;
                                                        document.getElementById(
                                                            "telephone"
                                                        ).value =
                                                            item.telephone;
                                                        document.getElementById(
                                                            "num_ligne"
                                                        ).value =
                                                            item.num_ligne;
                                                        document.getElementById(
                                                            "nom_client"
                                                        ).value =
                                                            item.nom_client;
                                                        document.getElementById(
                                                            "prenom_client"
                                                        ).value =
                                                            item.prenom_client;
                                                        document.getElementById(
                                                            "num_GSM"
                                                        ).value = item.num_GSM;
                                                        // ***
                                                        document.getElementById(
                                                            "type_chambre_medina"
                                                        ).value =
                                                            item.FK_type_chambre;
                                                        document.getElementById(
                                                            "type_passport"
                                                        ).value =
                                                            item.type_passport;
                                                        document.getElementById(
                                                            "nom_arabe"
                                                        ).value =
                                                            item.nom_arabe;
                                                        document.getElementById(
                                                            "prenom_arabe"
                                                        ).value =
                                                            item.prenom_arabe;
                                                        document.getElementById(
                                                            "num_CIN"
                                                        ).value = item.num_CIN;
                                                        document.getElementById(
                                                            "Email"
                                                        ).value = item.Email;
                                                        // **
                                                        document.getElementById(
                                                            "chambre_medina"
                                                        ).value =
                                                            item.Fk_chambre_medina;
                                                        document.getElementById(
                                                            "date_expiration_visa"
                                                        ).value =
                                                            item.date_expiration_visa;
                                                        document.getElementById(
                                                            "Num_Inscription"
                                                        ).value =
                                                            item.Num_Inscription;
                                                        document.getElementById(
                                                            "Type_visa"
                                                        ).value =
                                                            item.Type_visa;
                                                        document.getElementById(
                                                            "Lieu_delivrance"
                                                        ).value =
                                                            item.Lieu_delivrance;
                                                        document.getElementById(
                                                            "num_passeport"
                                                        ).value =
                                                            item.num_passeport;
                                                        document.getElementById(
                                                            "date_obtention_visa"
                                                        ).value =
                                                            item.date_obtention_visa;
                                                        document.getElementById(
                                                            "num_visa"
                                                        ).value = item.num_visa;
                                                        document.getElementById(
                                                            "date_delivrance"
                                                        ).value =
                                                            item.date_delivrance;
                                                        document.getElementById(
                                                            "etat_passeport"
                                                        ).value =
                                                            item.etat_passeport;
                                                        document.getElementById(
                                                            "Province"
                                                        ).value = item.Province;

                                                        document.getElementById(
                                                            "type_chambre_makka"
                                                        ).value =
                                                            item.FK_type_chambre_makka;
                                                        document.getElementById(
                                                            "Province"
                                                        ).value =
                                                            item.chambre_makka;

                                                        var img_CIN =
                                                            document.getElementById(
                                                                "blah"
                                                            );
                                                        if (
                                                            item.upload_img ==
                                                            undefined
                                                        ) {
                                                            img_CIN.src =
                                                                "/build/assets/images/update_img.jpg";
                                                        } else {
                                                            img_CIN.src =
                                                                "/uploads/" +
                                                                item.upload_img;
                                                        }
                                                        var img_passp =
                                                            document.getElementById(
                                                                "img_passp"
                                                            );
                                                        if (
                                                            item.upload_img ==
                                                            undefined
                                                        ) {
                                                            img_CIN.src =
                                                                "/build/assets/images/update_img.jpg";
                                                        } else {
                                                            img_passp.src =
                                                                "/uploads/" +
                                                                item.img_pass;
                                                        }
                                                        if (
                                                            item.img_pass ==
                                                            null
                                                        ) {
                                                            img_passp.src =
                                                                "/build/assets/images/update_img.jpg";
                                                        }
                                                        if (
                                                            item.upload_img ==
                                                            null
                                                        ) {
                                                            img_CIN.src =
                                                                "/build/assets/images/update_img.jpg";
                                                        }
                                                    }
                                                );
                                            }
                                        },
                                    });
                                });
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/information_client/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        success: function (responce) {
                                            // affichage select
                                            jQuery.each(
                                                responce.info_client,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "update_id_client"
                                                    ).value = item.id;
                                                }
                                            );
                                        },
                                    });
                                });
                            return a[0];
                        },
                    },
                    // For print format
                ],

                rowDblClick: function (e, row) {
                    jQuery.ajax({
                        url: "/information_client/" + row.getData().id,
                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                        success: function (responce) {
                            // affichage select
                            if (responce.info_client.length == 0) {
                                document.getElementById("genre").value = "";
                                document.getElementById(
                                    "date_naissance"
                                ).value = "";
                                document.getElementById("adresse").value = "";
                                document.getElementById(
                                    "num_Accompagnateur"
                                ).value = "";
                                document.getElementById("prix").value = "";
                                document.getElementById(
                                    "date_expiration"
                                ).value = "";
                                document.getElementById(
                                    "situation_familiale"
                                ).value = "";
                                document.getElementById("telephone").value = "";
                                document.getElementById("num_ligne").value = "";
                                document.getElementById("nom_client").value =
                                    "";
                                document.getElementById("prenom_client").value =
                                    "";
                                document.getElementById("num_GSM").value = "";
                                document.getElementById("type_passport").value =
                                    "";
                                document.getElementById("nom_arabe").value = "";
                                document.getElementById("prenom_arabe").value =
                                    "";
                                document.getElementById("num_CIN").value = "";
                                document.getElementById("Email").value = "";
                                document.getElementById(
                                    "chambre_medina"
                                ).value = "";
                                document.getElementById(
                                    "date_expiration_visa"
                                ).value = "";
                                document.getElementById(
                                    "Num_Inscription"
                                ).value = "";
                                document.getElementById("Type_visa").value = "";
                                document.getElementById(
                                    "Lieu_delivrance"
                                ).value = "";
                                document.getElementById("num_passeport").value =
                                    "";
                                document.getElementById(
                                    "date_obtention_visa"
                                ).value = "";
                                document.getElementById("num_visa").value = "";
                                document.getElementById(
                                    "date_delivrance"
                                ).value = "";
                                document.getElementById(
                                    "etat_passeport"
                                ).value = "";
                                document.getElementById("Province").value = "";

                                document.getElementById(
                                    "type_chambre_makka"
                                ).value = "";
                                document.getElementById("Province").value = "";

                                var img_CIN = document.getElementById("blah");
                                img_CIN.src =
                                    "/build/assets/images/update_img.jpg";
                                var img_passp =
                                    document.getElementById("img_passp");
                                img_passp.src =
                                    "/build/assets/images/update_img.jpg";
                            } else {
                                jQuery.each(
                                    responce.info_client,
                                    function (key, item) {
                                        document.getElementById("genre").value =
                                            item.genre;
                                        document.getElementById(
                                            "date_naissance"
                                        ).value = item.date_naissance;
                                        document.getElementById(
                                            "adresse"
                                        ).value = item.adresse;
                                        document.getElementById(
                                            "num_Accompagnateur"
                                        ).value = item.FK_accompagnateurs;
                                        document.getElementById("prix").value =
                                            item.prix;
                                        document.getElementById(
                                            "date_expiration"
                                        ).value = item.date_expiration;
                                        document.getElementById(
                                            "situation_familiale"
                                        ).value = item.situation_familiale;
                                        document.getElementById(
                                            "telephone"
                                        ).value = item.telephone;
                                        document.getElementById(
                                            "num_ligne"
                                        ).value = item.num_ligne;
                                        document.getElementById(
                                            "nom_client"
                                        ).value = item.nom_client;
                                        document.getElementById(
                                            "prenom_client"
                                        ).value = item.prenom_client;
                                        document.getElementById(
                                            "num_GSM"
                                        ).value = item.num_GSM;
                                        // ***
                                        document.getElementById(
                                            "type_chambre_medina"
                                        ).value = item.FK_type_chambre;
                                        document.getElementById(
                                            "type_passport"
                                        ).value = item.type_passport;
                                        document.getElementById(
                                            "nom_arabe"
                                        ).value = item.nom_arabe;
                                        document.getElementById(
                                            "prenom_arabe"
                                        ).value = item.prenom_arabe;
                                        document.getElementById(
                                            "num_CIN"
                                        ).value = item.num_CIN;
                                        document.getElementById("Email").value =
                                            item.Email;
                                        // **
                                        document.getElementById(
                                            "chambre_medina"
                                        ).value = item.Fk_chambre_medina;
                                        document.getElementById(
                                            "date_expiration_visa"
                                        ).value = item.date_expiration_visa;
                                        document.getElementById(
                                            "Num_Inscription"
                                        ).value = item.Num_Inscription;
                                        document.getElementById(
                                            "Type_visa"
                                        ).value = item.Type_visa;
                                        document.getElementById(
                                            "Lieu_delivrance"
                                        ).value = item.Lieu_delivrance;
                                        document.getElementById(
                                            "num_passeport"
                                        ).value = item.num_passeport;
                                        document.getElementById(
                                            "date_obtention_visa"
                                        ).value = item.date_obtention_visa;
                                        document.getElementById(
                                            "num_visa"
                                        ).value = item.num_visa;
                                        document.getElementById(
                                            "date_delivrance"
                                        ).value = item.date_delivrance;
                                        document.getElementById(
                                            "etat_passeport"
                                        ).value = item.etat_passeport;
                                        document.getElementById(
                                            "Province"
                                        ).value = item.Province;

                                        document.getElementById(
                                            "type_chambre_makka"
                                        ).value = item.FK_type_chambre_makka;
                                        document.getElementById(
                                            "Province"
                                        ).value = item.chambre_makka;

                                        var img_CIN =
                                            document.getElementById("blah");
                                        if (item.upload_img == undefined) {
                                            img_CIN.src =
                                                "/build/assets/images/update_img.jpg";
                                        } else {
                                            img_CIN.src =
                                                "/uploads/" + item.upload_img;
                                        }
                                        var img_passp =
                                            document.getElementById(
                                                "img_passp"
                                            );
                                        if (item.upload_img == undefined) {
                                            img_CIN.src =
                                                "/build/assets/images/update_img.jpg";
                                        } else {
                                            img_passp.src =
                                                "/uploads/" + item.img_pass;
                                        }
                                        if (item.img_pass == null) {
                                            img_passp.src =
                                                "/build/assets/images/update_img.jpg";
                                        }
                                        if (item.upload_img == null) {
                                            img_CIN.src =
                                                "/build/assets/images/update_img.jpg";
                                        }
                                    }
                                );
                            }
                        },
                    });
                },
            });
        },
    });
}
