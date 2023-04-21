$(window).on("load", function () {
    var v = window.location.href;
    var cmt = v.split("/")[4];
    // console.log(cmt);
    if (v.split("/")[3] == "Allotement") {
        liste_allotement(cmt);
    } else {
        liste_allotement_id(cmt);
    }
    jQuery.ajax({
        url: "/vole_depart_index",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $ligneVoleDepart = "";
            jQuery.each(responce.jsonlisteVoledepart, function (key, item) {
                $ligneVoleDepart = $ligneVoleDepart;
            });
            $("#listeVoleDepart").html($ligneVoleDepart);
        },
    });
    jQuery.ajax({
        url: "/vole_retour_index/",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $lignes = "";
            jQuery.each(responce.jsonlisteVoleRetour, function (key, item) {
                $lignes = $lignes;
            });
            $("#listeVoleRetour").html($lignes);
        },
    });
    // liste vole départ
    showVoledepartspecifique(cmt);
    // liste vole retour
    showVoleRetourspecifique(cmt);
    // liste allotement
    show_allotement(cmt);
    // liste compagnie(
    liste_compagnie();
});
// selecte change
$("#num_allot").change(function () {
    var value = $(this).val();
    // input value
    jQuery.ajax({
        url: "/allotement_infos/" + value,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            jQuery.each(responce.infosAllot, function (key, item) {
                document.getElementById("id_allotement").value = item.id;
                document.getElementById("nom_allot").value =
                    item.nom_allotement;
                document.getElementById("compagnie_allot").value =
                    item.FK_compagnie;
                document.getElementById("total_accorde_allot").value =
                    item.totale_accorde;
                document.getElementById("total_occupe_allot").value =
                    item.totale_occupe;
                document.getElementById("reliquat_allot").value =
                    item.totale_reliquat;
                // liste vole départ
                showVoledepartspecifique(item.id);
                // liste vole retour
                showVoleRetourspecifique(item.id);
            });
        },
    });
});
// calcule
function calcule1(total_occupe_allot, total_accorde_allot) {
    var reliquat = parseInt(total_accorde_allot) - parseInt(total_occupe_allot);
    document.getElementById("reliquat_allot").value = reliquat;
}
function info_allotement() {
    var v = window.location.href;
    var id = v.split("/")[4];
    jQuery.ajax({
        url: "/allotement_infos/" + id,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            jQuery.each(responce.infosAllot, function (key, item) {
                document.getElementById("id_allotement").value = item.id;
                document.getElementById("num_allot").value =
                    item.num_allotement;
                document.getElementById("nom_allot").value =
                    item.nom_allotement;
                document.getElementById("total_accorde_allot").value =
                    item.totale_accorde;
                document.getElementById("total_occupe_allot").value =
                    item.totale_occupe;
                document.getElementById("reliquat_allot").value =
                    item.totale_reliquat;
                document.getElementById("compagnie_allot").value =
                    item.FK_compagnie;
            });
        },
    });
}

