// in load page
$(window).on("load", function () {
   
    liste_fiche_client();
});

// liste fiche client
function liste_fiche_client() {
    jQuery.ajax({
        url: "/fiche_clients_list" ,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.Liste_Fiche_client, function (key, item) {
                $tabledata = responce.Liste_Fiche_client;
            });
            var table = new Tabulator("#listeFicheClient", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 5,
                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "Aucun enregistrements correspondants trouvés",
                tooltips: true,
                columns: [
                    {
                        title: "Code client",
                        minWidth: 100,
                        responsive: 0,
                        field: "Code_client",
                        sorter: "string",
                        vertAlign: "middle",
                        col: "red",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Compte",
                        minWidth: 100,
                        responsive: 0,
                        field: "compte",
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
                        title: "Nom",
                        minWidth: 100,
                        field: "nom",
                        sorter: "number",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Ville",
                        field: "ville_client",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Téléphone client",
                        field: "tele_client",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Email client",
                        field: "email_client",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Marge client",
                        field: "marge_client",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Action",
                        minWidth: 100,
                        field: "actions",
                        responsive: 0,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                            $(`<div class="flex lg:justify-center items-center">
                           
                            <a class="view flex items-center text-success tooltip mr-3" data-tw-target="#header-footer-modal-preview2" title="Consulter">
                                <svg xmlns="http://www.w3.org/2000/svg " width="24 " height="24 " viewBox="0 0 24 24 " fill="none " stroke="currentColor " stroke-width="2 " stroke-linecap="round " stroke-linejoin="round " icon-name="eye " data-lucide="eye " class="lucide lucide-eye w-4 h-4 mr-1 "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z "></path><circle cx="12 " cy="12 " r="3 "></circle></svg>
                            </a>  
                            <button  class="edit text-primary flex items-center mr-3 tooltip" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                            </button>

                        <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                             <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                        </a>
                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/fiche_clients_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            const nv = responce.Hotel_transports;
                                            document.getElementById( "_id_").value = nv.id;
                                            document.getElementById("_compte").value = nv.compte;
                                            document.getElementById("_nom").value = nv.nom;
                                            document.getElementById("_adresse").value = nv.adresse;
                                            document.getElementById("_C_postal").value = nv.C_postal;
                                            document.getElementById("_contact_commercial").value = nv.contact_commercial;
                                            document.getElementById("_telephone_commercial").value = nv.telephone_commercial;
                                            document.getElementById("_mobile_commercial").value = nv.mobile_commercial;
                                            document.getElementById("_ville_client").value = nv.ville_client;
                                            document.getElementById("_tele_client").value = nv.tele_client;
                                            document.getElementById("_email_client").value = nv.email_client;
                                            document.getElementById("_pays_client").value = nv.pays_client;
                                            document.getElementById("_fax_client").value = nv.fax_client;
                                            document.getElementById("_marge_client").value = nv.marge_client;
                                            document.getElementById("_Remarques").value = nv.Remarques;
                                        },
                                    });
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/fiche_clients_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            const nv = responce.Hotel_transports;
                                            document.getElementById(
                                                "__id"
                                            ).value = nv.id;
                                        },
                                    });
                                });
                                $(a)
                                .find(".view")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/fiche_clients_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                           
                                        },
                                    });
                                });

                            return a[0];
                        },
                    },
                    // For print format
                    {
                        title: "Compte",
                        field: "compte",
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
                        title: "Compte postal",
                        field: "C_postal",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Contact commercial",
                        field: "contact_commercial",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "téléphone Commercial",
                        field: "telephone_commercial",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Mobile Commercial",
                        field: "mobile_commercial",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Ville client",
                        field: "ville_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "téléphone client",
                        field: "tele_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "téléphone client",
                        field: "tele_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Email client",
                        field: "email_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Pays client",
                        field: "pays_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Fax client",
                        field: "fax_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "téléphone client",
                        field: "tele_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Marge client",
                        field: "marge_client",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Remarques",
                        field: "Remarques",
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
               
                var Value = $('#compt').val();      
                var filters = [];
                if (Value ) {
                  filters.push({field: "compte", type: "like", value: Value});
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
                
                table.download("xlsx", "data.xlsx", {
                    sheetName: "Products",
                });
            });

          
            // Print
            $("#tabulator-print").on("click", function (event) {
                table.print();
            });
        },
    });
}

// Gestion fiche client
$(document).ready(function () { 
    liste_fiche_client();
    // ******Ajouter fiche client******
    $("#Ajouter_fiche_client").on("submit", function (e) {
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
                // rechercher_FKprg(ref_prog);
                liste_fiche_client();
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
    // ******update fiche client******
    $("#update_fiche_client").on("submit", function (e) {
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
                // rechercher_FKprg(ref_prog);
                liste_fiche_client();
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                toastr.error(response.errors);
            },
        });
    });
    // ******Delete fiche client******
    $("#delete_fiche_client").on("submit", function (e) {
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
                // rechercher_FKprg(ref_prog);
                liste_fiche_client();
            },
            error: function (response) {
                toastr.error("Contacter le serice IT");
            },
        });
    });
    // ******rechercher fiche client******
    $("#rech_fiche_client").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                jQuery("#large-modal-size-preview").trigger("click");
                liste_fiche_client();
                toastr.success(response.message);
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
});
// btn Nouveau
function vider_input() {
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
}
