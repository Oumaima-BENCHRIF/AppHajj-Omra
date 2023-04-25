// in load page
$(window).on("load", function () {
    var v = window.location.href;
    var ref_dossier = v.split("/")[4];

    if (v.split("/")[3] == "gestion_programme") {
        liste_ref_prgt_fk_dossier(ref_dossier);
    } else {
        // select ref prg
        liste_ref_prgt(ref_dossier);
    }
    // Hotels du programme
    jQuery.ajax({
        url: "/liste_hotel_prg",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $ligneVoleDepart = "";
            jQuery.each(responce.jsonlisteVoledepart, function (key, item) {
                $ligneVoleDepart = $ligneVoleDepart;
            });
            $("#liste_hotel_prg").html($ligneVoleDepart);
        },
    });
    // Itinéraire & informations supplémentaires
    jQuery.ajax({
        url: "/liste_Itineraire",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $lignes = "";
            jQuery.each(responce.jsonlisteVoleRetour, function (key, item) {
                $lignes = $lignes;
            });
            $("#liste_itieraire").html($lignes);
        },
    });
    // Type de programme
    // Itinéraire & informations supplémentaires
    jQuery.ajax({
        url: "/type_prg",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $lignes = "";
            jQuery.each(responce.liste_type_prg, function (key, item) {
                $lignes =
                    $lignes +
                    '<option value="' +
                    item.nom_type_programme +
                    '">' +
                    item.nom_type_programme +
                    "</option>";
            });
            $("#type_programme").html($lignes);
        },
    });
    // liste gestion Itinéraire
    jQuery.ajax({
        url: "/liste_G_itineraires",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $lignes = "";
            jQuery.each(responce.liste_itineraires, function (key, item) {
                console.log(responce.liste_itineraires);
                $lignes =
                    $lignes +
                    '<option value="' +
                    item.nom_itineraire +
                    '">' +
                    item.nom_itineraire +
                    "</option>";
            });
            $("#up_itineraire_programme_").html($lignes);
        },
    });
    // liste vold depat
    jQuery.ajax({
        url: "/vole_depart_index",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_allot = "";
            jQuery.each(responce.jsonlisteVoledepart, function (key, item) {
                $select_allot =
                    $select_allot +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.num_vol +
                    "</option>";
            });
            $("#num_vole_dep").html($select_allot);
        },
    });
    // liste vole retour
    jQuery.ajax({
        url: "/vole_retour_index",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_allot1 = "";
            jQuery.each(responce.jsonlisteVoleRetour, function (key, item) {
                $select_allot1 =
                    $select_allot1 +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.num_vol +
                    "</option>";
            });
            $("#num_vole_retour").html($select_allot1);
        },
    });

    // Hotels du programme
    liste_Hotels_prg(ref_dossier);
    // Itinéraire & informations supplémentaires
    liste_Itineraire(ref_dossier);
    // Autres service
    Liste_service(ref_dossier);
});
cptnv = 0;
function liste_ref_prgt_fk_dossier(ref_dossier) {
    jQuery.ajax({
        url: "/liste_prg_FKdossier/" + ref_dossier,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_allot = "";
            cptnv = 0;
            jQuery.each(responce.liste_prg_FKdossier, function (key, item) {
                $select_allot =
                    $select_allot +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.ref_programme +
                    "</option>";

                if (cptnv < item.ref_programme) {
                    cptnv = item.ref_programme;
                }
            });
            $("#ref_programme").html($select_allot);
        },
    });
}
// selecte change
$("#ref_programme").change(function () {
    var value = $(this).val();
    var FKdossier = document.getElementById("FKdossier").value;
    var ref_programme = "";
    jQuery.ajax({
        url: "/Programme_infos/" + value + "/" + FKdossier,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            // affichage select
            jQuery.each(responce.liste_programmes, function (key, item) {
                document.getElementById("nom_programme").value =
                    item.nom_programme;
                document.getElementById("type_programme").value =
                    item.type_programme;
                document.getElementById("nbr_nuitee_prog_mdina").value =
                    item.nbr_nuitee_prog_mdina;
                document.getElementById("nbr_nuitee_prog_maka").value =
                    item.nbr_nuitee_prog_maka;
                document.getElementById("num_vole_dep").value =
                    item.FK_Num_vole_depart;
                document.getElementById("nbr_place_aller").value =
                    item.Nbr_place_aller;
                document.getElementById("nbr_reserver_dep").value =
                    item.Nbr_reserver_depart;
                document.getElementById("num_vole_retour").value =
                    item.FK_Num_vole_retour;
                document.getElementById("nbr_place_retour").value =
                    item.Nbr_place_retour;
                document.getElementById("nbr_reserver_retour").value =
                    item.Nbr_reserver_retour;
                document.getElementById("id_prg").value = item.id;
                ref_programme = item.ref_programme;
                id_programme = item.id;
            });
            // liste_Hotels_prg(id_programme, FKdossier,ref_programme);
        },
    });
    // liste vole depart
    liste_Hotels_prg(value, FKdossier);
    liste_Itineraire(value);
    Liste_service(value);
});
// liste ref prg
function liste_ref_prgt(ref_dossier) {
    jQuery.ajax({
        url: "/liste_programme/" + ref_dossier,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_allot = "";
            cptnv = 0;
            jQuery.each(
                responce.liste_gestion_programmes,
                function (key, item) {
                    $select_allot =
                        $select_allot +
                        '<option value="' +
                        item.id +
                        '">' +
                        item.ref_programme +
                        "</option>";

                    if (cptnv < item.ref_programme) {
                        cptnv = item.ref_programme;
                    }
                }
            );
            $("#ref_programme").html($select_allot);
        },
    });
}
// btn Nouveau
function Nouveau_prg() {
    cptnv = parseInt(cptnv) + 1;

    $("#ref_programme").append(
        '<option value="' +
            cptnv +
            '" selected="selected">' +
            cptnv +
            "</option>"
    );
    // vider input
    document.getElementById("nom_programme").value = "";
    document.getElementById("type_programme").value = "";
    document.getElementById("nbr_nuitee_prog_mdina").value = "";
    document.getElementById("nbr_nuitee_prog_maka").value = "";
    document.getElementById("num_vole_dep").value = "";
    document.getElementById("nbr_place_aller").value = "";
    document.getElementById("nbr_reserver_dep").value = "";
    document.getElementById("nbr_place_retour").value = "";
    document.getElementById("nbr_reserver_retour").value = "";
    document.getElementById("id_prg").value = "";

    // Hotels du programme
    jQuery.ajax({
        url: "/liste_hotel_prg",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $ligneVoleDepart = "";
            jQuery.each(responce.jsonlisteVoledepart, function (key, item) {
                $ligneVoleDepart = $ligneVoleDepart;
            });
            $("#liste_hotel_prg").html($ligneVoleDepart);
        },
    });
    // Itinéraire & informations supplémentaires
    jQuery.ajax({
        url: "/liste_Itineraire",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $lignes = "";
            jQuery.each(responce.jsonlisteVoleRetour, function (key, item) {
                $lignes = $lignes;
            });
            $("#liste_itieraire").html($lignes);
        },
    });
    // Service_Stores
    jQuery.ajax({
        url: "/Service_Stores",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $lignes = "";
            jQuery.each(responce.infos_service, function (key, item) {
                $lignes = $lignes;
            });
            $("#listes_service").html($lignes);
        },
    });
}
// Gestion hotel prg
$(document).ready(function () {
    // info_prg();
    var v = window.location.href;
    var ref_dossier = v.split("/")[4];
    liste_ref_prgt(ref_dossier);
    // ******Ajouter Hotels******
    $("#detail_hotel_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var FKdossier = document.getElementById("FKdossier").value;
        var ref_prog = parseInt($("#id_prg").val());
        var bnr_chambre = parseInt($("#bnr_chambre").val());
        var type_chambre_prg = parseInt($("#type_chambre_prg").val());
        var Totale_place=bnr_chambre*type_chambre_prg;
        document.getElementById("Totale_place").value=Totale_place;
   
        formData.push({
            name: "ref_programme",
            value: ref_prog,
        });
        formData.push({
            name: "Totale_place",
            value: Totale_place,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                liste_Hotels_prg(ref_prog, FKdossier);
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******update Hotels******
    $("#update_hotel_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var FKdossier = document.getElementById("FKdossier").value;
        var ref_prog = $("#id_prg").val();
        //formData.push({ name: "NFACT", value: NFACT },{ name: "nserieselect", value: nserieselect });
        //var formData = $('#form_allo1').serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                jQuery("#Hotel-footer-modal-preview").trigger("click");
                liste_Hotels_prg(ref_prog, FKdossier);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******Delete Hotels******
    $("#delete_hotel_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var ref_prog = $("#id_prg").val();
        var FKdossier = document.getElementById("FKdossier").value;
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                jQuery("#delete-hotel-prg-modal").trigger("click");
                liste_Hotels_prg(ref_prog, FKdossier);
            },
            error: function (response) {
                toastr.error("Contacter le serice IT");
            },
        });
    });
    jQuery(".etoile").change(function () {
        var value = $(this).val();
        jQuery.ajax({
            url: "/liste_hotel_transport/" + value,
            type: "GET", // Le nom du fichier indiqué dans le formulaire
            dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (responce) {
                // Je récupère la réponse du fichier PHP
                const nv = responce.listehotelTransport;
                document.getElementById("nbr_etoile").value = nv.categorie;
            },
        });
    });
    // ******Ajouter Programme******
    $("#form_gestion_prog").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var FK_dossier = ref_dossier;
        // console.log("this", ref_dossier);
        formData.push({
            name: "FK_dossier",
            value: FK_dossier,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // alert(response.update_gestion_prg);
                jQuery.each(response.update_gestion_prg, function (key, item) {
                    // alert(item.id);
                    document.getElementById("id_prg").value = item.id;
                    // console.log(document.getElementById("id_prg").value);
                });
                // alert("oki");
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de Vérifier les champs");
            },
        });
    });
});

