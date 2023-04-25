// dossier dossier
$(document).ready(function () {
    var v = window.location.href;
    var t = v.split("/")[4];
    // list_programme(t);
    test_list_programme(t);
    // ******Ajouter dossier******
    $("#ajouter_gestion").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                list_gestion();
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******update prg******
    $("#up_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        console.log(formData);
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                jQuery("#header-footer-modal-preview").trigger("click");
                list_programme(t);
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******Delete prg******
    $("#delet_prg").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                jQuery("#delete-confirmation-modal").trigger("click");
                list_programme(t);
            },
            error: function (response) {
                toastr.error("Contacter le serice IT");
            },
        });
    });
    // ******search dossier******
    $("#search_gestion_dossier").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                jQuery("#large-modal-size-preview").trigger("click");
                rechercher_dossier();
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
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
});

// liste du programme
function list_programme(t) {
    jQuery.ajax({
        url: "/liste_pro_data/" + t,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.liste_programmes, function (key, item) {
                $tabledata = responce.liste_programmes;
            });
            var table = new Tabulator("#liste_prg", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 5,
                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "Aucun Enregistrement!",
                tooltips: true,
                columns: [
                    {
                        title: "Nom programme",
                        minWidth: 120,
                        responsive: 0,
                        field: "nom_programme",
                        sorter: "string",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div>
                    <div class="font-medium whitespace-nowrap">${
                        cell.getData().nom_programme
                    }</div>
                    <div class="text-slate-500 text-xs whitespace-nowrap">${
                        cell.getData().ref_programme
                    }</div>
                </div>`;
                        },
                    },
                    // {
                    //     title: "Ref programme",
                    //     field: "ref_programme",
                    //     minWidth: 120,
                    //     sorter: "number",
                    //     hozAlign: "left",
                    //     hozAlign: "center",
                    //     vertAlign: "middle",
                    //     print: false,
                    //     download: false,
                    // },
                    {
                        title: "Type programme",
                        field: "type_programme",
                        minWidth: 120,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "nbr nuitée mdina",
                        field: "nbr_nuitee_prog_mdina",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr place aller",
                        field: "Nbr_place_aller",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr place retour",
                        field: "Nbr_place_retour",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr reserver depart",
                        field: "Nbr_reserver_depart",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr reserver retour",
                        field: "Nbr_reserver_retour",
                        minWidth: 120,
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
                        responsive: 1,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                                <a class="view flex text-success items-center tooltip" titel="Consulter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>\n
                                </a>    
                                <button  class="edit text-primary flex items-center mr-3 tooltip" titel="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                                </button>
                                <a class="delete flex text-danger items-center mr-3 tooltip" titel="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                </a>
                               
                            </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url: "/info_prog/" + cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data

                                        success: function (responce) {
                                            // affichage select
                                            jQuery.each(
                                                responce.programme,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "up_id_prg"
                                                    ).value = item.id;
                                                    document.getElementById(
                                                        "nom_programme"
                                                    ).value =
                                                        item.nom_programme;
                                                    document.getElementById(
                                                        "type_programme"
                                                    ).value =
                                                        item.type_programme;
                                                    document.getElementById(
                                                        "nbr_nuitee_prog_mdina"
                                                    ).value =
                                                        item.nbr_nuitee_prog_mdina;
                                                    document.getElementById(
                                                        "nbr_nuitee_prog_maka"
                                                    ).value =
                                                        item.nbr_nuitee_prog_maka;
                                                    document.getElementById(
                                                        "num_vole_dep"
                                                    ).value =
                                                        item.FK_Num_vole_depart;
                                                    document.getElementById(
                                                        "nbr_place_aller"
                                                    ).value =
                                                        item.Nbr_place_aller;
                                                    document.getElementById(
                                                        "nbr_reserver_dep"
                                                    ).value =
                                                        item.Nbr_reserver_depart;
                                                    document.getElementById(
                                                        "num_vole_retour"
                                                    ).value =
                                                        item.FK_Num_vole_retour;
                                                    document.getElementById(
                                                        "nbr_place_retour"
                                                    ).value =
                                                        item.Nbr_place_retour;
                                                    document.getElementById(
                                                        "nbr_reserver_retour"
                                                    ).value =
                                                        item.Nbr_reserver_retour;
                                                    document.getElementById(
                                                        "up_FK_dossier"
                                                    ).value = item.FK_dossier;
                                                }
                                            );
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url: "/info_prog/" + cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.programme,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "delet_id_prg"
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
                                        "/programmes_dossier/" + t
                                    );
                                });
                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Nom dossier",
                        field: "nom_dossier",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date Hijri",
                        field: "hijri_date",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date début",
                        field: "Date_debut",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Date fin",
                        field: "Date_fin",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowDblClick: function (e, row) {
                    window.location.replace("/programmes_dossier/" + t);
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
            $("#tabulator-print").on("click", function (event) {
                table.print();
            });
        },
        error: function (rep) {
            console.log("err");
        },
    });
}

function showDialogueModifier_prg(id) {
    jQuery.ajax({
        url: "/hotel_prg_infos/" + id,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            const nv = responce.infos_hotel;
            document.getElementById("up_id_prg").value = nv.id;
            document.getElementById("nom_programme").value = nv.nom_programme;
            document.getElementById("type_programme").value = nv.type_programme;
            document.getElementById("nbr_nuitee_prog_maka").value =
                nv.nbr_nuitee_prog_maka;
            document.getElementById("FK_Num_vole_depart").value =
                nv.FK_Num_vole_depart;
            document.getElementById("Nbr_place_aller").value =
                nv.Nbr_place_aller;
            document.getElementById("Nbr_reserver_depart").value =
                nv.Nbr_reserver_depart;
            document.getElementById("FK_Num_vole_retour").value =
                nv.FK_Num_vole_retour;
            document.getElementById("Nbr_place_retour").value =
                nv.Nbr_place_retour;
            document.getElementById("Nbr_reserver_retour").value =
                nv.Nbr_reserver_retour;
            document.getElementById("FK_dossier").value = nv.FK_dossier;
        },
    });
}

//liste prg
// liste du programme
function test_list_programme(t) {
    jQuery.ajax({
        url: "/liste_pro_data/" + t,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.liste_programmes, function (key, item) {
                $tabledata = responce.liste_programmes;
                // document.getElementById("nom_dossier").innerHTML = item.nom_dossier;
            });
            jQuery.each(responce.Dossier, function (key, item) {
                document.getElementById("nom_dossier").innerHTML =
                    item.nom_dossier;
            });
            var table = new Tabulator("#liste_prg", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                printHeader:
                    '<div class="center intro-x w-10 h-10 image-fit">\n <img alt="Midone - HTML Admin Template" class="rounded-full " src="dist/images/download.jpg">\n  </div>  <h1 style=\'color:#92400e; margin-left:10px;\'>عمرة رمضان موسم 2023 </h1>    \n ',
                printFooter:
                    "<h3>28,Bd Hassane Bnou Tabit - Hay Ezzahraa - Berrchid - 26100 - Maroc Tél.:05 22 32 80 50/52 - Fax: 05 22 32 55 11 - E-mail: info@almaqamtrips.com</h3>",
                pagination: "local",
                paginationSize: 5,
                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "Aucun Enregistrement!",
                tooltips: true,
                columns: [
                    {
                        title: "Nom programme",
                        minWidth: 120,
                        responsive: 0,
                        field: "nom_programme",
                        sorter: "string",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div>
                    <div class="font-medium whitespace-nowrap">${
                        cell.getData().nom_programme
                    }</div>
                    <div class="text-slate-500 text-xs whitespace-nowrap">${
                        cell.getData().ref_programme
                    }</div>
                </div>`;
                        },
                    },
                    {
                        title: "Type programme",
                        field: "type_programme",
                        minWidth: 120,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "nbr nuitée mdina",
                        field: "nbr_nuitee_prog_mdina",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr place aller",
                        field: "Nbr_place_aller",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr place retour",
                        field: "Nbr_place_retour",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr reserver depart",
                        field: "Nbr_reserver_depart",
                        minWidth: 120,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr reserver retour",
                        field: "Nbr_reserver_retour",
                        minWidth: 120,
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
                        responsive: 1,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                                <a class="view flex text-success items-center mr-3 tooltip" title="consulter">
                                    <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="eye " data-lucide="eye " class="lucide lucide-eye w-4 h-4 mr-1 "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z "></path><circle cx="12 " cy="12 " r="3 "></circle></svg>
                                </a>    
                                <a class="reservation flex text-dark items-center mr-3 tooltip" title="Réserver">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="lucide lucide-eye w-4 h-4 mr-1  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>\n
                                </a>    
                                <button  class="edit text-primary flex items-center mr-3 tooltip" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                                    <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="edit " data-lucide="edit " class="lucide lucide-edit w-4 h-4 mr-2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7 "></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z "></path></svg>
                                </button>
                                <button class="delete flex text-danger items-center tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                </button>
                               
                            </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url: "/info_prog/" + cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data

                                        success: function (responce) {
                                            // affichage select
                                            jQuery.each(
                                                responce.programme,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "up_id_prg"
                                                    ).value = item.id;
                                                    document.getElementById(
                                                        "nom_programme"
                                                    ).value =
                                                        item.nom_programme;
                                                    document.getElementById(
                                                        "type_programme"
                                                    ).value =
                                                        item.type_programme;
                                                    document.getElementById(
                                                        "nbr_nuitee_prog_mdina"
                                                    ).value =
                                                        item.nbr_nuitee_prog_mdina;
                                                    document.getElementById(
                                                        "nbr_nuitee_prog_maka"
                                                    ).value =
                                                        item.nbr_nuitee_prog_maka;
                                                    document.getElementById(
                                                        "num_vole_dep"
                                                    ).value =
                                                        item.FK_Num_vole_depart;
                                                    document.getElementById(
                                                        "nbr_place_aller"
                                                    ).value =
                                                        item.Nbr_place_aller;
                                                    document.getElementById(
                                                        "nbr_reserver_dep"
                                                    ).value =
                                                        item.Nbr_reserver_depart;
                                                    document.getElementById(
                                                        "num_vole_retour"
                                                    ).value =
                                                        item.FK_Num_vole_retour;
                                                    document.getElementById(
                                                        "nbr_place_retour"
                                                    ).value =
                                                        item.Nbr_place_retour;
                                                    document.getElementById(
                                                        "nbr_reserver_retour"
                                                    ).value =
                                                        item.Nbr_reserver_retour;
                                                    document.getElementById(
                                                        "up_FK_dossier"
                                                    ).value = item.FK_dossier;
                                                }
                                            );
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url: "/info_prog/" + cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.programme,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "delet_id_prg"
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
                                        "/programmes_info/" + cell.getData().id
                                    );
                                });
                            $(a)
                                .find(".reservation")
                                .on("click", function () {
                                    window.location.replace(
                                        "/Reservation/" + cell.getData().id
                                    );
                                });
                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Nom programme",
                        field: "nom_programme",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Type programme",
                        field: "type_programme",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Nbr nuitée Mdina",
                        field: "nbr_nuitee_prog_mdina",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Nbr place aller",
                        field: "Nbr_place_aller",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Nbr place retour",
                        field: "Nbr_place_retour",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Nbr reserver depart",
                        field: "Nbr_reserver_depart",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Nbr reserver retour",
                        field: "Nbr_reserver_retour",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],
                rowDblClick: function (e, row) {
                    window.location.replace(
                        "/Reservation/" +
                            row.getData().id_dossier +"/" +row.getData().id_prg
                    );
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
            
            $("#tabulator-export-json").on("click", function (event) {
                table.download("json", "data.json");
            });

            $("#tabulator-export-xlsx").on("click", function (event) {
                
                table.download("xlsx", "data.xlsx", {
                    sheetName: "Products",
                });
            });

           
            // Print
            $("#tabulator-print").on("click", function (event) {
                table.print();
            });
        },
        error: function (rep) {
            console.log("err");
        },
    });
}
