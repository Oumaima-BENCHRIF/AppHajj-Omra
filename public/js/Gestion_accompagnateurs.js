$(window).on("load", function () {});
$(document).ready(function () {
    table_Accompagnateur();
    // ******Ajouter Acompagnateur******
    $("#Add_Acompagnateur").on("submit", function (e) {
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
                table_Accompagnateur();
                viderchamps();
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
    // ******update Acompagnateur******
    $("#update_Acompagnateur").on("submit", function (e) {
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
                table_Accompagnateur();
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
    // ******Delete Acompagnateur******
    // $("#delete_Acompagnateur").on("submit", function (e) {
    //     e.preventDefault();
    //     var $this = jQuery(this);
    //     var formData = jQuery($this).serializeArray();
    //     jQuery.ajax({
    //         url: $this.attr("action"),
    //         type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
    //         data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
    //         // dataFilter: 'json', //forme data
    //         success: function (response) {
    //             // Je récupère la réponse du fichier PHP
    //             toastr.success(response.message);
    //             jQuery("#delete-confirmation-modal").trigger("click");
    //             table_Accompagnateur();
    //         },
    //         error: function (response) {
    //             toastr.error(response.errors);
    //         },
    //     });
    // });
});
function viderchamps() {
    document.getElementById("code_agents").value = "";
    document.getElementById("nom_prenom").value = "";
    document.getElementById("telephone").value = "";
    document.getElementById("fax").value = "";
    document.getElementById("adresse").value = "";
    document.getElementById("prix").value = "";
}
// ---------------liste of TO
// function de rechercher par FK_prg
function table_Accompagnateur() {
    jQuery.ajax({
        url: "/Accompagnateurs_Liste",
        type: "GET", // Le nom du fichier indiqué dans le formulaire
        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        // dataFilter: 'json', //forme data
        success: function (responce) {

            // Je récupère la réponse du fichier PHP
            jQuery.each(responce.Liste_Accompagnateur, function (key, item) {
           
                $tabledata = responce.Liste_Accompagnateur;
            });

            var table = new Tabulator("#liste_Accompagnateur", {
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
                        field: "nom_prenom",
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
                        title: "Adresse",
                        field: "adresse",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Fax",
                        field: "fax",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "Prix",
                        field: "prix",
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
                                       
                                        url: "/Accompagnateurs_infos/" + cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json",
                                         // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.Accompagnateur_infos,
                                                function (key, item) {
                                                    console.log(item);
                                                    document.getElementById(
                                                        "__id"
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
                                        url: "/Accompagnateurs_infos/" + cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            // Je récupère la réponse du fichier PHP
                                            jQuery.each(
                                                responce.Accompagnateur_infos,
                                                function (key, item) {
                                                    console.log(item);
                                                    document.getElementById(
                                                        "id__"
                                                    ).value = item.id;
                                                    document.getElementById(
                                                        "_code"
                                                    ).value = item.code;
                                                    document.getElementById(
                                                        "_nom_prenom"
                                                    ).value = item.nom_prenom;
                                                    document.getElementById(
                                                        "_adresse"
                                                    ).value = item.adresse;
                                                    document.getElementById(
                                                        "_fax"
                                                    ).value = item.fax;
                                                    document.getElementById(
                                                        "_telephone"
                                                    ).value = item.telephone;
                                                    document.getElementById(
                                                        "_prix"
                                                    ).value = item.prix;
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
                        field: "nom_prenom",
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
                        title: "Fax",
                        field: "fax",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Adresse",
                        field: "adresse",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "Prix",
                        field: "prix",
                        visible: false,
                        print: true,
                        download: true,
                    },
                   
                ],

                rowDblClick: function (e, row) {},
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
              
                table.download("xlsx", "data.xlsx");
            });

           
            // Print
            $("#tabulator-print-To").on("click", function (event) {
                table.print();
            });
            permission();
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
    
    }