// _______________________________________
// Gestion itineraire prg
// function de rechercher par FK_prg
function liste_Itineraire(value) {
    jQuery.ajax({
        url: "/Itineraire_infos/" + value,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.infos_Itinerair, function (key, item) {
                $tabledata = responce.infos_Itinerair;
            });
            var table = new Tabulator("#liste_itieraire", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 5,
                printHeader:
                    '<div class="center intro-x w-10 h-10 image-fit">\n <img alt="Midone - HTML Admin Template" class="rounded-full " src="dist/images/download.jpg">\n  </div>  <h1 style=\'color:#92400e; margin-left:10px;\'>عمرة رمضان موسم 2023 </h1>    \n ',
                printFooter:
                    "<h3>28,Bd Hassane Bnou Tabit - Hay Ezzahraa - Berrchid - 26100 - Maroc Tél.:05 22 32 80 50/52 - Fax: 05 22 32 55 11 - E-mail: info@almaqamtrips.com</h3>",

                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "Aucun enregistrements correspondants trouvés",
                tooltips: true,
                columns: [
                    {
                        title: "Date retour",
                        minWidth: 100,
                        responsive: 0,
                        field: "date_retour_Itineraire",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,
                        //         formatter(cell, formatterParams) {
                        //             return `<div>
                        //     <div class="font-medium whitespace-nowrap">${
                        //         cell.getData().nom_dossier
                        //     }</div>
                        //     <div class="text-slate-500 text-xs whitespace-nowrap">${
                        //         cell.getData().hijri_date
                        //     }</div>
                        // </div>`;
                        //         },
                    },
                    {
                        title: "Ville",
                        minWidth: 100,
                        field: "ville_Itineraire",
                        sorter: "number",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Transport",
                        field: "Transport_Itineraire",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Itinéraire",
                        field: "itineraire_programme",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Action",
                        minWidth: 110,
                        field: "actions",
                        responsive: 0,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                                    <button  class="edit text-primary flex items-center mr-3 tooltip"  title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#itinerair-footer-modal-preview">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                                    </button>
                                    <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-itinerair-prg-modal">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                    </a>
                                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/update_info_itineraire/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv =
                                                responce.infos_itineraire;
                                            document.getElementById(
                                                "up_id_Itineraire"
                                            ).value = nv.id;
                                            document.getElementById(
                                                "up_date_retour_Itineraire_"
                                            ).value = nv.date_retour_Itineraire;
                                            document.getElementById(
                                                "up_ville_Itineraire_"
                                            ).value = nv.ville_Itineraire;
                                            document.getElementById(
                                                "up_Transport_Itineraire_"
                                            ).value = nv.Transport_Itineraire;
                                            document.getElementById(
                                                "up_itineraire_programme_"
                                            ).value = nv.itineraire_programme;
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/update_info_itineraire/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            const nv =
                                                responce.infos_itineraire;
                                            document.getElementById(
                                                "id_delet_itineraire"
                                            ).value = nv.id;
                                        },
                                    });
                                });

                            $(a)
                                .find(".view")
                                .on("click", function () {
                                    window.location.replace(
                                        "/liste_prog/" + cell.getData().id
                                    );
                                });

                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Date retour",
                        field: "date_retour_Itineraire",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Ville",
                        field: "ville_Itineraire",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Itinéraire",
                        field: "itineraire_programme",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Transport",
                        field: "Transport_Itineraire",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowDblClick: function (e, row) {
                    // window.location.replace("/liste_prog/" + row.getData().id);
                },
            });
            // Redraw table onresize
            window.addEventListener("resize", () => {
                // table.redraw();
                // createIcons({
                //     icons,
                //     "stroke-width": 1.5,
                //     nameAttr: "data-lucide",
                // });
            });
            // Filter function
            function filterHTMLForm() {
                let field = $("#tabulator-html-filter-field").val();
                let type = $("#tabulator-html-filter-type").val();
                let value = $("#tabulator-html-filter-value").val();
                table.setFilter(field, type, value);
            }
            // On submit filter form
            $("#tabulator-html-filter-form")[0].addEventListener(
                "keypress",
                function (event) {
                    let keycode = event.keyCode ? event.keyCode : event.which;
                    if (keycode == "13") {
                        event.preventDefault();
                        filterHTMLForm();
                    }
                }
            );
            // On click go button
            $("#tabulator-html-filter-go").on("click", function (event) {
                filterHTMLForm();
            });

            // On reset filter form
            $("#tabulator-html-filter-reset").on("click", function (event) {
                $("#tabulator-html-filter-field").val("name");
                $("#tabulator-html-filter-type").val("like");
                $("#tabulator-html-filter-value").val("");
                filterHTMLForm();
            });
            // Export
            $("#tabulator-export-csv").on("click", function (event) {
                table.download("csv", "data.csv");
            });
            $("#tabulator-export-json").on("click", function (event) {
                table.download("json", "data.json");
            });

            $("#tabulator-export-xlsx").on("click", function (event) {
                window.XLSX = xlsx;
                table.download("xlsx", "data.xlsx", {
                    sheetName: "Products",
                });
            });

            $("#tabulator-export-html").on("click", function (event) {
                table.download("html", "data.html", {
                    style: true,
                });
            });
            // Print
            $("#tabulator-print-Itineraire").on("click", function (event) {
                table.print();
            });
        },
    });
}
$(document).ready(function () {
    jQuery("#Transport_Itineraire").change(function () {
        var value = $(this).val();
        jQuery.ajax({
            url: "/liste_hotel_transport/" + value,
            type: "GET", // Le nom du fichier indiqué dans le formulaire
            dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (responce) {
                // Je récupère la réponse du fichier PHP
                const nv = responce.listehotelTransport;
                document.getElementById("type_Transport").value = nv.type;
            },
        });
    });
    liste_hotel_transport();
    // ******Ajouter itineraire******
    $("#detail_Itineraire_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var ref_prog = $("#ref_programme").val();
        formData.push({
            name: "ref_programme",
            value: ref_prog,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                liste_Itineraire(ref_prog);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******update Hotels******
    $("#update_itinerair").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var ref_prog = $("#ref_programme").val();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#itinerair-footer-modal-preview").trigger("click");
                liste_Itineraire(ref_prog);
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******Delete Hotels******
    $("#delete_itinerair_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var ref_prog = $("#ref_programme").val();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#delete-itinerair-prg-modal").trigger("click");
                liste_Itineraire(ref_prog);
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error("contacter le service IT");
            },
        });
    });
});
// liste ref prg
function liste_hotel_transport() {
    jQuery.ajax({
        url: "/liste_hotel_transport",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $liste_transport = "";
            jQuery.each(responce.liste_hotel_transport, function (key, item) {
                $liste_transport =
                    $liste_transport +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nom +
                    "</option>";
            });
            $("#Transport_Itineraire").html($liste_transport);
        },
    });
}
// ______________________________
/*******gestion service programme */
// _______________________________________
function Liste_service(value) {
    jQuery.ajax({
        url: "/Service_Stores/" + value,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.infos_service, function (key, item) {
                $tabledata = responce.infos_service;
            });
            var table = new Tabulator("#listes_service", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 5,
                printHeader:
                    '<div class="center intro-x w-10 h-10 image-fit">\n <img alt="Midone - HTML Admin Template" class="rounded-full " src="dist/images/download.jpg">\n  </div>  <h1 style=\'color:#92400e; margin-left:10px;\'>عمرة رمضان موسم 2023 </h1>    \n ',
                printFooter:
                    "<h3>28,Bd Hassane Bnou Tabit - Hay Ezzahraa - Berrchid - 26100 - Maroc Tél.:05 22 32 80 50/52 - Fax: 05 22 32 55 11 - E-mail: info@almaqamtrips.com</h3>",

                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "Aucun enregistrements correspondants trouvés",
                tooltips: true,
                columns: [
                    {
                        title: "Ville",
                        minWidth: 100,
                        responsive: 0,
                        field: "villes",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,
                        //         formatter(cell, formatterParams) {
                        //             return `<div>
                        //     <div class="font-medium whitespace-nowrap">${
                        //         cell.getData().nom_dossier
                        //     }</div>
                        //     <div class="text-slate-500 text-xs whitespace-nowrap">${
                        //         cell.getData().hijri_date
                        //     }</div>
                        // </div>`;
                        //         },
                    },
                    {
                        title: "Hotel fournisseur",
                        minWidth: 100,
                        field: "hotel_fournisseur",
                        sorter: "number",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },

                    {
                        title: "Service",
                        field: "Service",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Action",
                        minWidth: 110,
                        field: "actions",
                        responsive: 0,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                                    <button  class="edit text-primary flex items-center mr-3 tooltip" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#service-footer-modal-preview">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                                    </button>
                                    <a class="delete flex items-center text-danger tooltip" href="javascript:;" title="Supprimer" data-tw-toggle="modal" data-tw-target="#delete-service-prg-modal">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                    </a>
                                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/update_info_service/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv = responce.infos_service;
                                            document.getElementById(
                                                "up_id_service"
                                            ).value = nv.id;
                                            document.getElementById(
                                                "Transport_Itineraire"
                                            ).value = nv.hotel_fournisseur;
                                            document.getElementById(
                                                "up_ville_service"
                                            ).value = nv.villes;
                                            document.getElementById(
                                                "up_service_prog"
                                            ).value = nv.Service;
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/update_info_service/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            const nv = responce.infos_service;
                                            document.getElementById(
                                                "id_delet_service"
                                            ).value = nv.id;
                                        },
                                    });
                                });
                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "ville",
                        field: "villes",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Hotel fournisseur",
                        field: "hotel_fournisseur",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Service",
                        field: "Service",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowDblClick: function (e, row) {
                    // window.location.replace("/liste_prog/" + row.getData().id);
                },
            });
            // Redraw table onresize
            window.addEventListener("resize", () => {
                // table.redraw();
                // createIcons({
                //     icons,
                //     "stroke-width": 1.5,
                //     nameAttr: "data-lucide",
                // });
            });
            // Filter function
            function filterHTMLForm() {
                let field = $("#tabulator-html-filter-field").val();
                let type = $("#tabulator-html-filter-type").val();
                let value = $("#tabulator-html-filter-value").val();
                table.setFilter(field, type, value);
            }
            // On submit filter form
            $("#tabulator-html-filter-form")[0].addEventListener(
                "keypress",
                function (event) {
                    let keycode = event.keyCode ? event.keyCode : event.which;
                    if (keycode == "13") {
                        event.preventDefault();
                        filterHTMLForm();
                    }
                }
            );
            // On click go button
            $("#tabulator-html-filter-go").on("click", function (event) {
                filterHTMLForm();
            });

            // On reset filter form
            $("#tabulator-html-filter-reset").on("click", function (event) {
                $("#tabulator-html-filter-field").val("name");
                $("#tabulator-html-filter-type").val("like");
                $("#tabulator-html-filter-value").val("");
                filterHTMLForm();
            });
            // Export
            $("#tabulator-export-csv").on("click", function (event) {
                table.download("csv", "data.csv");
            });
            $("#tabulator-export-json").on("click", function (event) {
                table.download("json", "data.json");
            });

            $("#tabulator-export-xlsx").on("click", function (event) {
                window.XLSX = xlsx;
                table.download("xlsx", "data.xlsx", {
                    sheetName: "Products",
                });
            });

            $("#tabulator-export-html").on("click", function (event) {
                table.download("html", "data.html", {
                    style: true,
                });
            });
            // Print
            $("#tabulator-print-service").on("click", function (event) {
                table.print();
            });
        },
    });
}
$(document).ready(function () {
    // ******Ajouter service_prg******
    $("#detail_service_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var ref_prog = $("#ref_programme").val();
        formData.push({
            name: "ref_programme",
            value: ref_prog,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                Liste_service(ref_prog);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******Delete Service******
    $("#delete_service_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var ref_prog = $("#ref_programme").val();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#delete-service-prg-modal").trigger("click");
                Liste_service(ref_prog);
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error("contacter le service IT");
            },
        });
    });
    // ******update service******
    $("#update_service").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var ref_prog = $("#ref_programme").val();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#service-footer-modal-preview").trigger("click");
                Liste_service(ref_prog);
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
});
function getCSRFToken() {
    var cookieValue = null;
    if (document.cookie && document.cookie !== "") {
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.substring(0, "csrftoken=".length) === "csrftoken=") {
                cookieValue = decodeURIComponent(
                    cookie.substring("csrftoken=".length)
                );
                break;
            }
        }
    }
    return cookieValue;
}

