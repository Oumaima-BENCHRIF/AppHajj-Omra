$(window).on("load", function () {});
$(document).ready(function () {
  table_Facture();
    $("#Add_facture").on("submit", function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        const  detail=detail_facture();
       formData.push({
        name: "myList",
        value: JSON.stringify(detail),
    });
      
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData,// Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
           
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                
                toastr.success(response.message);
                
            },
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
    $("#print").on("click",function()
    { 
        let id=$('#id_fiche').val();
        let LOGO=$('#LOGO').val();console.log(LOGO).
        jQuery.ajax({
            url: "/generate/"+id,
            type: "GET",
            data: id,
            success: function(response){
                
                window.location.href = "/generate/"+id;

            },
            error: function(xhr, status, error){
                // handle any errors that occur during the AJAX request
                console.log("Error:", error);
            }
        });
    })
    $("#print_facture").on("click",function()
    { 
        let id=$('#_id').val();
  
        jQuery.ajax({
            url: "/generate_facture/"+id,
            type: "GET",
            data: id,
            success: function(response){
                window.location.href = "/generate_facture/"+id;
            },
            error: function(xhr, status, error){
                // handle any errors that occur during the AJAX request
                console.log("Error:", error);
            }
        });
    })
     // ******Situation Facture******
    $("#situation").on("click",function()
    {
        let id=document.getElementById('numfacture').value;
        console.log(id);
        Situation_facture( id);
    })
        // ******Delete Facture******
        $("#delet_facture").on("submit", function (e) {
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
                    table_Facture();
                },
                error: function (response) {
                    toastr.error("Contacter le serice IT");
                },
            });
        });
        $("#edit_facture").on("submit", function (e) {
            e.preventDefault();
            var $this = jQuery(this);
            var formData = jQuery($this).serializeArray();
            const  detail=detail_facture();
          
            formData.push({
             name: "myList",
             value: JSON.stringify(detail),
         });
            jQuery.ajax({
                url: $this.attr("action"),
                type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
                data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                // dataFilter: 'json', //forme data
                success: function (response) {
                    // Je récupère la réponse du fichier PHP
                    toastr.success(response.message);
                    jQuery("#header-footer-modal-preview").trigger("click");
                   
                },
                error: function (response) {
                    toastr.error("Vérifier votre données");
                    // toastr.error(response.error);
                },
            });
        });
    var tableData = [];
function detail_facture(){
$('#myTable tbody tr').each(function(rowIndex) {
  var rowData = {};

  $(this).find('td').each(function(cellIndex) {
    rowData['col'+cellIndex] = $(this).text();
  });

  tableData.push(rowData);
});

 // Outputs array of table data objects

// Create JavaScript table object
var table = {
  
  data: tableData
};


return table;
}
function table_Facture() {
    jQuery.ajax({
        url: "/facturation_List",
        type: "GET", 
        dataType: "json",
        success: function (responce) {
            $tabledata = "";
            jQuery.each(responce.Liste_Facture, function (key, item) {
                $tabledata = responce.Liste_Facture;
                
            });
            var table = new Tabulator("#Liste_Facture", {
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
                        title: "Code client",
                        width: 95,
                        field: "Code_client",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                      
                    },
                    {
                        title: "numero facture",
                        minWidth: 100,
                        width: 43,
                        field: "numero_facture",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },

                    {
                        title: "Numero dossier",
                        field: "Numero_dossier",
                        minWidth: 100,
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    {
                        title: "date",
                        field: "date",
                        minWidth: 100,
                        print: false,
                        download: false,
                    },
                    {
                        title: "Total",
                        field: "Total",
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
                                    <a class="view flex items-center text-success tooltip mr-3" title="print">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="printer" data-lucide="printer" class="lucide lucide-printer w-4 h-4 mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
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
                                    window.location.replace("/update_facture/" + cell.getData().id);
                                  
                                });

                            $(a)
                                .find(".delete")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/get_facture/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                  
                                            jQuery.each(
                                                responce.facture,
                                                function (key, item) {
                                                    console.log(item.id);
                                                    document.getElementById(
                                                        "delet_id_facture"
                                                    ).value = item.id;
                                                }
                                            );
                                        },
                                    });
                                });

                            $(a)
                                .find(".view")
                                .on("click", function () {
                                    jQuery.ajax({
                                        url:
                                            "/get_facture/" +
                                            cell.getData().id,
                                        type: "GET", // Le nom du fichier indiqué dans le formulaire
                                        dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                                        // dataFilter: 'json', //forme data
                                        success: function (responce) {
                                            jQuery.each(
                                                responce.facture,
                                                function (key, item) {
                                    window.location.replace(
                                        "/consult_facture/" + item.numero_facture
                                    );
                                }
                                );
                                },
                            });
                                });

                            return a[0];
                        },
                    },
                    // For print format
     
                ],

               
            });
            $('#search-btn').on('click', function() {
                var codeValue = $('#code').val();
                var dateValue = $('#date').val();
              
                var filters = [];
              
                if (codeValue) {
                  filters.push({field: "Code_client", type: "like", value: codeValue});
                }
              
                if (dateValue) {
                  filters.push({field: "date", type: "=", value: dateValue});
                }
              
                table.setFilter(filters);
              });
        }
    });
}
});
function Situation_facture(value) {
    jQuery.ajax({
      url: "/sitation_fact/" + value,
      type: "GET", // Le nom du fichier indiqué dans le formulaire
      dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
    // dataFilter: 'json', //forme data
    success: function (responce) {
        // Je récupère la réponse du fichier PHP
        $tabledata = "";
        jQuery.each(responce.ligne_lettrage, function (key, item) {
            $tabledata = responce.ligne_lettrage;
            document.getElementById('T_Facture').value=responce.facture.Total;
            document.getElementById('R_Facture').value=responce.facture.Total-responce.facture.Total_regler;
            console.log(responce);
        });
        var table = new Tabulator("#S_facture", {
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
                    title: "numero facture",
                    minWidth: 100,
                    field: "num_factures",
                    sorter: "string",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Code client",
                    minWidth: 100,
                    responsive: 0,
                    field: "Code_clt",
                    sorter: "string",
                    vertAlign: "middle",
                    col: "red",
                    print: false,
                    download: false,
             
                },
                {
                    title: "nummero reglement",
                    minWidth: 100,
                    field: "num_reglement",
                    sorter: "string",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "date lettrage",
                    field: "Date_Let",
                    minWidth: 100,
                    sorter: "string",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Acompte",
                    field: "Acompte",
                    minWidth: 100,
                    responsive: 0,
                    sorter: "string",
                    cssClass:"total",
                    print: false,
                    download: false,
                },
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