function liste_allotement(id_allot) {
    jQuery.ajax({
        url: "/liste_nv_allotement/" + id_allot,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_allot = "";
            cpt = 0;
            jQuery.each(responce.liste_allotemet1, function (key, item) {
                $select_allot =
                    $select_allot +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.num_allotement +
                    "</option>";

                if (cpt < item.num_allotement) {
                    cpt = item.num_allotement;
                }
            });
            $("#num_allot").html($select_allot);
        },
    });
}
function liste_allotement_id(id_allot) {
    jQuery.ajax({
        url: "/liste_Allotement_id/" + id_allot,
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_allot = "";
            cpt = 0;
            jQuery.each(responce.liste_gestion_allo, function (key, item) {
                $select_allot =
                    $select_allot +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.num_allotement +
                    "</option>";

                if (cpt < item.num_allotement) {
                    cpt = item.num_allotement;
                }
            });
            $("#num_allot").html($select_allot);
        },
    });
}
// compagnie
function liste_compagnie() {
    jQuery.ajax({
        url: "/compagnie_index",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_allot = "";
            jQuery.each(responce.compagnies, function (key, item) {
                $select_allot =
                    $select_allot +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.compagnie +
                    "</option>";
            });
            $("#compagnie_allot_up").html($select_allot);
        },
    });
}
function Nouveau() {
    cpt = parseInt(cpt) + 1;
    $("#num_allot").append(
        '<option value="' + cpt + '" selected="selected">' + cpt + "</option>"
    );

    viderchamp();

    jQuery.ajax({
        url: "/vole_depart_index",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $ligneVoleDepart = "";
            jQuery.each(responce.jsonlisteVoledepart, function (key, item) {
                $ligneVoleDepart = $ligneVoleDepart;
            });
            $("#listeVoleDepart").html($ligneVoleDepart);
        },
    });

    jQuery.ajax({
        url: "/vole_retour_index",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $lignes = "";
            jQuery.each(responce.jsonlisteVoleRetour, function (key, item) {
                $lignes = $lignes;
            });
            $("#listeVoleRetour").html($lignes);
        },
    });
}
// ****** listes specifique vol départ ******
function showVoledepartspecifique(value) {
    jQuery.ajax({
        url: "/vole_depart_specifi/" + value,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.specifiVoledeapart, function (key, item) {
                $tabledata = responce.specifiVoledeapart;
            });
            var table = new Tabulator("#listeVoleDepart", {
                printAsHtml: true,
                printStyled: true,
                // height:"311px",
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
                        title: "Num vol",
                        minWidth: 100,
                        responsive: 0,
                        field: "num_vol",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Date départ",
                        minWidth: 100,
                        field: "date_depart",
                        sorter: "number",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Parcours",
                        field: "FK_parcours",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Total accorde",
                        field: "total_accorde",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Heure départ",
                        field: "heure_depart",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Heure arrivee",
                        field: "heure_arrivee",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Prix Achat",
                        minWidth: 100,
                        responsive: 0,
                        field: "prix_Achat_dep",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Prix Vente",
                        minWidth: 100,
                        responsive: 0,
                        field: "prix_vente_dep",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
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
                                    <button  class="edit text-primary flex items-center mr-3" href="javascript:;" data-tw-toggle="modal" data-tw-target="#depart-footer-modal-preview">
                                    <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="edit " data-lucide="edit " class="lucide lucide-edit w-4 h-4 mr-2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7 "></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z "></path></svg>
                                    </button>
                                     <a class="delete flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>                                    </a>
                                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/vole_depart_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            //  responce2=jQuery.parseJSON(responce);
                                            // jQuery.each(responce2.info_vole_depart, function(key, item) {
                                            const nv =
                                                responce.info_vole_depart;
                                            document.getElementById(
                                                "id_vole_depart_up"
                                            ).value = nv.id;
                                            document.getElementById(
                                                "vole_depart_allotemet_Dt_depart"
                                            ).value = nv.date_depart;
                                            document.getElementById(
                                                "num_vol_depart_allotemet_up"
                                            ).value = nv.num_vol;
                                            document.getElementById(
                                                "parcours_vol_depart_allotement_up"
                                            ).value = nv.FK_parcours;
                                            document.getElementById(
                                                "total_accorde_vol_depart_allot_up"
                                            ).value = nv.total_accorde;
                                            document.getElementById(
                                                "heure_depart_vol_depart_allot_up"
                                            ).value = nv.heure_depart;
                                            document.getElementById(
                                                "heure_arrivee_vole_depart_allot_up"
                                            ).value = nv.heure_arrivee;
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/vole_depart_infos_Delet/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv =
                                                responce.info_vole_depart;
                                            document.getElementById(
                                                "_id_vole_depart"
                                            ).value = nv.id;
                                        },
                                    });
                                });
                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Num vol",
                        field: "num_vol",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date départ",
                        field: "date_depart",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Parcours",
                        field: "FK_parcours",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Total accorde",
                        field: "total_accorde",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Heure départ",
                        field: "heure_depart",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Heure arrivee",
                        field: "heure_arrivee",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowDblClick: function (e, row) {
                    // window.location.replace("/liste_prog/" + row.getData().id);
                },
            });
            $('#search-btn').on('click', function() {
               
                var Value = $('#num_v').val();      
                var filters = [];
                if (Value ) {
                  filters.push({field: "num_vol",type: "like", value: Value});
                }
                table.setFilter(filters);
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
            $("#tabulator-print-Vole-Depart").on("click", function (event) {
                table.print();
            });
            document
                .getElementById("tabulator-export-xlsx")
                .addEventListener("click", function () {
                    table.download("xlsx", "data.xlsx", {
                        sheetName: "My Data",
                    });
                });
        },
    });
}
// ***** liste vole retour *******
function showVoleRetourspecifique(value) {
    jQuery.ajax({
        url: "/vole_retour_specifi/" + value,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.specifiVoleretour, function (key, item) {
                $tabledata = responce.specifiVoleretour;
            });
            var table = new Tabulator("#listeVoleRetour", {
                printAsHtml: true,
                printStyled: true,
                // height:"311px",
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
                        title: "Num vol",
                        minWidth: 100,
                        responsive: 0,
                        field: "num_vol",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Date retour",
                        minWidth: 100,
                        field: "date_retour",
                        sorter: "number",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Parcours",
                        field: "FK_parcours",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Total accorde",
                        field: "total_accorde",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Heure départ",
                        field: "heure_depart",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Heure arrivee",
                        field: "heure_arrivee",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Prix Achat",
                        minWidth: 100,
                        responsive: 0,
                        field: "prix_Achat_retour",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Prix Vente",
                        minWidth: 100,
                        responsive: 0,
                        field: "prix_vente_retour",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
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
                                    <button  class="edit text-primary flex items-center mr-3" href="javascript:;" data-tw-toggle="modal" data-tw-target="#retour-footer-modal-preview">
                                        <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="edit " data-lucide="edit " class="lucide lucide-edit w-4 h-4 mr-2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7 "></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z "></path></svg>                                   
                                    </button>
                                    <a class="delete flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-vole-retour-modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>                     
                                    </a>
                                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/vole_retour_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv =
                                                responce.info_vole_retour;
                                            document.getElementById(
                                                "id_vole_retour_up"
                                            ).value = nv.id;
                                            document.getElementById(
                                                "date_vole_retour_allotemet_up"
                                            ).value = nv.date_retour;
                                            document.getElementById(
                                                "num_vol_retour_allotemet_up"
                                            ).value = nv.num_vol;
                                            document.getElementById(
                                                "parcours_retour_allotement_up"
                                            ).value = nv.FK_parcours;
                                            document.getElementById(
                                                "total_accorde_retour_allotement_up"
                                            ).value = nv.total_accorde;
                                            document.getElementById(
                                                "heure_depart_vol_retour_allot_up"
                                            ).value = nv.heure_depart;
                                            document.getElementById(
                                                "heure_arrivee_vole_retour_allot_up"
                                            ).value = nv.heure_arrivee;
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/vole_retour_infos_Delet/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv =
                                                responce.info_vole_retour;
                                            document.getElementById(
                                                "id_vole_retour"
                                            ).value = nv.id;
                                        },
                                    });
                                });
                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Num vol",
                        field: "num_vol",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date retour",
                        field: "date_retour",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Parcours",
                        field: "FK_parcours",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Total accorde",
                        field: "total_accorde",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Heure départ",
                        field: "heure_depart",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Heure arrivee",
                        field: "heure_arrivee",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowDblClick: function (e, row) {
                    // window.location.replace("/liste_prog/" + row.getData().id);
                },
            });
            $('#search-btn').on('click', function() {
                
                var Value = $('#num_vo').val();   
            
                var filters = [];
                if (Value ) {
                  filters.push({field: "num_vol",type: "like", value: Value});
                }
                table.setFilter(filters);
              });
            // Redraw table onresize
            window.addEventListener("resize", () => {
                //redraw();
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
            $("#tabulator-print-vole-retour").on("click", function (event) {
                table.print(false, true);
            });
        },
    });
}
// ****** listes Allotement ******
function show_allotement(value) {
    jQuery.ajax({
        url: "/liste_nv_allotement/" + value,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.liste_allotemet1, function (key, item) {
                $tabledata = responce.liste_allotemet1;
            });
            var table = new Tabulator("#liste_Allotement", {
                data: $tabledata,
                printAsHtml: true,
                printStyled: true,
                height: "311px",
                printHeader:
                    '<div class="center intro-x w-10 h-10 image-fit">\n <img alt="Midone - HTML Admin Template" class="rounded-full " src="dist/images/download.jpg">\n  </div>  <h1 style=\'color:#92400e; margin-left:10px;\'>عمرة رمضان موسم 2023 </h1>    \n ',
                printFooter:
                    "<h3>28,Bd Hassane Bnou Tabit - Hay Ezzahraa - Berrchid - 26100 - Maroc Tél.:05 22 32 80 50/52 - Fax: 05 22 32 55 11 - E-mail: info@almaqamtrips.com</h3>",

                layout: "fitColumns",
                pagination: "local",
                paginationSize: 5,
                paginationSizeSelector: [10, 20, 30, 40],
                printConfig: {
                    formatCells: true, //show raw cell values without formatter
                },
                placeholder: "Aucun enregistrements correspondants trouvés",
                tooltips: true,
                columns: [
                    // {
                    //     title: "View",
                    //     minWidth: 100,
                    //     responsive: 0,
                    //     field: "num_vol",
                    //     sorter: "string",
                    //     vertAlign: "middle",
                    //     col: "red",
                    //     print: false,
                    //     download: false,
                    //     formatter(cell, formatterParams) {
                    //         return `<div>
                    //                 <div class="w-10 h-10 image-fit zoom-in ">
                    //                 <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="public/build/assets/images/images/preview-14.jpg" alt="no logo"> </div>
                    //                 </div>

                    //                 <div class="w-10 h-10 image-fit zoom-in ">
                    //                 <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src=""{{ URL::asset('./images/preview-14.jpg') }}"" alt="no logo"> </div>
                    //                 </div>
                    //     </div>`;
                    //     },
                    // },
                    {
                        title: "Num allotement",
                        minWidth: 100,
                        responsive: 0,
                        field: "num_allotement",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nom allotement",
                        minWidth: 100,
                        field: "nom_allotement",
                        sorter: "string",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Totale accorde",
                        field: "totale_accorde",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Totale occupe",
                        field: "totale_occupe",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Totale reliquat",
                        field: "totale_reliquat",
                        minWidth: 100,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Compagnie ",
                        field: "compagnie",
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
                                    <button  class="view text-success flex items-center mr-3 tooltip" title="consulter" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="eye " data-lucide="eye " class="lucide lucide-eye w-4 h-4 mr-1 "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z "></path><circle cx="12 " cy="12 " r="3 "></circle></svg>
                                    </button>
                                    <button  class="edit text-primary flex items-center mr-3 tooltip" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#allot-footer-modal-preview">
                                    <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="edit " data-lucide="edit " class="lucide lucide-edit w-4 h-4 mr-2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7 "></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z "></path></svg>
                                    </button>
                                    <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-allotement">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/allotement_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            //  responce2=jQuery.parseJSON(responce);
                                            jQuery.each(
                                                responce.infosAllot,
                                                function (key, item) {
                                                    // const ob =responce.infosAllot;
                                                    document.getElementById(
                                                        "id_Allotement"
                                                    ).value = item.id;
                                                    document.getElementById(
                                                        "nom_allot_up"
                                                    ).value =
                                                        item.nom_allotement;
                                                    document.getElementById(
                                                        "total_accorde_allot_up"
                                                    ).value =
                                                        item.totale_accorde;
                                                    document.getElementById(
                                                        "total_occupe_allot_up"
                                                    ).value =
                                                        item.totale_occupe;
                                                    document.getElementById(
                                                        "reliquat_allot_up"
                                                    ).value =
                                                        item.totale_reliquat;
                                                    document.getElementById(
                                                        "compagnie_allot_up"
                                                    ).value = item.FK_compagnie;
                                                }
                                            );
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/allotement_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv = responce.infosAllot;
                                            // console.log(nv);
                                            jQuery.each(
                                                responce.infosAllot,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "delet_id_allot"
                                                    ).value = item.id;
                                                }
                                            );
                                        },
                                    });
                                });
                            $(a)
                                .find(".view")
                                .on("click", function () {
                                    window.location.replace(
                                        "/Allotement_id/" + cell.getData().id
                                    );
                                });
                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Num allotement",
                        field: "num_allotement",
                        visible: false,
                        hozAlign: "center",
                        print: true,
                        download: true,
                    },
                    {
                        title: "Nom allotement",
                        field: "nom_allotement",
                        hozAlign: "center",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Totale accorde",
                        field: "totale_accorde",
                        hozAlign: "center",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Totale occupe",
                        field: "totale_occupe",
                        hozAlign: "center",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Totale reliquat",
                        field: "totale_reliquat",
                        hozAlign: "center",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Compagnie",
                        field: "compagnie",
                        hozAlign: "center",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowDblClick: function (e, row) {
                    window.location.replace(
                        "/Allotement_id/" + row.getData().id
                    );
                },
            });
            $('#search-btn').on('click', function() {
               
                var nameValue = $('#num').val();
             
                var filters = [];
              
                if (nameValue ) {
                  filters.push({field: "num_allotement", type: "like", value: nameValue});
                }
              
              
              
                table.setFilter(filters);
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
           
            $("#tabulator-export-json").on("click", function (event) {
                table.download("json", "data.json");
            });

            $("#tabulator-export-xlsx").on("click", function (event) {
                window.XLSX = xlsx;
                table.download("xlsx", "data.xlsx", {
                    sheetName: "Products",
                });
            });

          
            // Print
            $("#tabulator-print-allotement").on("click", function (event) {
                table.print();
            });
        },
    });
}
// ----------------- vole dapart
$(document).ready(function () {
    info_allotement();
    // ******Ajouter vole depart******
    $("#form_allo1").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var id_allotement = $("#id_allotement").val();
        formData.push({
            name: "id_allotement",
            value: id_allotement,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                showVoledepartspecifique(id_allotement);
                vidervoledepart();
                // viderVoledep();
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
    // ******update vole depart******
    $("#update_vole_depart").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var num_allotement = $("#num_allot").val();
        formData.push({
            name: "num_allot",
            value: num_allotement,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#depart-footer-modal-preview").trigger("click");
                showVoledepartspecifique(num_allotement);
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
    // ******delete vole depart******
    $("#delet_vole_depart").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var num_allotement = $("#num_allot").val();
        formData.push({
            name: "num_allot",
            value: num_allotement,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#delete-confirmation-modal").trigger("click");
                showVoledepartspecifique(num_allotement);
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
});
// *************** Gestion Vole retour ***************
//----------------- vole retour
$(document).ready(function () {
    var v = window.location.href;
    var FK_Dossier = v.split("/")[4];
    // Ajouter vole retour
    $("#form_allo_vole_retour").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var id_allotement = $("#id_allotement").val();
        formData.push({
            name: "id_allotement",
            value: id_allotement,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                showVoleRetourspecifique(id_allotement);
                vidervoleretour();
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
    // ******update vole retour******
    $("#update_vole_retour").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var num_allotement = $("#num_allot").val();
        formData.push({
            name: "num_allot",
            value: num_allotement,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#retour-footer-modal-preview").trigger("click");
                showVoleRetourspecifique(num_allotement);
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
    // ******delete vole retour******
    $("#delete_vole_retour").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var num_allotement = $("#num_allot").val();
        formData.push({
            name: "num_allot",
            value: num_allotement,
        });
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#delete-vole-retour-modal").trigger("click");
                showVoleRetourspecifique(num_allotement);
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
    // ******Ajouter Allotement******
    $("#form_allot").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        var FK_dossier = FK_Dossier;
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
                // Je récupère la réponse du fichier PHP
                jQuery.each(
                    response.update_gestion_allot,
                    function (key, item) {
                        // console.log(response.update_gestion_allot);
                        document.getElementById("id_allotement").value =
                            item.id;
                        console.log(
                            document.getElementById("id_allotement").value
                        );
                    }
                );
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de Vérifier les champs");
            },
        });
    });
    // ******update Allotement******
    $("#up_gestion_allo").on("submit", function (e) {
        e.preventDefault();
        var v = window.location.href;
        var cmt = v.split("/")[4];

        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                jQuery("#allot-footer-modal-preview").trigger("click");
                show_allotement(cmt);
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
    // ******delete allotement******
    $("#delet_allotement").on("submit", function (e) {
        e.preventDefault();
        var v = window.location.href;
        var cmt = v.split("/")[4];

        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function (response) {
                jQuery("#delete-confirmation-allotement").trigger("click");
                show_allotement(cmt);
                toastr.success(response.message);
            },
            error: function (response) {
                // toastr.error("Vérifier votre données");
                toastr.error("Merci de sélectionner Numero d'allotement");
            },
        });
    });
});

function viderchamp() {
    document.getElementById("nom_allot").value = "";
    document.getElementById("compagnie_allot").value = "";
    document.getElementById("total_accorde_allot").value = "";
    document.getElementById("total_occupe_allot").value = "";
    document.getElementById("reliquat_allot").value = "";

    document.getElementById("date_depart_allotement").value = "";
    document.getElementById("num_vol_depart_allotement").value = "";
    document.getElementById("parcours_depart_allotement").value = "";
    document.getElementById("total_accorde_depart_allotement").value = "";
    document.getElementById("heure_depart_allotement").value = "";
    document.getElementById("heure_arrivee_depart_allotement").value = "";

    // vole retour
    document.getElementById("date_vole_retour_allotemet").value = "";
    document.getElementById("num_vol_retour_allotemet").value = "";
    document.getElementById("parcours_retour_allotement").value = "";
    document.getElementById("total_accorde_retour_allotement").value = "";
    document.getElementById("heure_depart_vol_retour_allot").value = "";
    document.getElementById("heure_arrivee_vole_retour_allot").value = "";
}
function vidervoleretour() {
    // vole retour
    document.getElementById("date_vole_retour_allotemet").value = "";
    document.getElementById("num_vol_retour_allotemet").value = "";
    document.getElementById("parcours_retour_allotement").value = "";
    document.getElementById("total_accorde_retour_allotement").value = "";
    document.getElementById("heure_depart_vol_retour_allot").value = "";
    document.getElementById("heure_arrivee_vole_retour_allot").value = "";
}
function vidervoledepart() {
    // vole retour
    document.getElementById("date_depart_allotement").value = "";
    document.getElementById("num_vol_depart_allotement").value = "";
    document.getElementById("parcours_depart_allotement").value = "";
    document.getElementById("total_accorde_depart_allotement").value = "";
    document.getElementById("heure_depart_allotement").value = "";
    document.getElementById("heure_arrivee_depart_allotement").value = "";
}
