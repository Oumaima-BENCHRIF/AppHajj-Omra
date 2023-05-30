$(window).on("load", function () {});
var tableline;
var rowselect;
$(document).ready(function () {
    
    liste_Jornal();
    liste_Sens();
    Liste_ModeP();
    liste_client();
    liste_factures();
    liste_Reglement();
    $("#Add_Reglement").on("submit", function (e) {
        let  Num=$('#N_reglement').val();
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        
        formData.push({
            name: "num_regl",
            value: Num,
        });
        
        jQuery.ajax({
            url: $this.attr("action"),
            type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
            data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            // dataFilter: 'json', //forme data
            success: function (response) {
                // Je récupère la réponse du fichier PHP
                toastr.success(response.message);
                $('#lettrage').css('display', 'block'); 
                $('#reglement').css('display', 'block');   
                line_reglement(response.reglement); 
            },
            error: function (response) {
               //toastr.error("Vérifier votre données");
                 toastr.error(response.error);
            },
        });
    });
    $("#add_factures").on("submit", function (e) {
     
        var rowCount = tableline.getDataCount();
        let Acompte=$('#Acompte').val();
        let rest= document.getElementById('R_total').value;
        e.preventDefault();
        var $this = jQuery(this);
        var formData = jQuery($this).serializeArray();
        if(rowCount>1)
        {
        var selectedRows = tableline.getSelectedRows();
        if (selectedRows.length > 0) {
            rowselect = selectedRows[0].getData();
            rest_regle= rowselect.rest_reglement;
        formData.push({
            name: "id",
           value: rowselect.id,
        })
        formData.push({
            name: "num",
           value: rowselect.N_reglement,
        })
        
        if(parseFloat(Acompte)>parseFloat(rest_regle))
            {
             alert('Acompte est supérieur à le reste sur reglement');
             console.log('supérieur');
            }else
            {
           if(parseFloat(Acompte)>parseFloat(rest))
             {
              alert('Acompte est supérieur à le reste sur facture');
             }else {
             if(parseFloat(Acompte)<=parseFloat(rest) && parseFloat(Acompte)<=parseFloat(rest_regle) )
             {
           
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
    }}}
  
    }
} else{
       
        var rowData = tableline.getData(); 
        rest_regle= rowData[0].rest_reglement;
        formData.push({
            name: "id",
           value: rowData[0].id,
        })
        formData.push({
            name: "num",
           value: rowData[0].N_reglement,
        })
        if(parseFloat(Acompte)>parseFloat(rest_regle))
        {
         alert('Acompte est supérieur à le reste sur reglement');
        }else
        {
       if(parseFloat(Acompte)>parseFloat(rest))
         {
          alert('Acompte est supérieur à le reste sur facture');
         }else {
         if(parseFloat(Acompte)<parseFloat(rest) && parseFloat(Acompte)<parseFloat(rest_regle) && rest!=0)
         {
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
        });}}}
    
    }
    });
    $("#reglement").on("click",function()
    {   let N_reglement=0;
   if ($('#N_reglement').css('display') === 'block'){
        N_reglement=$('#N_reglement').val();
    }else
    {
        N_reglement=$('#num_reglement').val();
    }
        
                window.location.href = "/generate_re/"+N_reglement;
          
        });
    $("#nouveaux").on("click",function()
        {      
            $('#N_reglement').css('display', 'block'); 
            $('#num_reglement').css('display', 'none'); 
            $('#lettrage').css('display', 'none'); 
            $('#reglement').css('display', 'none'); 
            $('#line_Reglement').css('display', 'none'); 
    });
   $('#factures').on('change', function() {
            var selectedInvoiceNumber = $(this).val();
            jQuery.ajax({
                url: '/get_facture',
                method: 'GET',
                data: { invoice_number: selectedInvoiceNumber },
                success: function(response) {
                 let total=   document.getElementById('Totalf').value=response.facture[0].Total;
                 let total_R= response.facture[0].Total_regler;
                let rest = total-total_R;
                document.getElementById('R_total').value=rest;
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
  $('#num_reglement').on('change', function() { 
    
            var selected = $(this).val();
       
                    $('#lettrage').css('display', 'block'); 
                    $('#reglement').css('display', 'block'); 
                     detail_reglement(selected); 
                    line_reglement(selected);
             
        });


});


function line_reglement(value)
{   
     jQuery.ajax({
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
   
     tableline = new Tabulator("#line_Reglement", {
        printAsHtml: true,
        printStyled: true,
        selectable:true,
        selectableRangeMode:"click",
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
                title: "Nligne",
                minWidth: 80,
                responsive: 0,
                field: "Nligne",
                sorter: "string",
                vertAlign: "middle",
                col: "red",
                print: false,
                download: false,
         
            },
            {
                title: "Numero reglement",
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
                title: "date reglement",
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
                
                print: false,
                download: false,
            },
            {
                title: "Rest sur Reglement",
                field: "rest_reglement",
                minWidth: 100,
                responsive: 0,
                sorter: "number",
                cssClass:"montant",
                print: false,
                download: false,
            },
            
          
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
                    item.compte +
                    '">' +
                    item.nom +
                    "</option>";
            });
            $("#client").html($select_client);
        
        },
    });
}
function liste_Reglement() {
    jQuery.ajax({
        url: "/liste_Reglement",
        type: "GET",
        dataType: "json",
        success: function (responce) {
            $select_reglement = "";
            jQuery.each(responce.Liste_regle, function (key, item) {
                $select_reglement =
                    $select_reglement +
                    '<option value="' +
                    item.N_reglement +
                    '">' +
                    item.N_reglement +
                    "</option>";
            });
            $("#num_reglement").html($select_reglement);
        
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
                    item.numero_facture +
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
                let acompte=document.getElementById('Acompte').value;
                document.getElementById('R_total').value=document.getElementById('R_total').value- acompte;
                console.log(responce);
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
                        title: "Nligne",
                        minWidth: 80,
                        field: "Nligne",
                        sorter: "string",
                        hozAlign: "left",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
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
                        title: "date",
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