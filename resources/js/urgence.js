// Modifier Accompagnateurs
let verifShowDialogueModifie = false;
function showDialogueModifier(url) { 
    console.log(url);
    verifShowDialogueModifie = !verifShowDialogueModifie;
    if (verifShowDialogueModifie) {
        visibleDialogue("ModifierModal", true);
    } else {
        return visibleDialogue("ModifierModal", false);
    }
    ajaxPost(url, (obj) => {
        // --------------------------- fill
        const nv = obj.niveaux;
    
        document.getElementById("id_").value = nv.id;
        document.getElementById("code").value = nv.code;
        document.getElementById("nom_prenom").value = nv.nom_prenom;
        document.getElementById("telephone").value = nv.telephone;
        document.getElementById("fax").value = nv.fax;
        document.getElementById("adresse").value = nv.adresse;
        document.getElementById("prix").value = nv.prix;
        // console.log(document.getElementById("url_update").value);
    });
}
let verifSHowDialoguedelete = false;
function showDialogueDelete(id) {

    document.getElementById("__id").value = id;

    verifSHowDialoguedelete = !verifSHowDialoguedelete;
    if (verifSHowDialoguedelete) {
        visibleDialogue("deleteModal", true);
    } else {
        return visibleDialogue("deleteModal", false);
    }
    ajaxPost;
}
let verifShowDialogueAjouter = false;
function showDialogueAjouter() {
    console.log("id");
    verifShowDialogueAjouter = !verifShowDialogueAjouter;
    if (verifShowDialogueAjouter) {
        visibleDialogue("AjouterModal", true);
    } else {
        return visibleDialogue("AjouterModal", false);
    }
}

// modifier Compagnies
let verifShowDialogueModifiecompagnies = false;
function showDialogueModifiercompagnies(url) { 
    console.log(url);
    verifShowDialogueModifiecompagnies = !verifShowDialogueModifiecompagnies;
    if (verifShowDialogueModifiecompagnies) {
        visibleDialogue("ModifierModals", true);
    } else {
        return visibleDialogue("ModifierModals", false);
    }
    ajaxPost(url, (obj) => {
        // --------------------------- fill
        const nv = obj.niveaux;
    
        document.getElementById("id_").value = nv.id;
        document.getElementById("code_cie").value = nv.code_cie;
        document.getElementById("compagnie").value = nv.compagnie;
        document.getElementById("telephone").value = nv.telephone;
        document.getElementById("fax").value = nv.fax;
        document.getElementById("adresse").value = nv.adresse;
        document.getElementById("directeur").value = nv.directeur;
        document.getElementById("tel_directeur").value = nv.tel_directeur;
        document.getElementById("nom_en_arabe").value = nv.nom_en_arabe;
        document.getElementById("compte_comptable_BSP").value = nv.compte_comptable_BSP;
        document.getElementById("compte_comptable_normal").value = nv.compte_comptable_normal;
        // console.log(document.getElementById("url_update").value);
    });
}
// delete Compagnaie
let verifSHowDialoguedeleteCompagnaie = false;
function showDialogueDeleteCompagnaie(id) {
console.log(id);
    document.getElementById("__id").value = id;

    verifSHowDialoguedeleteCompagnaie = !verifSHowDialoguedeleteCompagnaie;
    if (verifSHowDialoguedeleteCompagnaie) {
        visibleDialogue("deleteModal", true);
    } else {
        return visibleDialogue("deleteModal", false);
    }
    ajaxPost;
}

// gestion Agents
let verifShowDialogueModifieAgents = false;
function showDialogueModifierAgents(url) { 

    verifShowDialogueModifieAgents = !verifShowDialogueModifieAgents;
    if (verifShowDialogueModifieAgents) {
        visibleDialogue("ModifierModals", true);
    } else {
        return visibleDialogue("ModifierModals", false);
    }
    ajaxPost(url, (obj) => {
       
        // --------------------------- fill
        const nv = obj.niveaux;
        document.getElementById("id_").value = nv.id;
        document.getElementById("code_agents").value = nv.code_agents;
        document.getElementById("nom_agents").value = nv.nom_agents;
        document.getElementById("telephone").value = nv.telephone;
        document.getElementById("fax").value = nv.fax;
        document.getElementById("adresse").value = nv.adresse;
          // console.log(document.getElementById("url_update").value);
    });
}
// delete Compagnaie
let verifSHowDialoguedeleteAgents = false;
function showDialogueDeleteAgents(id) {
console.log(id);
    document.getElementById("__id").value = id;

    verifSHowDialoguedeleteAgents = !verifSHowDialoguedeleteAgents;
    if (verifSHowDialoguedeleteAgents) {
        visibleDialogue("deleteModal", true);
    } else {
        return visibleDialogue("deleteModal", false);
    }
    ajaxPost;
}