function liste_Hotels_prg(value, Fkdossier) {
    jQuery.ajax({
        url: "/infos_hotel_prog/" + value + "/" + Fkdossier,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            var printIcon = function (cell, formatterParams, status) {
                if (status) {
                    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';
                } else {
                    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg>';
                }
            };
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.infos_hotel_prog, function (key, item) {
                $tabledata = responce.infos_hotel_prog;
                // console.log($tabledata);
            });
            var tables = new Tabulator("#liste_hotel_prg", {
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
                placeholder: "Aucun enregistrements correspondants trouvés",
                tooltips: true,
                columns: [
                    {
                        title: "Nom Hotel",
                        minWidth: 40,
                        minWidth: 30,
                        responsive: 0,
                        field: "hotel_prg",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,

                        //         formatter(cell, formatterParams) {
                        //             return `<div>
                        //     <div class="font-medium whitespace-nowrap">${
                        //         cell.getData().nom_dossier
                        //     }</div>
                        //     <div class="text-slate-500 text-xs whitespace-nowrap">${
                        //         cell.getData().hijri_date
                        //     }</div>
                        // </div>`;
                        //         },
                    },
                    {
                        title: "Ville",
                        minWidth: 100,
                        field: "ville_Hotel_prg",
                        sorter: "number",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },

                    {
                        title: "Date début",
                        field: "date_depar_hotel",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Date Fin",
                        field: "date_retour_hotel",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    // {
                    //     title: "Régime",
                    //     field: "regime_prg",
                    //     minWidth: 100,
                    //     responsive: 0,
                    //     sorter: "number",
                    //     hozAlign: "center",
                    //     print: false,
                    //     download: false,
                    // },
                    {
                        title: "Type chambre",
                        field: "type_chambre_prg",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                        editor: "select",
                        editorParams: {
                            values: {
                                Single: "Single",
                                Double: "Double",
                                Triple: "Triple",
                                Quadruple: "Quadruple",
                                Quintuple: "Quintuple",
                                sixtuple: "sixtuple",
                            },
                        },
                        cellEdited: function (cell) {
                            var id = cell.getData().id;
                            var type_chambre_prg =
                                cell.getData().type_chambre_prg;
                            var data_type_chambre = {
                                name: "type_chambre_prg",
                                value: type_chambre_prg,
                            };
                            //    console.log(data_type_chambre);
                            // *** debut ***
                            var id_hotel_prg = cell.getData().id;

                            // *** fin ****
                            jQuery.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                            });
                            jQuery.ajax({
                                url: "/update_type_chambre/" + id_hotel_prg,
                                type: "POST", // Le nom du fichier indiqué dans le formulaire
                                data: data_type_chambre, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)

                                // dataFilter: 'json', //forme data
                                success: function (response) {
                                    // Je récupère la réponse du fichier PHP
                                    toastr.success(response.message);
                                },
                                error: function (response) {
                                    toastr.error("Vérifier votre données");
                                    // toastr.error(response.error);
                                },
                            });
                        },
                    },
                    // {
                    //     title: "Prix Achat",
                    //     field: "prix_achat_prg",
                    //     minWidth: 100,
                    //     responsive: 0,
                    //     sorter: "number",
                    //     hozAlign: "center",
                    //     print: false,
                    //     download: false,
                    // },
                    {
                        title: "Prix prg",
                        field: "prix_prg",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Totale place",
                        field: "Totale_place",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Num chambre",
                        field: "num_chambre",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        editor: "input",
                        print: false,
                        download: false,
                        cellEdited: function (cell) {
                            var id = cell.getData().id;
                            var num_chambre = cell.getData().num_chambre;
                            var data = {
                                name: "num_chambre",
                                num_chambre: num_chambre,
                            };

                            //   ajax
                            jQuery.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                            });
                            jQuery.ajax({
                                url: "/updat_prg_chamb/" + id,
                                type: "POST", // Le nom du fichier indiqué dans le formulaire
                                data: data, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)

                                // dataFilter: 'json', //forme data
                                success: function (response) {
                                    // Je récupère la réponse du fichier PHP
                                    toastr.success(response.message);
                                },
                                error: function (response) {
                                    toastr.error("Vérifier votre données");
                                    // toastr.error(response.error);
                                },
                            });
                            // jQuery.ajax({
                            //     url: "updat_prg_chamb/" + id,
                            //     headers: {
                            //         Authorization:
                            //             localStorage.getItem("token"),
                            //     },

                            //     type: "post",
                            //     data: data,
                            //     beforeSend: function (xhr) {
                            //         xhr.setRequestHeader(
                            //             "Authorization",
                            //             "Bearer t-7614f875-8423-4f20-a674-d7cf3096290e"
                            //         );
                            //     },
                            //     success: function (response) {
                            //         console.log("Data updated successfully");
                            //     },
                            //     error: function (xhr, status, error) {
                            //         console.log("Error updating data:", error);
                            //     },
                            // });
                        },
                    },
                    {
                        title: "Action",
                        minWidth: 110,
                        field: "actions",
                        responsive: 0,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                                <button  class="view flex items-center mr-3 tooltip" title="Réserver" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="lucide lucide-eye w-4 h-4 mr-1  fill=" none"="" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </button>

                                <button  class="edit text-primary flex items-center mr-3 tooltip" href="javascript:;" data-tw-toggle="modal" data-tw-target="#Hotel-footer-modal-preview" title="Modifier">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                                </button>

                                <a class="delete flex items-center text-danger tooltip" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-hotel-prg-modal"  title="Supprimer">
                                   <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                </a>
                 
                            </div>`);

                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/hotel_prg_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv = responce.infos_hotel;
                                            document.getElementById(
                                                "up_id_hotel"
                                            ).value = nv.id;
                                            document.getElementById(
                                                "up_ref_Hotels_prog_"
                                            ).value = nv.ref_Hotels_prog;
                                            document.getElementById(
                                                "up_ville_Hotel_prg_"
                                            ).value = nv.ville_Hotel_prg;
                                            document.getElementById(
                                                "up_date_retour_hotel_"
                                            ).value = nv.date_retour_hotel;
                                            document.getElementById(
                                                "up_date_depart_hotel_"
                                            ).value = nv.date_depar_hotel;
                                            document.getElementById(
                                                "up_hotel_prg_"
                                            ).value = nv.hotel_prg;
                                            document.getElementById(
                                                "up_bnr_nuits_prg_"
                                            ).value = nv.bnr_nuits_prg;
                                            document.getElementById(
                                                "up_regime_prg_"
                                            ).value = nv.regime_prg;
                                            document.getElementById(
                                                "up_type_chambre_prg_"
                                            ).value = nv.type_chambre_prg;
                                            document.getElementById(
                                                "up_chambre_prg_"
                                            ).value = nv.chambre_prg;
                                            document.getElementById(
                                                "up_prix_achat_prg_"
                                            ).value = nv.prix_achat_prg;
                                            document.getElementById(
                                                "up_prix_vente_prg_"
                                            ).value = nv.prix_vente_prg;
                                            document.getElementById(
                                                "up_prix_prg_"
                                            ).value = nv.prix_prg;
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/hotel_infos_Delet/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            const nv = responce.infos_hotel;
                                            document.getElementById(
                                                "id_delet_hotel"
                                            ).value = nv.id;
                                        },
                                    });
                                });

                            $(a)
                                .find(".view")
                                .on("click", function () {
                                    window.location.replace(
                                        "/Reservation/" +
                                            cell.getData().FK_programme
                                    );
                                });

                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Réf Hotel",
                        field: "ref_Hotels_prog",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Ville",
                        field: "ville_Hotel_prg",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date départ",
                        field: "date_depar_hotel",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date retour",
                        field: "date_retour_hotel",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Régime",
                        field: "regime_prg",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Type chambre",
                        field: "type_chambre_prg",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Prix Achat",
                        field: "prix_achat_prg",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Prix prg",
                        field: "prix_prg",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowFormatter: function (row) {
                    // console.log(row.getData());
                    if (row.getData().Genre === "Femme") {
                        const children = row.getElement().childNodes;
                        children.forEach((child) => {
                            child.style.backgroundColor =
                                "rgba(233, 30, 99, 0.1)";
                        });
                    } else {
                        if (row.getData().Genre === "Homme") {
                            const children = row.getElement().childNodes;
                            children.forEach((child) => {
                                child.style.backgroundColor =
                                    "rgba(3, 169, 244, 0.1)";
                            });
                        }
                    }
                },
                // rowClick: function (e, row) {
                //     // window.location.replace("/liste_prog/" + row.getData().id);
                //     console.log("has value " + row.getData().num_chambre);
                // },
                // cellEdited: function(cell) {
                //     if (cell.getColumn().getField() === "value") {
                //       // Call a function or perform any other action
                //       console.log("Cell edited and lost focus!");
                //     }
                //   }
            });

            // var cell = table.getCell(0, "name");
            // var input = cell.getCellEditor().getElement();
            // var value = input.value;
            // console.log(value);

            // Redraw table onresize
            window.addEventListener("resize", () => {
                // tables.redraw();
                // createIcons({
                //     icons,
                //     "stroke-width": 1.5,
                //     nameAttr: "data-lucide",
                // });
            });
            // Filter function
            function filterHTMLForm() {
                let field = $("#tabulator-html-filter-field").val();
                let type = $("#tabulator-html-filter-type").val();
                let value = $("#tabulator-html-filter-value").val();
                tables.setFilter(field, type, value);
            }
            // On submit filter form
            $("#tabulator-html-filter-form")[0].addEventListener(
                "keypress",
                function (event) {
                    let keycode = event.keyCode ? event.keyCode : event.which;
                    if (keycode == "13") {
                        event.preventDefault();
                        filterHTMLForm();
                    }
                }
            );
            // On click go button
            $("#tabulator-html-filter-go").on("click", function (event) {
                filterHTMLForm();
            });

            // On reset filter form
            $("#tabulator-html-filter-reset").on("click", function (event) {
                $("#tabulator-html-filter-field").val("name");
                $("#tabulator-html-filter-type").val("like");
                $("#tabulator-html-filter-value").val("");
                filterHTMLForm();
            });
            // Export
          
            $("#tabulator-export-json").on("click", function (event) {
                tables.download("json", "data.json");
            });

            $("#tabulator-export-xlsx").on("click", function (event) {
               
                tables.download("xlsx", "data.xlsx", {
                    sheetName: "Products",
                });
            });

           
            // Print
            $("#tabulator-print-Hotels-programme").on(
                "click",
                function (event) {
                    tables.print();
                }
            );
        },
    });
}
function updateName(id, newName) {
    // get the row with the given ID
    var row = tables.getRow(id);
    if (row) {
        // update the data for the row
        var newData = { id: id, name: newName };
        row.update(newData);

        // make an AJAX request to update the data in the database
        $.ajax({
            url: "/update-data.php",
            type: "POST",
            data: newData,
            success: function (response) {
                console.log("Data updated successfully");
            },
            error: function (xhr, status, error) {
                console.log("Error updating data:", error);
            },
        });
    }
}
// function Delete_service(id) {
//     jQuery.ajax({
//         url: "/update_info_service/" + id,
//         type: "GET", // Le nom du fichier indiqué dans le formulaire
//         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//         // dataFilter: 'json', //forme data
//         success: function (responce) {
//             const nv = responce.infos_service;
//             document.getElementById("id_delet_service").value = nv.id;
//         },
//     });
// }

// function showDialogueModifier_service(id) {
//     jQuery.ajax({
//         url: "/update_info_service/" + id,
//         type: "GET", // Le nom du fichier indiqué dans le formulaire
//         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//         // dataFilter: 'json', //forme data
//         success: function (responce) {
//             // Je récupère la réponse du fichier PHP
//             const nv = responce.infos_service;
//             document.getElementById("up_id_service").value = nv.id;
//             document.getElementById("Transport_Itineraire").value =
//                 nv.hotel_fournisseur;
//             document.getElementById("up_ville_service").value = nv.villes;
//             document.getElementById("up_service_prog").value = nv.Service;
//         },
//     });
// }
// show info itineraire for updated
// function showDialogueModifier_itineraire(id_retour) {
//     jQuery.ajax({
//         url: "/update_info_itineraire/" + id_retour,
//         type: "GET", // Le nom du fichier indiqué dans le formulaire
//         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//         // dataFilter: 'json', //forme data
//         success: function (responce) {
//             // Je récupère la réponse du fichier PHP
//             const nv = responce.infos_itineraire;
//             document.getElementById("up_id_Itineraire").value = nv.id;
//             document.getElementById("up_date_retour_Itineraire").value =
//                 nv.date_retour_Itineraire;
//             document.getElementById("up_ville_Itineraire").value =
//                 nv.ville_Itineraire;
//             document.getElementById("up_Transport_Itineraire").value =
//                 nv.Transport_Itineraire;
//             document.getElementById("up_itineraire_programme").value =
//                 nv.itineraire_programme;
//         },
//     });
// }
// show info itineraire for deleted
// function Delete_itineraire(id) {
//     jQuery.ajax({
//         url: "/update_info_itineraire/" + id,
//         type: "GET", // Le nom du fichier indiqué dans le formulaire
//         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//         // dataFilter: 'json', //forme data
//         success: function (responce) {
//             const nv = responce.infos_itineraire;
//             document.getElementById("id_delet_itineraire").value = nv.id;
//         },
//     });
// }
// ****** Delete Hotel *****
// function Delete_hotel_prg(id) {
//     jQuery.ajax({
//         url: "/hotel_infos_Delet/" + id,
//         type: "GET", // Le nom du fichier indiqué dans le formulaire
//         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//         // dataFilter: 'json', //forme data
//         success: function (responce) {
//             const nv = responce.infos_hotel;
//             document.getElementById("id_delet_hotel").value = nv.id;
//         },
//     });
// }
// function showDialogueModifier_hotel_prg(id_retour) {
//     jQuery.ajax({
//         url: "/hotel_prg_infos/" + id_retour,
//         type: "GET", // Le nom du fichier indiqué dans le formulaire
//         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//         // dataFilter: 'json', //forme data
//         success: function (responce) {
//             // Je récupère la réponse du fichier PHP
//             const nv = responce.infos_hotel;
//             document.getElementById("up_id_hotel").value = nv.id;
//             document.getElementById("up_ref_Hotels_prog").value =
//                 nv.ref_Hotels_prog;
//             document.getElementById("up_ville_Hotel_prg").value =
//                 nv.ville_Hotel_prg;
//             document.getElementById("up_date_retour_hotel").value =
//                 nv.date_retour_hotel;
//             document.getElementById("up_date_depart_hotel").value =
//                 nv.date_depar_hotel;
//             document.getElementById("up_hotel_prg").value = nv.hotel_prg;
//             document.getElementById("up_bnr_nuits_prg").value =
//                 nv.bnr_nuits_prg;
//             document.getElementById("up_regime_prg").value = nv.regime_prg;
//             document.getElementById("up_type_chambre_prg").value =
//                 nv.type_chambre_prg;
//             document.getElementById("up_chambre_prg").value = nv.chambre_prg;
//             document.getElementById("up_prix_achat_prg").value =
//                 nv.prix_achat_prg;
//             document.getElementById("up_prix_vente_prg").value =
//                 nv.prix_vente_prg;
//             document.getElementById("up_prix_prg").value = nv.prix_prg;
//         },
//     });
// }
// **************   29/03/2023
// function info_prg() {
//     var v = window.location.href;
//     var id = v.split("/")[4];

//     // input value
//     jQuery.ajax({
//         url: "/Programme_infos/" + id,
//         type: "GET",
//         dataType: "json",
//         success: function (responce) {
//             // affichage select
//             jQuery.each(responce.liste_programmes, function (key, item) {
//                 document.getElementById("ref_programme").value =
//                     item.ref_programme;
//                 document.getElementById("nom_programme").value =
//                     item.nom_programme;
//                 document.getElementById("type_programme").value =
//                     item.type_programme;
//                 document.getElementById("nbr_nuitee_prog_mdina").value =
//                     item.nbr_nuitee_prog_mdina;
//                 document.getElementById("nbr_nuitee_prog_maka").value =
//                     item.nbr_nuitee_prog_maka;
//                 document.getElementById("num_vole_dep").value =
//                     item.FK_Num_vole_depart;
//                 document.getElementById("nbr_place_aller").value =
//                     item.Nbr_place_aller;
//                 document.getElementById("nbr_reserver_dep").value =
//                     item.Nbr_reserver_depart;
//                 document.getElementById("num_vole_retour").value =
//                     item.FK_Num_vole_retour;
//                 document.getElementById("nbr_place_retour").value =
//                     item.Nbr_place_retour;
//                 document.getElementById("nbr_reserver_retour").value =
//                     item.Nbr_reserver_retour;
//                 document.getElementById("id_prg").value = item.id;
//             });
//         },
//     });
// }

// *********************
// function liste_Hotels_prg(value, Fkdossier, $ref_prg) {
//     jQuery.ajax({
//         url: "/infos_hotel_prog/" + value + "/" + Fkdossier + "/" + $ref_prg,
//         type: "GET", // Le nom du fichier indiqué dans le formulaire
//         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//         // dataFilter: 'json', //forme data
//         success: function (responce) {
//             var printIcon = function (cell, formatterParams, status) {
//                 if (status) {
//                     return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';
//                 } else {
//                     return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg>';
//                 }
//             };
//             // Je récupère la réponse du fichier PHP
//             $tabledata = "";
//             jQuery.each(responce.infos_hotel_prog, function (key, item) {
//                 $tabledata = responce.infos_hotel_prog;
//                 console.log($tabledata);
//             });
//             var tables = new Tabulator("#liste_hotel_prg", {
//                 printAsHtml: true,
//                 printStyled: true,
//                 // height: 220,
//                 data: $tabledata,
//                 layout: "fitColumns",
//                 pagination: "local",
//                 printHeader:
//                     '<div class="center intro-x w-10 h-10 image-fit">\n <img alt="Midone - HTML Admin Template" class="rounded-full " src="dist/images/download.jpg">\n  </div>  <h1 style=\'color:#92400e; margin-left:10px;\'>عمرة رمضان موسم 2023 </h1>    \n ',
//                 printFooter:
//                     "<h3>28,Bd Hassane Bnou Tabit - Hay Ezzahraa - Berrchid - 26100 - Maroc Tél.:05 22 32 80 50/52 - Fax: 05 22 32 55 11 - E-mail: info@almaqamtrips.com</h3>",

//                 paginationSize: 5,
//                 paginationSizeSelector: [10, 20, 30, 40],
//                 placeholder: "Aucun enregistrements correspondants trouvés",
//                 tooltips: true,
//                 columns: [
//                     {
//                         title: "Nom Hotel",
//                         minWidth: 40,
//                         minWidth: 30,
//                         responsive: 0,
//                         field: "hotel_prg",
//                         sorter: "string",
//                         vertAlign: "middle",
//                         col: "red",
//                         print: false,
//                         download: false,

//                         //         formatter(cell, formatterParams) {
//                         //             return `<div>
//                         //     <div class="font-medium whitespace-nowrap">${
//                         //         cell.getData().nom_dossier
//                         //     }</div>
//                         //     <div class="text-slate-500 text-xs whitespace-nowrap">${
//                         //         cell.getData().hijri_date
//                         //     }</div>
//                         // </div>`;
//                         //         },
//                     },
//                     {
//                         title: "Ville",
//                         minWidth: 100,
//                         field: "ville_Hotel_prg",
//                         sorter: "number",
//                         hozAlign: "left",
//                         hozAlign: "center",
//                         vertAlign: "middle",
//                         print: false,
//                         download: false,
//                     },

//                     {
//                         title: "Date début",
//                         field: "date_depar_hotel",
//                         minWidth: 100,
//                         sorter: "string",
//                         hozAlign: "center",
//                         vertAlign: "middle",
//                         print: false,
//                         download: false,
//                     },
//                     {
//                         title: "Date Fin",
//                         field: "date_retour_hotel",
//                         minWidth: 100,
//                         responsive: 0,
//                         sorter: "number",
//                         hozAlign: "center",
//                         print: false,
//                         download: false,
//                     },
//                     // {
//                     //     title: "Régime",
//                     //     field: "regime_prg",
//                     //     minWidth: 100,
//                     //     responsive: 0,
//                     //     sorter: "number",
//                     //     hozAlign: "center",
//                     //     print: false,
//                     //     download: false,
//                     // },
//                     {
//                         title: "Type chambre",
//                         field: "type_chambre_prg",
//                         minWidth: 100,
//                         responsive: 0,
//                         sorter: "number",
//                         hozAlign: "center",
//                         print: false,
//                         download: false,
//                         editor: "select",
//                         editorParams: {
//                             values: {
//                                 Single: "Single",
//                                 Double: "Double",
//                                 Triple: "Triple",
//                                 Quadruple: "Quadruple",
//                                 Quintuple: "Quintuple",
//                                 sixtuple: "sixtuple",
//                             },
//                         },
//                         cellEdited: function (cell) {
//                             var id = cell.getData().id;
//                             var type_chambre_prg =
//                                 cell.getData().type_chambre_prg;
//                             var data_type_chambre = {
//                                 name: "type_chambre_prg",
//                                 value: type_chambre_prg,
//                             };
//                             //    console.log(data_type_chambre);
//                             // *** debut ***
//                             var id_hotel_prg = cell.getData().id;

//                             // *** fin ****
//                             jQuery.ajaxSetup({
//                                 headers: {
//                                     "X-CSRF-TOKEN": $(
//                                         'meta[name="csrf-token"]'
//                                     ).attr("content"),
//                                 },
//                             });
//                             jQuery.ajax({
//                                 url: "/update_type_chambre/" + id_hotel_prg,
//                                 type: "POST", // Le nom du fichier indiqué dans le formulaire
//                                 data: data_type_chambre, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)

//                                 // dataFilter: 'json', //forme data
//                                 success: function (response) {
//                                     // Je récupère la réponse du fichier PHP
//                                     toastr.success(response.message);
//                                 },
//                                 error: function (response) {
//                                     toastr.error("Vérifier votre données");
//                                     // toastr.error(response.error);
//                                 },
//                             });
//                         },
//                     },
//                     // {
//                     //     title: "Prix Achat",
//                     //     field: "prix_achat_prg",
//                     //     minWidth: 100,
//                     //     responsive: 0,
//                     //     sorter: "number",
//                     //     hozAlign: "center",
//                     //     print: false,
//                     //     download: false,
//                     // },
//                     {
//                         title: "Prix prg",
//                         field: "prix_prg",
//                         minWidth: 100,
//                         responsive: 0,
//                         sorter: "number",
//                         hozAlign: "center",
//                         print: false,
//                         download: false,
//                     },
//                     {
//                         title: "Num chambre",
//                         field: "num_chambre",
//                         minWidth: 100,
//                         responsive: 0,
//                         sorter: "number",
//                         hozAlign: "center",
//                         editor: "input",
//                         print: false,
//                         download: false,
//                         cellEdited: function (cell) {
//                             var id = cell.getData().id;
//                             var num_chambre = cell.getData().num_chambre;
//                             var data = {
//                                 name: "num_chambre",
//                                 num_chambre: num_chambre,
//                             };

//                             //   ajax
//                             jQuery.ajaxSetup({
//                                 headers: {
//                                     "X-CSRF-TOKEN": $(
//                                         'meta[name="csrf-token"]'
//                                     ).attr("content"),
//                                 },
//                             });
//                             jQuery.ajax({
//                                 url: "/updat_prg_chamb/" + id,
//                                 type: "POST", // Le nom du fichier indiqué dans le formulaire
//                                 data: data, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)

//                                 // dataFilter: 'json', //forme data
//                                 success: function (response) {
//                                     // Je récupère la réponse du fichier PHP
//                                     toastr.success(response.message);
//                                 },
//                                 error: function (response) {
//                                     toastr.error("Vérifier votre données");
//                                     // toastr.error(response.error);
//                                 },
//                             });
//                             // jQuery.ajax({
//                             //     url: "updat_prg_chamb/" + id,
//                             //     headers: {
//                             //         Authorization:
//                             //             localStorage.getItem("token"),
//                             //     },

//                             //     type: "post",
//                             //     data: data,
//                             //     beforeSend: function (xhr) {
//                             //         xhr.setRequestHeader(
//                             //             "Authorization",
//                             //             "Bearer t-7614f875-8423-4f20-a674-d7cf3096290e"
//                             //         );
//                             //     },
//                             //     success: function (response) {
//                             //         console.log("Data updated successfully");
//                             //     },
//                             //     error: function (xhr, status, error) {
//                             //         console.log("Error updating data:", error);
//                             //     },
//                             // });
//                         },
//                     },
//                     {
//                         title: "Action",
//                         minWidth: 110,
//                         field: "actions",
//                         responsive: 0,
//                         hozAlign: "center",
//                         vertAlign: "middle",
//                         print: false,
//                         download: false,
//                         formatter(cell, formatterParams) {
//                             let a =
//                                 $(`<div class="flex lg:justify-center items-center">
//                                 <button  class="view flex items-center mr-3 tooltip" title="Réserver" href="javascript:;">
//                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="lucide lucide-eye w-4 h-4 mr-1  fill=" none"="" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
//                                 </button>

//                                 <button  class="edit text-primary flex items-center mr-3 tooltip" href="javascript:;" data-tw-toggle="modal" data-tw-target="#Hotel-footer-modal-preview" title="Modifier">
//                                     <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
//                                 </button>

//                                 <a class="delete flex items-center text-danger tooltip" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-hotel-prg-modal"  title="Supprimer">
//                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
//                                 </a>

//                             </div>`);

//                             $(a)
//                                 .find(".edit")
//                                 .on("click", function () {
//                                     jQuery.ajax({
//                                         url:
//                                             "/hotel_prg_infos/" +
//                                             cell.getData().id,
//                                         type: "GET", // Le nom du fichier indiqué dans le formulaire
//                                         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//                                         // dataFilter: 'json', //forme data
//                                         success: function (responce) {
//                                             // Je récupère la réponse du fichier PHP
//                                             const nv = responce.infos_hotel;
//                                             document.getElementById(
//                                                 "up_id_hotel"
//                                             ).value = nv.id;
//                                             document.getElementById(
//                                                 "up_ref_Hotels_prog"
//                                             ).value = nv.ref_Hotels_prog;
//                                             document.getElementById(
//                                                 "up_ville_Hotel_prg"
//                                             ).value = nv.ville_Hotel_prg;
//                                             document.getElementById(
//                                                 "up_date_retour_hotel"
//                                             ).value = nv.date_retour_hotel;
//                                             document.getElementById(
//                                                 "up_date_depart_hotel"
//                                             ).value = nv.date_depar_hotel;
//                                             document.getElementById(
//                                                 "up_hotel_prg"
//                                             ).value = nv.hotel_prg;
//                                             document.getElementById(
//                                                 "up_bnr_nuits_prg"
//                                             ).value = nv.bnr_nuits_prg;
//                                             document.getElementById(
//                                                 "up_regime_prg"
//                                             ).value = nv.regime_prg;
//                                             document.getElementById(
//                                                 "up_type_chambre_prg"
//                                             ).value = nv.type_chambre_prg;
//                                             document.getElementById(
//                                                 "up_chambre_prg"
//                                             ).value = nv.chambre_prg;
//                                             document.getElementById(
//                                                 "up_prix_achat_prg"
//                                             ).value = nv.prix_achat_prg;
//                                             document.getElementById(
//                                                 "up_prix_vente_prg"
//                                             ).value = nv.prix_vente_prg;
//                                             document.getElementById(
//                                                 "up_prix_prg"
//                                             ).value = nv.prix_prg;
//                                         },
//                                     });
//                                 });

//                             $(a)
//                                 .find(".delete")
//                                 .on("click", function () {
//                                     jQuery.ajax({
//                                         url:
//                                             "/hotel_infos_Delet/" +
//                                             cell.getData().id,
//                                         type: "GET", // Le nom du fichier indiqué dans le formulaire
//                                         dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
//                                         // dataFilter: 'json', //forme data
//                                         success: function (responce) {
//                                             const nv = responce.infos_hotel;
//                                             document.getElementById(
//                                                 "id_delet_hotel"
//                                             ).value = nv.id;
//                                         },
//                                     });
//                                 });

//                             $(a)
//                                 .find(".view")
//                                 .on("click", function () {
//                                     window.location.replace(
//                                         "/Reservation/" +
//                                             cell.getData().FK_programme
//                                     );
//                                 });

//                             return a[0];
//                         },
//                     },
//                     // For print format
//                     {
//                         title: "Réf Hotel",
//                         field: "ref_Hotels_prog",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                     {
//                         title: "Ville",
//                         field: "ville_Hotel_prg",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                     {
//                         title: "Date départ",
//                         field: "date_depar_hotel",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                     {
//                         title: "Date retour",
//                         field: "date_retour_hotel",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                     {
//                         title: "Régime",
//                         field: "regime_prg",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                     {
//                         title: "Type chambre",
//                         field: "type_chambre_prg",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                     {
//                         title: "Prix Achat",
//                         field: "prix_achat_prg",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                     {
//                         title: "Prix prg",
//                         field: "prix_prg",
//                         visible: false,
//                         print: true,
//                         download: true,
//                     },
//                 ],
//                 rowFormatter: function (row) {
//                     // console.log(row.getData());
//                     if (row.getData().Genre === "Femme") {
//                         const children = row.getElement().childNodes;
//                         children.forEach((child) => {
//                             child.style.backgroundColor =
//                                 "rgba(233, 30, 99, 0.1)";
//                         });
//                     } else {
//                         if (row.getData().Genre === "Homme") {
//                             const children = row.getElement().childNodes;
//                             children.forEach((child) => {
//                                 child.style.backgroundColor =
//                                     "rgba(3, 169, 244, 0.1)";
//                             });
//                         }
//                     }
//                 },
//                 // rowClick: function (e, row) {
//                 //     // window.location.replace("/liste_prog/" + row.getData().id);
//                 //     console.log("has value " + row.getData().num_chambre);
//                 // },
//                 // cellEdited: function(cell) {
//                 //     if (cell.getColumn().getField() === "value") {
//                 //       // Call a function or perform any other action
//                 //       console.log("Cell edited and lost focus!");
//                 //     }
//                 //   }
//             });

//             // var cell = table.getCell(0, "name");
//             // var input = cell.getCellEditor().getElement();
//             // var value = input.value;
//             // console.log(value);

//             // Redraw table onresize
//             window.addEventListener("resize", () => {
//                 // tables.redraw();
//                 // createIcons({
//                 //     icons,
//                 //     "stroke-width": 1.5,
//                 //     nameAttr: "data-lucide",
//                 // });
//             });
//             // Filter function
//             function filterHTMLForm() {
//                 let field = $("#tabulator-html-filter-field").val();
//                 let type = $("#tabulator-html-filter-type").val();
//                 let value = $("#tabulator-html-filter-value").val();
//                 tables.setFilter(field, type, value);
//             }
//             // On submit filter form
//             $("#tabulator-html-filter-form")[0].addEventListener(
//                 "keypress",
//                 function (event) {
//                     let keycode = event.keyCode ? event.keyCode : event.which;
//                     if (keycode == "13") {
//                         event.preventDefault();
//                         filterHTMLForm();
//                     }
//                 }
//             );
//             // On click go button
//             $("#tabulator-html-filter-go").on("click", function (event) {
//                 filterHTMLForm();
//             });

//             // On reset filter form
//             $("#tabulator-html-filter-reset").on("click", function (event) {
//                 $("#tabulator-html-filter-field").val("name");
//                 $("#tabulator-html-filter-type").val("like");
//                 $("#tabulator-html-filter-value").val("");
//                 filterHTMLForm();
//             });
//             // Export
//             $("#tabulator-export-csv").on("click", function (event) {
//                 tables.download("csv", "data.csv");
//             });
//             $("#tabulator-export-json").on("click", function (event) {
//                 tables.download("json", "data.json");
//             });

//             $("#tabulator-export-xlsx").on("click", function (event) {
//                 window.XLSX = xlsx;
//                 tables.download("xlsx", "data.xlsx", {
//                     sheetName: "Products",
//                 });
//             });

//             $("#tabulator-export-html").on("click", function (event) {
//                 tables.download("html", "data.html", {
//                     style: true,
//                 });
//             });
//             // Print
//             $("#tabulator-print-Hotels-programme").on(
//                 "click",
//                 function (event) {
//                     tables.print();
//                 }
//             );
//         },
//     });
// }
