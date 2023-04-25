// import { createIcons, icons } from "lucide";
// import Tabulator from "tabulator-tables";

// dossier dossier
$(document).ready(function () {

  
    
    list_gestion();
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
                jQuery("#ajouter-modal-dossier-preview").trigger("click");
                list_gestion();
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******update dossier******
    $("#up_gestion_dossier").on("submit", function (e) {
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
                list_gestion();
            },
            error: function (response) {
                toastr.error("Vérifier votre données");
                // toastr.error(response.error);
            },
        });
    });
    // ******Delete delet_Dossier******
    $("#delet_gestion_dossier").on("submit", function (e) {
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
                list_gestion();
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



});
// function de rechercher par FK_prg
function list_gestion() {
    jQuery.ajax({
        url: "/liste_gestion_dossier",
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            jQuery.each(responce.liste_gestion_dossier, function (key, item) {
                $tabledata = responce.liste_gestion_dossier;
            });

            var table = new Tabulator("#liste_dossier", {
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
                        title: "Nom dossier",

                        width: 95,
                        field: "nom_dossier",
                        vertAlign: "middle",
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
                        title: "Hijri date",
                        minWidth: 100,
                        width: 43,
                        field: "hijri_date",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },

                    {
                        title: "Date début",
                        field: "Date_debut",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Date fin",
                        field: "Date_fin",
                        minWidth: 100,
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
                                    <button  class="edit text-primary flex items-center mr-3 tooltip" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                                         <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
                                    </button>
                                    <a   class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                         <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                                    </a>
                            </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/gestion_dossier_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data

                                        success: function (responce) {
                                            // affichage select
                                            jQuery.each(
                                                responce.dossier,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "up_id_dossier"
                                                    ).value = item.id;
                                                    document.getElementById(
                                                        "up_nom_dossier"
                                                    ).value = item.nom_dossier;
                                                    document.getElementById(
                                                        "up_hijri_date"
                                                    ).value = item.hijri_date;
                                                    document.getElementById(
                                                        "up_date_debut"
                                                    ).value = item.Date_debut;
                                                    document.getElementById(
                                                        "up_date_fin"
                                                    ).value = item.Date_fin;
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
                                            "/gestion_dossier_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.dossier,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "delet_id_dossier"
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
                                        "/liste_prog/" + cell.getData().id
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
                    // alert("Row " + row.getData().id + " Clicked!!!!");
                    window.location.replace("/liste_prog/" + row.getData().id);

                    // jQuery.ajax({
                    //     url: "/liste_prog",
                    //     type: "GET", // Le nom du fichier indiqué dans le formulaire
                    //     dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                    //     // dataFilter: 'json', //forme data
                    //     success: function (responce) {
                    //         // jQuery.each(responce.dossier, function (key, item) {
                    //         //     document.getElementById(
                    //         //         "delet_id_dossier"
                    //         //     ).value = item.id;
                    //         // });
                    //     },
                    // });
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
         
            permission();
        },
    });
}
// Rechercher dossier dossier
function rechercher_dossier() {
    jQuery.ajax({
        url: "/rech_dossier",
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {
            console.log(responce.Rech_gestion_dossiers);
            // Je récupère la réponse du fichier PHP
            $tabledata = "";
            // console.log(responce.Rech_gestion_dossiers)
            jQuery.each(responce.Rech_gestion_dossiers, function (key, item) {
                $tabledata = responce.Rech_gestion_dossiers;
            });
            var table = new Tabulator("#liste_dossier", {
                printAsHtml: true,
                printStyled: true,
                // height: 220,
                data: $tabledata,
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 5,
                paginationSizeSelector: [10, 20, 30, 40],
                placeholder: "No matching records found",
                tooltips: true,
                columns: [
                    {
                        title: "Hijri date",
                        minWidth: 200,
                        field: "hijri_date",
                        sorter: "number",
                        hozAlign: "left",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div class="flex lg:justify-center">
                    <div class="w-10 h-10 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="build/assets/images/preview-14.jpg"> </div>\
                    </div>
                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="build/assets/images/preview-15.jpg"> </div>\
                    </div>
                </div>`;
                        },
                    },
                    {
                        title: "Nom dossier",
                        minWidth: 200,
                        responsive: 0,
                        field: "nom_dossier",
                        sorter: "string",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div>
                    <div class="font-medium whitespace-nowrap">${
                        cell.getData().nom_dossier
                    }</div>
                    <div class="text-slate-500 text-xs whitespace-nowrap">${
                        cell.getData().hijri_date
                    }</div>
                </div>`;
                        },
                    },
                    {
                        title: "Date début",
                        field: "Date_debut",
                        minWidth: 200,
                        sorter: "string",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Date fin",
                        field: "Date_fin",
                        minWidth: 200,
                        responsive: 0,
                        sorter: "number",
                        hozAlign: "center",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Action",
                        minWidth: 200,
                        field: "actions",
                        responsive: 1,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                    <button  class="edit flex items-center mr-3" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Modifier
                    </button>
                    <a class="delete flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Supprimer
                    </a>
                </div>`);
                            $(a)
                                .find(".edit")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/gestion_dossier_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data

                                        success: function (responce) {
                                            // affichage select
                                            jQuery.each(
                                                responce.dossier,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "up_id_dossier"
                                                    ).value = item.id;
                                                    document.getElementById(
                                                        "up_nom_dossier"
                                                    ).value = item.nom_dossier;
                                                    document.getElementById(
                                                        "up_hijri_date"
                                                    ).value = item.hijri_date;
                                                    document.getElementById(
                                                        "up_date_debut"
                                                    ).value = item.Date_debut;
                                                    document.getElementById(
                                                        "up_date_fin"
                                                    ).value = item.Date_fin;
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
                                            "/gestion_dossier_infos/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.dossier,
                                                function (key, item) {
                                                    document.getElementById(
                                                        "delet_id_dossier"
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
                // rowClick: function (e, row) {
                //     alert("Row " + row.getData().playerid + " Clicked!!!!");
                // },
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
            $("#tabulator-print").on("click", function (event) {
                table.print();
            });
         
        },
    });


}
function permission(){
    var permiDelete =document.getElementById('permiDelete').value;
     if(permiDelete!=1)
     {
        let elements= document.getElementsByClassName('delete');
        for (let i = 0; i < elements.length; i++) {
         elements[i].style.display = "none"; 
       }
       
     }
     var permiUpdate =document.getElementById('permiUpdate').value;
     if(permiUpdate!=1)
     {
        let elements= document.getElementsByClassName('edit');
        for (let i = 0; i < elements.length; i++) {
         elements[i].style.display = "none"; 
       }
       
     }
     var permiConsult =document.getElementById('permiConsult').value;
     if(permiConsult!=1)
     {
        let elements= document.getElementsByClassName('view');
        for (let i = 0; i < elements.length; i++) {
         elements[i].style.display = "none"; 
       }
       
     }
    }