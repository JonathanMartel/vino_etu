/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */


const BaseURL = document.baseURI;


/**
 * Gestionnaire d'évènement au téléchargement de la page
 */

window.addEventListener('load', function() {
    console.log("load");

     /* Object bouteille avec ses propriétés*/  
    let bouteille = {
      nom : document.querySelector(".nom_bouteille"),
      millesime : document.querySelector("[name='millesime']"),
      quantite : document.querySelector("[name='quantite']"),
      date_achat : document.querySelector("[name='date_achat']"),
      prix : document.querySelector("[name='prix']"),
      garde_jusqua : document.querySelector("[name='garde_jusqua']"),
      notes : document.querySelector("[name='notes']"),
    };


/***************************************************************************** */

/* COMPOSANT BOUTEILLE 

/***************************************************************************** */

    /* Boucle pour ajouter un gestionnaire d'évènement clique sur le bouton boire de d'une bouteille du cellier
    -- À factoriser */
    document.querySelectorAll(".btnBoire").forEach(function(element){
       // console.log(element);
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            let elemBouteille = evt.target.parentElement.parentElement;
            let elemQuantite = elemBouteille.querySelector('.quantite').innerText.split(': ');
            let newQuantite = parseInt(elemQuantite[1]) - 1
            
            let requete = new Request(BaseURL+"index.php?requete=boireBouteilleCellier", {method: 'POST', body: '{"id": '+id+'}'});

            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  /* Update quantite -- à factorisé */
                  elemBouteille.querySelector('.quantite').innerText = 'Quantité : ' + newQuantite
                  return response.json();
                } else {
                  throw new Error('Erreur');
                }
              })
              .then(response => {
                console.debug(response);
              }).catch(error => {
                console.error(error);
              });
        })

    });


    /* Boucle pour ajouter un gestionnaire d'évènement clique sur le bouton ajouter de l'une bouteille du cellier
    -- À factoriser */
    document.querySelectorAll(".btnAjouter").forEach(function(element){
        //console.log(element);
        element.addEventListener("click", function(evt){

            let id = evt.target.parentElement.dataset.id;
            let elemBouteille = evt.target.parentElement.parentElement;
            let elemQuantite = elemBouteille.querySelector('.quantite').innerText.split(': ');
            let newQuantite = parseInt(elemQuantite[1]) + 1

            let requete = new Request(BaseURL+"index.php?requete=ajouterBouteilleCellier", {method: 'POST', body: '{"id": '+id+', "nombre": '+1+'}'});

            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  /* Update quantite -- à factorisé */
                  elemBouteille.querySelector('.quantite').innerText = 'Quantité : ' + newQuantite
                  return response.json();
                } else {
                  throw new Error('Erreur');
                }
              })
              .then(response => {
                console.debug(response);
              }).catch(error => {
                console.error(error);
              });
        })

    });

/***************************************************************************** */

/* COMPOSANT BOUTEILLE FIN

/***************************************************************************** */



/***************************************************************************** */

/* FORM AJOUTER

/***************************************************************************** */



/**
 * Gestionnaire d'évènement keyUp sur la boîte de dialogue 
 * Permet d'afficher le nom des bouteilles de la bd qui correspond aux caractères tapés
 * Ajout un gestionnaire d'évènement clique sur les noms affichés
 */
    let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
   // console.log(inputNomBouteille);
    let liste = document.querySelector('.listeAutoComplete');

    if(inputNomBouteille){
      inputNomBouteille.addEventListener("keyup", function(evt){
        console.log(evt);
        let nom = inputNomBouteille.value;
        liste.innerHTML = "";

        if(nom){
          let requete = new Request(BaseURL+"index.php?requete=autocompleteBouteille", {method: 'POST', body: '{"nom": "'+nom+'"}'});
          
          fetch(requete)
              .then(response => {
                  if (response.status === 200) {
                   // console.log(response.json)
                    return response.json();
                  } else {
                    throw new Error('Erreur');
                  }
                })
                .then(response => {
                  //console.log(response);

                  response.forEach(function(element){
                    liste.innerHTML += "<li data-id='"+element.id +"'>"+element.nom+"</li>";
                  })

                }).catch(error => {
                  console.error(error);
                });
        }
      });




    /*
      * Gestionnaire d'évènement clique sur l'élément li ( nom de la bouteille ) 
        qui permet de faire la sélection parmi les choix de la liste
    */
      liste.addEventListener("click", function(evt){
        console.dir(evt.target)
        if(evt.target.tagName == "LI"){
          bouteille.nom.dataset.id = evt.target.dataset.id;
          bouteille.nom.innerHTML = evt.target.innerHTML;
          
          liste.innerHTML = "";
          inputNomBouteille.value = "";

        }
      });


      /**
       * VUE = Formulaire ajout d'une nouvelle bouteille
       * Gestion évènement clique sur le bouton Ajouter une bouteille au cellier
       */
      let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
      if(btnAjouter){
        btnAjouter.addEventListener("click", function(evt){
          var param = {
            "id_bouteille":bouteille.nom.dataset.id,
            "date_achat":bouteille.date_achat.value,
            "garde_jusqua":bouteille.garde_jusqua.value,
            "notes":bouteille.notes.value,
            "prix":bouteille.prix.value,
            "quantite":bouteille.quantite.value,
            "millesime":bouteille.millesime.value,
          };

          /*Validation TODO avant requête*/

          let requete = new Request(BaseURL+"index.php?requete=ajouterNouvelleBouteilleCellier", {method: 'POST', body: JSON.stringify(param)});
            
          fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                      console.log(bouteille.quantite.value);
                      return response.json();
                    } else {
                      throw new Error('Erreur');
                    }
                  })
                  .then(response => {
                    console.log(response);
                   // window.location.href = BaseURL;
                  }).catch(error => {
                    console.error(error);
                  });
        
        });
      } 
  }
});

/***************************************************************************** */

/* FORM AJOUTER FIN

/***************************************************************************** */