// update TO
let verifShowDialogueModifieTO = false;
function showDialogueModifierTO(url) { 

    verifShowDialogueModifieTO = !verifShowDialogueModifieTO;
    if (verifShowDialogueModifieTO) {
        visibleDialogue("ModifierModals", true);
    } else {
        return visibleDialogue("ModifierModals", false);
    }
    ajaxPost(url, (obj) => {
       
        // --------------------------- fill
        const nv = obj.niveaux;
        document.getElementById("id_").value = nv.id;
        document.getElementById("code_TO").value = nv.code_TO;
        document.getElementById("nom_TO").value = nv.nom_TO;
        document.getElementById("telephone_TO").value = nv.telephone_TO;
        document.getElementById("fax_TO").value = nv.fax_TO;
        document.getElementById("ville_TO").value = nv.ville_TO;
          // console.log(document.getElementById("url_update").value);
    });
}
// delete Compagnaie
let verifSHowDialoguedeleteTO = false;
function showDialogueDeleteTO(id) {
console.log(id);
    document.getElementById("__id").value = id;

    verifSHowDialoguedeleteTO = !verifSHowDialoguedeleteTO;
    if (verifSHowDialoguedeleteTO) {
        visibleDialogue("deleteModal", true);
    } else {
        return visibleDialogue("deleteModal", false);
    }
    ajaxPost;
}

// update HOTELTRANSPORTS
let verifShowDialogueModifieHOTELTRANSPORTS= false;
function showDialogueModifierHOTELTRANSPORTS(url) { 

    verifShowDialogueModifieHOTELTRANSPORTS = !verifShowDialogueModifieHOTELTRANSPORTS;
    if (verifShowDialogueModifieHOTELTRANSPORTS) {
        visibleDialogue("ModifierModals", true);
    } else {
        return visibleDialogue("ModifierModals", false);
    }
    ajaxPost(url, (obj) => {
       
        // --------------------------- fill
        const nv = obj.niveaux;
        document.getElementById("id_").value = nv.id;
        document.getElementById("code").value = nv.code;
        document.getElementById("nom").value = nv.nom;
        document.getElementById("ville").value = nv.ville;
        document.getElementById("emplacement").value = nv.emplacement;
        document.getElementById("telephone").value = nv.telephone;
        document.getElementById("fax").value = nv.fax;
        document.getElementById("site").value = nv.site;
        document.getElementById("compte_comptable_ramadan").value = nv.compte_comptable_ramadan;
        document.getElementById("compte_comptable_mouloud").value = nv.compte_comptable_mouloud;
        document.getElementById("contact").value = nv.contact;
        document.getElementById("email").value = nv.email;
        document.getElementById("categorie").value = nv.categorie;
        document.getElementById("nom_en_arabe").value = nv.nom_en_arabe;
        document.getElementById("type").value = nv.type;
          // console.log(document.getElementById("url_update").value);
    });
}
// delete HOTELTRANSPORTS
let verifSHowDialoguedeleteHOTELTRANSPORTS = false;
function showDialogueDeleteHOTELTRANSPORTS(id) {
console.log('id',id);
    document.getElementById("__id").value = id;

    verifSHowDialoguedeleteHOTELTRANSPORTS = !verifSHowDialoguedeleteHOTELTRANSPORTS;
    if (verifSHowDialoguedeleteHOTELTRANSPORTS) {
        visibleDialogue("deleteModal", true);
    } else {
        return visibleDialogue("deleteModal", false);
    }
    ajaxPost;
}

// 
// update Fiche_client
let verifShowDialogueModifieFiche_client= false;
function showDialogueModifierFiche_client(url) { 

    verifShowDialogueModifieFiche_client = !verifShowDialogueModifieFiche_client;
    if (verifShowDialogueModifieFiche_client) {
        visibleDialogue("ModifierModals", true);
    } else {
        return visibleDialogue("ModifierModals", false);
    }
    ajaxPost(url, (obj) => {
       
        // --------------------------- fill
        const nv = obj.niveaux;
        document.getElementById("id_").value = nv.id;
        document.getElementById("compte").value = nv.code;
        document.getElementById("nom").value = nv.nom;
        document.getElementById("adresse").value = nv.ville;
        document.getElementById("C_postal").value = nv.emplacement;
        document.getElementById("contact_commercial").value = nv.telephone;
        document.getElementById("telephone_commercial").value = nv.fax;
        document.getElementById("mobile_commercial").value = nv.site;
        document.getElementById("ville_client").value = nv.site;
        document.getElementById("tele_client").value = nv.site;
        document.getElementById("email_client").value = nv.compte_comptable_ramadan;
        document.getElementById("pays_client").value = nv.compte_comptable_mouloud;
        document.getElementById("fax_client").value = nv.contact;
        document.getElementById("marge_client").value = nv.email;
        document.getElementById("Remarques").value = nv.categorie;
          // console.log(document.getElementById("url_update").value);
    });
}
// delete Fiche_client
let verifSHowDialoguedeleteFiche_client = false;
function showDialogueDeleteFiche_client(id) {
console.log('id',id);
    document.getElementById("__id").value = id;

    verifSHowDialoguedeleteFiche_client = !verifSHowDialoguedeleteFiche_client;
    if (verifSHowDialoguedeleteFiche_client) {
        visibleDialogue("deleteModal", true);
    } else {
        return visibleDialogue("deleteModal", false);
    }
    ajaxPost;
}
