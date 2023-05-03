$(window).on("load", function () {});
$(document).ready(function () {
    liste_compagnie();
    liste_hetel();  
    $("#search_allotement").on("submit", function (e) {
    
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                document.getElementById('table_data').style.display='block';
                $tabledata =response.liste_detail_hotel;
                console.log(response.liste_detail_hotel);
                var table = new Tabulator("#liste_EtatVol", {
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
                            title: "nom_client",
    
                            width: 150,
                            field: "nom_client",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                        },
                        {
                            title: "prenom_client",
                            minWidth: 150,
                            width: 43,
                            field: "prenom_client",
                            hozAlign: "center",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                        },
    
                        {
                            title: "date_expiration",
                            field: "date_expiration",
                            minWidth: 100,
                            vertAlign: "middle",
                            print: false,
                            download: false,
                        },
                        {
                            title: "telephone",
                            field: "telephone",
                            minWidth: 100,
                            print: false,
                            download: false,
                        },
                        {
                            title: "type chambre ",
                            minWidth: 90,
                            field: "type_chambre_prg",
                            responsive: 1,
                            hozAlign: "center",
                            vertAlign: "middle",
                            print: false,
                            download: false,
                            
                        },
                      
                    ],
    
                });
                $('#search-btn').on('click', function() {
                    var codeValue = $('#name').val();
                    var dateValue = $('#date').val();
                  
                    var filters = [];
                  
                    if (codeValue) {
                      filters.push({field: "nom_dossier", type: "like", value: codeValue});
                    }
                  
                    if (dateValue) {
                      filters.push({field: "Date_debut", type: "=", value: dateValue});
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
            error: function (response) {
                toastr.error(response.errors);
            },
        });
    });
   

});

function liste_compagnie() {
    jQuery.ajax({
        url: "/List_compagnie",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_compagnie = "";
           
            jQuery.each(responce.Liste_Compagnies, function (key, item) {
                $select_compagnie =
                    $select_compagnie +
                    '<option value="' +
                    item.id +
                    '">' +
                    item.compagnie +
                    "</option>";
            });
            $("#compagnies").html($select_compagnie);
        
        },
    });
}
function liste_hetel() {
    jQuery.ajax({
        url: "/liste_hotel",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_hotel = "";
           console.log(responce.Liste_Hotel)
            jQuery.each(responce.Liste_Hotel, function (key, item) {
                $select_hotel =
                    $select_hotel +
                    '<option value="' +
                    item.hotel_prg +
                    '">' +
                    item.hotel_prg +
                    "</option>";
            });
            $("#hotel").html($select_hotel);
        
        },
    });
}