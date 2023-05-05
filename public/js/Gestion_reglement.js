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
               
                line_reglement(response.reglement);
               
            },
            error: function (response) {
               //toastr.error("Vérifier votre données");
                 toastr.error(response.error);
            },
        });
    });
    $("#add_factures").on("click", function (e) {
        let num_regl=$('#N_reglement').val();
        let num_fact=$('#factures').val();
        var form;
        // formData.push({
        //     name: "num_regl",
        //     value: num_regl,
        // });
        form.append("num_fact", num_fact);
        console.log(form.num_fact);
        // jQuery.ajax({
        //     url: "/generate/"+id,
        //     type: "GET",
        //     data: formData,
        //     success: function(response){
                
        //     },
        //     error: function(xhr, status, error){
              
        //     }
        // });
    });
});
function line_reglement(data)
{
    $tabledata = data;
    
    var table = new Tabulator("#line_Reglement", {
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
                title: "N_reglement",
                width: 95,
                field: "N_reglement",
                vertAlign: "middle",
                print: false,
                download: false,
              
            },
            // {
            //     title: "date_r",
            //     minWidth: 100,
            //     width: 43,
            //     field: "date_r",
            //     hozAlign: "center",
            //     vertAlign: "middle",
            //     print: false,
            //     download: false,
            // },

            // {
            //     title: "jornal",
            //     field: "jornal",
            //     minWidth: 100,
            //     vertAlign: "middle",
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "utilisateur",
            //     field: "utilisateur",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "client",
            //     field: "client",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "n_piece",
            //     field: "n_piece",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "sens",
            //     field: "sens",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "mode",
            //     field: "mode",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "societe",
            //     field: "societe",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "montant",
            //     field: "montant",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "libelle",
            //     field: "libelle",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "m_reglement",
            //     field: "m_reglement",
            //     minWidth: 100,
            //     print: false,
            //     download: false,
            // },
            // {
            //     title: "Action",
            //     minWidth: 110,
            //     field: "actions",
            //     responsive: 1,
            //     hozAlign: "center",
            //     vertAlign: "middle",
            //     print: false,
            //     download: false,
            //     formatter(cell, formatterParams) {
            //         let a =
            //             $(`<div class="flex lg:justify-center items-center">
            //                 <a class="view flex items-center text-success tooltip mr-3" title="print">
            //                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="printer" data-lucide="printer" class="lucide lucide-printer w-4 h-4 mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            //                 </a>
            //                 <button  class="edit text-primary flex items-center mr-3 tooltip" title="Modifier" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
            //                      <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='check-square' data-lucide='check-square' class='lucide lucide-check-square w-4 h-4 mr-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11'></path></svg>\n
            //                 </button>
            //                 <a   class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
            //                      <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
            //                 </a>
            //         </div>`);
            //         $(a)
            //             .find(".edit")
            //             .on("click", function () {
            //                 window.location.replace("/update_facture/" + cell.getData().id);
                          
            //             });

            //         $(a)
            //             .find(".delete")
            //             .on("click", function () {
            //                 jQuery.ajax({
            //                     url:
            //                         "/get_facture/" +
            //                         cell.getData().id,
            //                     type: "GET", // Le nom du fichier indiqué dans le formulaire
            //                     dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            //                     // dataFilter: 'json', //forme data
            //                     success: function (responce) {
                          
            //                         jQuery.each(
            //                             responce.facture,
            //                             function (key, item) {
            //                                 console.log(item.id);
            //                                 document.getElementById(
            //                                     "delet_id_facture"
            //                                 ).value = item.id;
            //                             }
            //                         );
            //                     },
            //                 });
            //             });

            //         $(a)
            //             .find(".view")
            //             .on("click", function () {
            //                 window.location.replace(
            //                     "/create_facture/" + cell.getData().fk_fiche
            //                 );
            //             });

            //         return a[0];
            //     },
            // },
            // For print format

        ],

       
    }
    );
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