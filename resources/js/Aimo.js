$(document).ready(function() {
    // Lorsque je soumets le formulaire

    $('#formmaritime').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        console.log($this);
        // alert('OK');
        formmaritime($this);

    });

});

function formmaritime($this) {





    // var formDatabill = $('#formmaritime').serializeArray();
    var x = $("#formmaritime").serializeArray();
    
    // Envoi de la requête HTTP en mode asynchrone
    $.ajax({
        url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
        type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
        data: formDatabill, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        success: function(html) { // Je récupère la réponse du fichier PHP

            alert("test");

        }
    });


}

function showDialogueDeleteTO(id) {
    console.log(id);
    document.getElementById("__id").value = id;
    // ajaxPost;

}

function ajaxPost(url, callback, datas = []) {
    const formData = new FormData();
    formData.append('_token', document.querySelector("[name='csrf-token']").content);
    datas.forEach((data) => {
        formData.append(data.key, data.value);
    })
    fetch(url, {
            method: 'POST',
            body: formData,
            credentials: 'include'
        })
        .then(response => response.json())
        .then(result => {
            callback(result)
        })
    //        .catch(error => { alert('Error:', error.code); document.getElementById("dialogue-wait").style.display = "none"; });
}

function showDialogueModifierTO(url) {

    console.log(url);

    // document.getElementById("id_").value = id;

    ajaxPost(url, (obj) => {

        // --------------------------- fill
        const nv = obj.to_s;
        document.getElementById("_id_").value = nv.id;
        document.getElementById("code_to").value = nv.code;
        document.getElementById("nom_to").value = nv.nom;
        document.getElementById("telephone_to").value = nv.telephone;
        document.getElementById("fax_to").value = nv.fax;
        document.getElementById("ville_to").value = nv.ville;
        // console.log(document.getElementById("url_update").value);
    });
}