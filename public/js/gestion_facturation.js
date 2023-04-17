$(window).on("load", function () {});
$(document).ready(function () {
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

});