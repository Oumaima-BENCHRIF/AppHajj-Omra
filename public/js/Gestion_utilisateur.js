$(document).ready(function () {
  $("#create_user").on("submit", function (e) {
    e.preventDefault();
    var $this = jQuery(this);
    var formData = jQuery($this).serializeArray();
    jQuery.ajax({
        url: $this.attr("action"),
        type: $this.attr("method"), // Le nom du fichier indiqué dans le formulaire
        data: formData, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        success: function (response) {
            toastr.success(response.message);
            viderchamp();
        },
        error: function (response) {
            toastr.error(response.error);
        },
    });
});
});