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

table.data.splice(0, 1);

return table;
}
function table_Facture() {
  jQuery.ajax({
      url: "/facturation_List",
      type: "GET", // Le nom du fichier indiqué dans le formulaire
      dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
      // dataFilter: 'json', //forme data
         
      success: function (responce) {
        console.log('rrrr');
          // Je récupère la réponse du fichier PHP
          jQuery.each(responce.Liste_Facture, function (key, item) {
         console.log(responce.Liste_Facture);
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
                      title: "Code_client",
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
                      vertAlign: "middle",
                      print: false,
                      download: false,
                  },
                  {
                      title: "Total",
                      field: "Total",
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

                                  <a class="delete flex items-center text-danger tooltip" title="Supprimer" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                  <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' icon-name='trash-2' data-lucide='trash-2' class='lucide lucide-trash-2 w-4 h-4 mr-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>\n
                             </a>
                          </div>`);

                          // $(a)
                          //     .find(".delete")
                          //     .on("click", function () {
                          //         jQuery.ajax({
                          //             url: "/Agents_infos/" + cell.getData().id,
                          //             type: "get", // Le nom du fichier indiqué dans le formulaire
                          //             dataType: "json",
                          //              // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                          //             // dataFilter: 'json', //forme data
                          //             success: function (responce) {
                          //                 jQuery.each(
                          //                     responce.info_Agents,
                          //                     function (key, item) {
                          //                         document.getElementById(
                          //                             "__id"
                          //                         ).value = item.id;
                          //                     }
                          //                 );
                          //             },
                          //         });
                          //     });

                          // $(a)
                          //     .find(".edit")
                          //     .on("click", function () {
                          //         jQuery.ajax({
                          //             url: "/Agents_infos/" + cell.getData().id,
                          //             type: "get", // Le nom du fichier indiqué dans le formulaire
                          //             dataType: "json", // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                          //             // dataFilter: 'json', //forme data
                          //             success: function (responce) {
                          //                 // Je récupère la réponse du fichier PHP
                          //                 jQuery.each(
                          //                     responce.info_Agents,
                          //                     function (key, item) {
                          //                         console.log(item);
                          //                         document.getElementById(
                          //                             "id_"
                          //                         ).value = item.id;
                          //                         document.getElementById(
                          //                             "code_agents_"
                          //                         ).value = item.code_agents;
                          //                         document.getElementById(
                          //                             "nom_agents_"
                          //                         ).value = item.nom_agents;
                          //                         document.getElementById(
                          //                             "telephone_"
                          //                         ).value = item.telephone;
                          //                         document.getElementById(
                          //                             "fax_"
                          //                         ).value = item.fax;
                          //                         document.getElementById(
                          //                             "adresse_"
                          //                         ).value = item.adresse;
                          //                     }
                          //                 );
                          //             },
                          //         });
                          //     });

                          // return a[0];
                      },
                  },
                  // For print format
                  // For print format
                  // {
                  //     title: "Code",
                  //     field: "code_agents",
                  //     visible: false,
                  //     print: true,
                  //     download: true,
                  // },
                  // {
                  //     title: "Nom",
                  //     field: "nom_agents",
                  //     visible: false,
                  //     print: true,
                  //     download: true,
                  // },
                  // {
                  //     title: "Telephone",
                  //     field: "telephone",
                  //     visible: false,
                  //     print: true,
                  //     download: true,
                  // },
                  // {
                  //     title: "Fax",
                  //     field: "fax",
                  //     visible: false,
                  //     print: true,
                  //     download: true,
                  // },
                  // {
                  //     title: "Adresse",
                  //     field: "adresse",
                  //     visible: false,
                  //     print: true,
                  //     download: true,
                  // },
                 
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
         
          // $("#tabulator-export-json").on("click", function (event) {
          //     table.download("json", "data.json");
          // });

          // $("#tabulator-export-xlsx").on("click", function (event) {
             
          //     table.download("xlsx", "data.xlsx", {
          //         sheetName: "Products",
          //     });
          // });

         
          // Print
          // $("#tabulator-print-To").on("click", function (event) {
          //     table.print();
          // });
          permission();
      },
      error: function(xhr, status, error){
        // handle any errors that occur during the AJAX request
        console.log("Error:", error);
    }
  });
}
});
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