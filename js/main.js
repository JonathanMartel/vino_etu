/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//const BaseURL = "https://localhost/vino_etu/";
const BaseURL = "http://localhost:8080/vino_etu/";

//console.log(BaseURL);

window.addEventListener('load', function () {

  // console.log("load");


  /*
  * Gerer l evenement lorsqu on clique sur le boutton  'Boire'
  */
  document.querySelectorAll(".btnBoire").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(BaseURL + "index.php?requete=boireBouteilleCellier", { method: 'POST', body: '{"id": ' + id + '}' });

      fetch(requete)
        .then(response => {
          if (response.status === 200) {
            // Récharger la page  
            location.reload();
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

  /*
  * Gerer l evenement lorsqu on clique sur le boutton  'Ajouter'
  */
  document.querySelectorAll(".btnAjouter").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(BaseURL + "index.php?requete=ajouterBouteilleCellier", { method: 'POST', body: '{"id": ' + id + '}' });

      fetch(requete)
        .then(response => {
          if (response.status === 200) {
            // Récharger la page 
            location.reload();
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
  /*
  * Gerer l evenement lorsqu on clique sur le boutton  'Boire'
  */
  document.querySelectorAll(".btnBoiresaq").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(BaseURL + "index.php?requete=boireBouteilleCellierSAQ", { method: 'POST', body: '{"id": ' + id + '}' });

      fetch(requete)
        .then(response => {
          if (response.status === 200) {
            // Récharger la page  
            location.reload();
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

  /*
  * Gerer l evenement lorsqu on clique sur le boutton  'Ajouter'
  */
  document.querySelectorAll(".btnAjoutersaq").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(BaseURL + "index.php?requete=ajouterBouteilleCellierSAQ", { method: 'POST', body: '{"id": ' + id + '}' });

      fetch(requete)
        .then(response => {
          if (response.status === 200) {
            // Récharger la page 
            location.reload();
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


  /*
  * Gerer l evenement lorsqu on keyup fait autocomplete'
  */
  let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
  //console.log(inputNomBouteille);
  let liste = document.querySelector('.listeAutoComplete');

  if (inputNomBouteille) {
    inputNomBouteille.addEventListener("keyup", function (evt) {
      console.log(evt);
      let nom = inputNomBouteille.value;
      liste.innerHTML = "";
      if (nom) {
        let requete = new Request(BaseURL + "index.php?requete=autocompleteBouteille", { method: 'POST', body: '{"nom": "' + nom + '"}' });
        fetch(requete)
          .then(response => {
            if (response.status === 200) {
              return response.json();
            } else {
              throw new Error('Erreur');
            }
          })
          .then(response => {
            console.log(response);
            response.forEach(function (element) {
              liste.innerHTML += "<p data-id='" + element.id + "'>" + element.nom + "</p>";
            })
          }).catch(error => {
            console.error(error);
          });
      }


    });

    let bouteille = {
      nom: document.querySelector(".nom_bouteille"),
      id_cellier: document.querySelector("[name='id_cellier']"),
      millesime: document.querySelector("[name='millesime']"),
      quantite: document.querySelector("[name='quantite']"),
      date_achat: document.querySelector("[name='date_achat']"),
      prix_saq: document.querySelector("[name='prix_saq']"),
      garde_jusqua: document.querySelector("[name='garde_jusqua']"),
      notes: document.querySelector("[name='notes']"),
      pays: document.querySelector("[name='pays']"),
      id_type: document.querySelector("[name='id_type']"),
    };


    liste.addEventListener("click", function (evt) {
      console.dir(evt.target)
      if (evt.target.tagName == "P") {
        bouteille.nom.dataset.id = evt.target.dataset.id;
        bouteille.nom.innerHTML = evt.target.innerHTML;

        liste.innerHTML = "";
        inputNomBouteille.value = "";

      }
    });

    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
    if (btnAjouter) {
      btnAjouter.addEventListener("click", function (evt) {
        console.log(bouteille.id_cellier.value);
        var param = {
          "id_bouteille": bouteille.nom.dataset.id,
          "id_cellier": bouteille.id_cellier.value,
          "date_achat": bouteille.date_achat.value,
          "garde_jusqua": bouteille.garde_jusqua.value,
          "notes": bouteille.date_achat.value,
          "prix_saq": bouteille.prix_saq.value,
          "quantite": bouteille.quantite.value,
          "millesime": bouteille.millesime.value,
          "pays": bouteille.pays.value,
          "id_type": bouteille.id_type.value,
        };
        let requete = new Request(BaseURL + "index.php?requete=ajouterNouvelleBouteilleCellier", { method: 'POST', body: JSON.stringify(param) });
        console.log(JSON.stringify(param));
        fetch(requete)
        .then(response => {
          if (response.status === 200) {
            return response.json();
          } else {
            throw new Error('Erreur');
          }
        })
        .then(response => {
          console.log(response);
          window.location="http://localhost:8080/vino_etu/?requete=listecellier";//R
          }).catch(error => {
            console.error(error);
          });

      });
    }
  }


});

