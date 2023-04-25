$(document).ready(function () {
    var v = window.location.href;
    var url_dossier = v.split("/")[4];
    var url_prg = v.split("/")[5];

    list_reservation(url_dossier, url_prg);
});

function list_reservation(url_dossier, url_prg) {
    jQuery.ajax({
        url: "/Liste_Reservation/" + url_dossier + "/" + url_prg,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.liste_reservation, function (key, item) {
                $tabledata = responce.liste_reservation;
            });
            jQuery.each(responce.liste_info, function (key, item) {
                document.getElementById("nom_dossier").innerHTML =
                    item.nom_dossier;
                document.getElementById("nom_programme").innerHTML =
                    item.nom_programme;
            });
            var table = new Tabulator("#liste_reservation", {
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
                // headerVisible: false,
                groupToggleElement: "header",
                groupStartOpen: false,
                groupBy: "type_chambre_prg",
                groupHeader: function (value, count, data, group) {
                    return (
                        "<div class='tabulator-cell bg-light taille' >" +
                        value +
                        " </div> <div class='tabulator-cell ' >" +
                        count +
                        " </div>"
                    );
                },
                columns: [
                    {
                        title: "Type",
                        minWidth: 100,
                        field: "image",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter: function formatter(cell, formatterParams) {
                            return '<div class="flex lg:justify-center">\
                            <div class="intro-x w-10 h-10 image-fit">\
                            <div class="intro-x w-10 h-10 image-fit">\
                            <img alt="Midone - HTML Admin Template" class="rounded-full " src="/uploads/Hotel_makka.jpg">\
                            </div>\
                            </div>';
                        },
                    },
                    {
                        title: "Programme",
                        // minWidth: 100,
                        responsive: 0,
                        width: 114,
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
                        title: "Nbr chambre",
                        field: "bnr_chambre",
                        width: 122,
                        minWidth: 100,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr place départ Total",
                        field: "Nbr_place_aller",
                        minWidth: 100,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr réserver départ Total",
                        field: "Totale_place_reserver",
                        width: 200,
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nbr reste Totale",
                        field: "Totale_place",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Disponibilité",
                        field: "Totale_place",
                        width: 150,
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                        formatter: function (cell, formatterParams) {
                            var value = cell.getValue();
                            if (value > 0) {
                                return `<div class="flex items-center lg:justify-center text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Disponible
                                </div> `;
                            } else {
                                return `<div class="flex items-center lg:justify-center text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Remplit
                            </div>`;
                            }
                        },
                    },
                    {
                        title: "Genre",
                        field: "Genre",
                        width: 110,
                        editor: "select",
                        editorParams: {
                            values: {
                                Femme: "Femme",
                                Homme: "Homme",
                            },
                        },
                        cellEdited: function (cell) {
                            var id = cell.getData().id;
                            var Genre = cell.getData().Genre;
                            var data_gender = {
                                name: "Genre",
                                value: Genre,
                            };
                            if (data_gender.value === "Femme") {
                                cell
                                    .getRow()
                                    .getElement().style.backgroundColor =
                                    "rgba(233, 30, 99, 0.1)";
                            } else {
                                cell
                                    .getRow()
                                    .getElement().style.backgroundColor =
                                    "rgba(3, 169, 244, 0.1)";
                            }
                            // *** debut ***
                            var id_detail_hotel_prg =
                                cell.getData().id_detail_hotel_prg;
                            // console.log(id_detail_hotel_prg);
                            // *** fin ****
                            jQuery.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                            });
                            jQuery.ajax({
                                url:
                                    "/Add_gender_prg_hotel/" +
                                    id_detail_hotel_prg,
                                type: "POST", // Le nom du fichier indiqué dans le formulaire
                                data: data_gender, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)

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
                    {
                        title: "Action",
                        minWidth: 100,
                        field: "actions",
                        responsive: 1,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            //     <a class="view flex text-success items-center tooltip mr-1" title="Consulter">
                            //     <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="eye " data-lucide="eye " class="lucide lucide-eye w-4 h-4 mr-1 "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z "></path><circle cx="12 " cy="12 " r="3 "></circle></svg>
                            // </a>
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                                    <a class="view flex items-center text-success tooltip mr-3" title="Consulter moutamir">
                                        <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="eye " data-lucide="eye " class="lucide lucide-eye w-4 h-4 mr-1 "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z "></path><circle cx="12 " cy="12 " r="3 "></circle></svg>
                                    </a>
                                    <a class="reservation flex text-primary items-center tooltip " title="Réserver">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="lucide lucide-eye w-4 h-4 mr-1  fill=" none"="" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>                              
                                    </a>  
                                </div>
                                `);

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
                                        "/Fiche_inscription/Dossier_id/" +
                                            url_dossier +
                                            "/Programe_id/" +
                                            cell.getData().id_progrmme_ +
                                            "/Detail_hotel/" +
                                            cell.getData().id_detail_hotel_prg
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
                rowDblClick: function (e, row) {
                    // window.location.replace("/Fiche_inscription");
                    window.location.replace(
                        "/Fiche_inscription/Dossier_id/" +
                            url_dossier +
                            "/Programe_id/" +
                            row.getData().id_progrmme_ +
                            "/Detail_hotel/" +
                            row.getData().id_detail_hotel_prg
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
            $("#tabulator-print-reservation").on("click", function (event) {
                table.print();
            });
        },
        error: function (rep) {
            console.log("err");
        },
    });
}
