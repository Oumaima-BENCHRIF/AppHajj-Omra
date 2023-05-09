$(window).on("load", function () {});
$(document).ready(function () {

    liste_Jornal();
    liste_Sens();
    Liste_ModeP();
    liste_client();
    liste_factures();
    $("#Add_Reglement").on("submit", function (e) {
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
                $('#ajouter').css('display', 'none'); 
                $('#lettrage').css('display', 'block'); 
               console.log(response.reglement);
                line_reglement(response.reglement);
               
            },
            error: function (response) {
               //toastr.error("Vérifier votre données");
                 toastr.error(response.error);
            },
        });
    });
    $("#add_factures").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                detail_reglement(response.reglement);
               
                line_reglement(response.reglement);
                         },       
            error: function (response) {
               //toastr.error("Vérifier votre données");
                 toastr.error(response.error);
            },
        });
    });
    $("#print_reglement").on("click",function()
    { 
        let numero_facture=$('#N_reglement').val();
  
        jQuery.ajax({
            url: "/generate_facture/"+num,
            type: "GET",
            data: num,
            success: function(response){
                window.location.href = "/generate_facture/"+id;
            },
            error: function(xhr, status, error){
                // handle any errors that occur during the AJAX request
                console.log("Error:", error);
            }
        });
    })
    $("#reglement").on("click",function()
    { 
                window.location.href = "/generate_re";
          
        });
   

});
function line_reglement(value)
{    jQuery.ajax({
    url: "/line_regle/" + value,
    type: "GET", // Le nom du fichier indiqué dans le formulaire
    dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
    // dataFilter: 'json', //forme data
    success: function (responce) {
        // Je récupère la réponse du fichier PHP
    $tabledata = "";
    jQuery.each(responce.line_regle, function (key, item) {
        $tabledata = responce.line_regle;
    });
    var table = new Tabulator("#line_Reglement", {
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
                title: "N_reglement",
                minWidth: 100,
                responsive: 0,
                field: "N_reglement",
                sorter: "string",
                vertAlign: "middle",
                col: "red",
                print: false,
                download: false,
         
            },
            {
                title: "date_r",
                minWidth: 100,
                field: "date_r",
                hozAlign: "left",
                vertAlign: "middle",
                print: false,
                download: false,
            },
            {
                title: "jornal",
                field: "jornal",
                minWidth: 100,
                sorter: "string",
                vertAlign: "middle",
                print: false,
                download: false,
            },
            {
                title: "montant",
                field: "montant",
                minWidth: 100,
                responsive: 0,
                sorter: "number",
                cssClass:"montant",
                print: false,
                download: false,
            },
            // {
            //     title: "Action",
            //     minWidth: 110,
            //     field: "actions",
            //     responsive: 0,
            //     hozAlign: "center",
            //     vertAlign: "middle",
            //     print: false,
            //     download: false,
            //     formatter(cell, formatterParams) {
            //         let a =
            //             $(`<div class="flex lg:justify-center items-center">
            //                 <button  class="edit text-primary flex items-center mr-3 tooltip"  title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#itinerair-footer-modal-preview">
            //                     <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
            //                 </button>
            //                 <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-itinerair-prg-modal">
            //                     <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
            //                 </a>
            //             </div>`);
            //         $(a)
            //             .find(".edit")
            //             .on("click", function () {
            //                 jQuery.ajax({
            //                     url:
            //                         "/update_info_itineraire/" +
            //                         cell.getData().id,
            //                     type: "GET", // Le nom du fichier indiqué dans le formulaire
            //                     dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            //                     // dataFilter: 'json', //forme data
            //                     success: function (responce) {
            //                         // Je récupère la réponse du fichier PHP
            //                         const nv =
            //                             responce.infos_itineraire;
            //                         document.getElementById(
            //                             "up_id_Itineraire"
            //                         ).value = nv.id;
            //                         document.getElementById(
            //                             "up_date_retour_Itineraire_"
            //                         ).value = nv.date_retour_Itineraire;
            //                         document.getElementById(
            //                             "up_ville_Itineraire_"
            //                         ).value = nv.ville_Itineraire;
            //                         document.getElementById(
            //                             "up_Transport_Itineraire_"
            //                         ).value = nv.Transport_Itineraire;
            //                         document.getElementById(
            //                             "up_itineraire_programme_"
            //                         ).value = nv.itineraire_programme;
            //                     },
            //                 });
            //             });

            //         $(a)
            //             .find(".delete")
            //             .on("click", function () {
            //                 jQuery.ajax({
            //                     url:
            //                         "/update_info_itineraire/" +
            //                         cell.getData().id,
            //                     type: "GET", // Le nom du fichier indiqué dans le formulaire
            //                     dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            //                     // dataFilter: 'json', //forme data
            //                     success: function (responce) {
            //                         const nv =
            //                             responce.infos_itineraire;
            //                         document.getElementById(
            //                             "id_delet_itineraire"
            //                         ).value = nv.id;
            //                     },
            //                 });
            //             });

            //         $(a)
            //             .find(".view")
            //             .on("click", function () {
            //                 window.location.replace(
            //                     "/liste_prog/" + cell.getData().id
            //                 );
            //             });

            //         return a[0];
            //     },
            // },
          
        ],
       
    });
},
});
}
function liste_Jornal() {
    jQuery.ajax({
        url: "/List_jornal",
        type: "GET",
        dataType: "json",
        success: function (responce) {
           
            $select_jornal = "";
           
            jQuery.each(responce.Liste_jornal, function (key, item) {
                $select_jornal =
                    $select_jornal +
                    '<option value="' +
                    item.designation +
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
                    item.designation +
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
                    item.designation +
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
                    item.nom +
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
function detail_reglement(value) {
    jQuery.ajax({
        url: "/detail_regle/" + value,
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.liste_regle, function (key, item) {
                $tabledata = responce.liste_regle;
            });
            var table = new Tabulator("#liste_Reglement", {
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
                        title: "Code_client",
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
                        title: "numero_facture",
                        minWidth: 100,
                        field: "numero_facture",
                        sorter: "number",
                        hozAlign: "left",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "date",
                        field: "date",
                        minWidth: 100,
                        sorter: "string",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Total",
                        field: "Total",
                        minWidth: 100,
                        responsive: 0,
                        sorter: "number",
                        cssClass:"total",
                        print: false,
                        download: false,
                    },
                    // {
                    //     title: "Action",
                    //     minWidth: 110,
                    //     field: "actions",
                    //     responsive: 0,
                    //     hozAlign: "center",
                    //     vertAlign: "middle",
                    //     print: false,
                    //     download: false,
                    //     formatter(cell, formatterParams) {
                    //         let a =
                    //             $(`<div class="flex lg:justify-center items-center">
                    //                 <button  class="edit text-primary flex items-center mr-3 tooltip"  title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#itinerair-footer-modal-preview">
                    //                     <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                    //                 </button>
                    //                 <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-itinerair-prg-modal">
                    //                     <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                    //                 </a>
                    //             </div>`);
                    //         $(a)
                    //             .find(".edit")
                    //             .on("click", function () {
                    //                 jQuery.ajax({
                    //                     url:
                    //                         "/update_info_itineraire/" +
                    //                         cell.getData().id,
                    //                     type: "GET", // Le nom du fichier indiqué dans le formulaire
                    //                     dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                    //                     // dataFilter: 'json', //forme data
                    //                     success: function (responce) {
                    //                         // Je récupère la réponse du fichier PHP
                    //                         const nv =
                    //                             responce.infos_itineraire;
                    //                         document.getElementById(
                    //                             "up_id_Itineraire"
                    //                         ).value = nv.id;
                    //                         document.getElementById(
                    //                             "up_date_retour_Itineraire_"
                    //                         ).value = nv.date_retour_Itineraire;
                    //                         document.getElementById(
                    //                             "up_ville_Itineraire_"
                    //                         ).value = nv.ville_Itineraire;
                    //                         document.getElementById(
                    //                             "up_Transport_Itineraire_"
                    //                         ).value = nv.Transport_Itineraire;
                    //                         document.getElementById(
                    //                             "up_itineraire_programme_"
                    //                         ).value = nv.itineraire_programme;
                    //                     },
                    //                 });
                    //             });

                    //         $(a)
                    //             .find(".delete")
                    //             .on("click", function () {
                    //                 jQuery.ajax({
                    //                     url:
                    //                         "/update_info_itineraire/" +
                    //                         cell.getData().id,
                    //                     type: "GET", // Le nom du fichier indiqué dans le formulaire
                    //                     dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                    //                     // dataFilter: 'json', //forme data
                    //                     success: function (responce) {
                    //                         const nv =
                    //                             responce.infos_itineraire;
                    //                         document.getElementById(
                    //                             "id_delet_itineraire"
                    //                         ).value = nv.id;
                    //                     },
                    //                 });
                    //             });

                    //         $(a)
                    //             .find(".view")
                    //             .on("click", function () {
                    //                 window.location.replace(
                    //                     "/liste_prog/" + cell.getData().id
                    //                 );
                    //             });

                    //         return a[0];
                    //     },
                    // },
                  
                ],
               
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
            // $("#tabulator-html-filter-form")[0].addEventListener(
            //     "keypress",
            //     function (event) {
            //         let keycode = event.keyCode ? event.keyCode : event.which;
            //         if (keycode == "13") {
            //             event.preventDefault();
            //             filterHTMLForm();
            //         }
            //     }
            // );
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