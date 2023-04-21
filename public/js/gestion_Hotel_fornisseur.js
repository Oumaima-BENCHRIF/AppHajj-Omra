$(window).on("load", function () {});
$(document).ready(function () {
    table_Hotel_fourni();
    liste_types();
    liste_villes();
    // ******Ajouter Hotel/fournissuer******
    $("#Add_Hotel_Fourni").on("submit", function (e) {
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
                table_Hotel_fourni();
                viderchamps();
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
    // ******update To******
    $("#update_houtel_fourni").on("submit", function (e) {
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
                jQuery("#header-footer-modal-preview").trigger("click");
                table_Hotel_fourni();
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
    // ******Delete tos******
    $("#delet_hotel_fourni").on("submit", function (e) {
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
                table_Hotel_fourni();
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
});
function viderchamps() {
    document.getElementById("code").value = "";
    document.getElementById("nom").value = "";
    document.getElementById("Ville").value = "";
    document.getElementById("distance_harame").value = "";
    document.getElementById("emplacement").value = "";
    document.getElementById("telephone").value = "";
    document.getElementById("fax").value = "";
    document.getElementById("site").value = "";
    document.getElementById("compte_comptable_ramadan").value = "";
    document.getElementById("compte_comptable_mouloud").value = "";
    document.getElementById("contact").value = "";
    document.getElementById("email").value = "";
    document.getElementById("nom_en_arabe").value = "";
    document.getElementById("type").value = "";
    document.getElementById("categorie").value = "";
}
// ---------------liste ville
function liste_villes() {
    jQuery.ajax({
        url: "/hotel_transports_liste",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_villes = "";
            jQuery.each(responce.Liste_ville, function (key, item) {
                $select_villes =
                    $select_villes +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nom +
                    "</option>";
            });
            $("#Ville").html($select_villes);
            $("#up_ville").html($select_villes);
        },
    });
}
// ---------------Liste type
function liste_types() {
    jQuery.ajax({
        url: "/hotel_transports_liste",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_types = "";
            jQuery.each(responce.liste_types, function (key, item) {
                $select_types =
                    $select_types +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.type +
                    "</option>";
            });
            $("#type").html($select_types);
            $("#up_type").html($select_types);
        },
    });
}
// ---------------liste of TO
// function de rechercher par FK_prg
function table_Hotel_fourni() {
    jQuery.ajax({
        url: "/hotel_transports_liste",
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            jQuery.each(responce.Liste_Hotel_fournisseur, function (key, item) {
                $tabledata = responce.Liste_Hotel_fournisseur;
            });

            var table = new Tabulator("#liste_Hotel_fourni", {
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
                        title: "Code",
                        width: 95,
                        field: "code",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nom",
                        minWidth: 100,
                        width: 43,
                        field: "nom",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },

                    {
                        title: "Telephone",
                        field: "telephone",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Nom en arabe",
                        field: "nom_en_arabe",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "ville",
                        field: "nom_ville",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Type",
                        field: "nom_type",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Compte comptable mouloud",
                        field: "compte_comptable_mouloud",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Compte comptable ramadan",
                        field: "compte_comptable_ramadan",
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
                                   
                                        <button  class="edit text-primary flex items-center mr-3 tooltip" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                                        </button>

                                    <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                         <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                    </a>
                            </div>`);

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/hotel_transportsinfos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.Hotel_transports,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "id_delete_hotel"
                                                    ).value = item.id;
                                                }
                                            );
                                        },
                                    });
                                });

                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/hotel_transportsinfos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            jQuery.each(
                                                responce.Hotel_transports,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "update_id"
                                                    ).value = item.id;
                                                    document.getElementById(
                                                        "up_type"
                                                    ).value = item.FK_type;
                                                    document.getElementById(
                                                        "up_ville"
                                                    ).value = item.FK_ville;
                                                    document.getElementById(
                                                        "up_categorie"
                                                    ).value = item.categorie;
                                                    document.getElementById(
                                                        "up_code"
                                                    ).value = item.code;
                                                    document.getElementById(
                                                        "up_compte_comptable_mouloud"
                                                    ).value =
                                                        item.compte_comptable_mouloud;
                                                    document.getElementById(
                                                        "up_compte_comptable_ramadan"
                                                    ).value =
                                                        item.compte_comptable_ramadan;
                                                    document.getElementById(
                                                        "up_email"
                                                    ).value = item.email;
                                                    document.getElementById(
                                                        "up_emplacement"
                                                    ).value = item.emplacement;
                                                    document.getElementById(
                                                        "up_fax"
                                                    ).value = item.fax;
                                                    document.getElementById(
                                                        "up_nom"
                                                    ).value = item.nom;
                                                    document.getElementById(
                                                        "up_nom_en_arabe"
                                                    ).value = item.nom_en_arabe;
                                                    document.getElementById(
                                                        "up_site"
                                                    ).value = item.site;
                                                    document.getElementById(
                                                        "up_telephone"
                                                    ).value = item.telephone;
                                                }
                                            );
                                        },
                                    });
                                });

                            return a[0];
                        },
                    },
                    // For print format
                    // For print format
                    {
                        title: "Code",
                        field: "code",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Nom",
                        field: "nom",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Telephone",
                        field: "telephone",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "type",
                        field: "nom_type",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Ville",
                        field: "nom_ville",
                        visible: false,
                        print: true,
                        download: true,
                    },
                ],

                rowDblClick: function (e, row) {},
            });
            $('#search-btn').on('click', function() {
                var codeValue = $('#code_Ghotel').val();
                 console.log(codeValue); 
                var filters = [];
                if (codeValue) {
                  filters.push({field: "code", type: "like", value: codeValue});
                }
              
              
              
                table.setFilter(filters);
              });
            // print
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
            $("#tabulator-print-hotel-forni").on("click", function (event) {
                table.print();
            });
        },
    });
}
