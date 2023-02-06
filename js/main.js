/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//const BaseURL = "https://vino-etu.000webhostapp.com/";
const BaseURL = "http://localhost:8080/vino_etu/";
//const BaseURL = "http://localhost/vino_etu/";

/* import ValidateForm from "./ValidateForm.js"; */
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
            //console.log(response);
            response.forEach(function (element) {
              liste.innerHTML += "<p data-id='" + element.id + "'>" + element.nom + "</p>";
            })
          }).catch(error => {
            console.error(error);
          });
      }


    });

        let bouteille = {
        nom : document.querySelector(".nom_bouteille"),
        millesime : document.querySelector("[name='millesime']"),
        id_cellier : document.querySelector("[name='id_cellier']"),
        quantite : document.querySelector("[name='quantite']"),
        // notes : document.querySelector("[name='notes']"),
        date_achat : document.querySelector("[name='date_achat']"),
        garde_jusqua : document.querySelector("[name='garde_jusqua']"),
      };
/*    2ieme let bouteille = {
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
    }; */


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
    if (btnAjouter) 
    {
      btnAjouter.addEventListener("click", function (evt) {
        
        evt.preventDefault();

        var param = {
          "id_cellier": bouteille.id_cellier.value,
          "id_bouteille":bouteille.nom.dataset.id,
          "date_achat":bouteille.date_achat.value,
          "garde_jusqua":bouteille.garde_jusqua.value,
         // "notes":bouteille.notes.value,
          "quantite":bouteille.quantite.value,
          "millesime":bouteille.millesime.value,
        };

    /*     var param = {
          "nom": bouteille.nom.value,
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
        }; */
        
        // Said :    
        // Validation des champs
        let status = validAjoutNouvelleBouteilleSaq(param);
        if(status)
        {  
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
            window.location = BaseURL + "?requete=listecellier";

            }).catch(error => {
              console.error(error);
              window.location = BaseURL + "?requete=listecellier";
            });
        }
      });
    }
  }

      /*
      * Affichage de la vue de modification d'une bouteille  
      */
      let btnModifier = document.querySelectorAll(".btnModifier").forEach(function(e){
        //console.log(e);
        e.addEventListener('click', function(evt){
          let id = evt.target.parentElement.dataset.id;
          
          console.log(location.href);
          //let requete = new Request(BaseURL+`index.php?requete=modifier`);//, {method: 'GET'}?id=${id}`,
          location.href = BaseURL+`index.php?requete=getBouteille&id=${id}`;//
        })
      });
      let btnModifiersaq = document.querySelectorAll(".btnModifiersaq").forEach(function(e){
        //console.log(e);
        e.addEventListener('click', function(evt){
          let id = evt.target.parentElement.dataset.id;
          
          console.log(location.href);
          //let requete = new Request(BaseURL+`index.php?requete=modifier`);//, {method: 'GET'}?id=${id}`,
          location.href = BaseURL+`index.php?requete=getBouteillesaq&id=${id}`;//
        })
      });

      /*
      * Affichage de la vue de cellier
      */
     let cellier = document.querySelectorAll(".cellierid").forEach(function(e){

       //console.log(e);
       e.addEventListener('click', function(evt){
        let id = evt.target.parentElement.dataset.id;
           location.href = BaseURL+`index.php?requete=cellierid&id=${id}`; 
        })
      });


    /**
     * Modification d'une bouteille
     */
    document.querySelectorAll(".modifierBouteille").forEach(function(e) {
      console.log(e);
      e.addEventListener('click', function(evt){
        //console.log(id);
        let bouteille = {
          nom : document.querySelector(".nom_bouteille"),
          id : document.querySelector("[name=id]"),
          millesime : document.querySelector("[name='millesime']"),
          pays : document.querySelector("[name='pays']"),
          id_cellier : document.querySelector("[name='id_cellier']"),
          id_type : document.querySelector("[name='id_type']"),
          quantite : document.querySelector("[name='quantite']"),
          date_achat : document.querySelector("[name='date_achat']"),
          prix_achat : document.querySelector("[name='prix_achat']"),
          garde_jusqua : document.querySelector("[name='garde_jusqua']"),
          notes : document.querySelector("[name='notes']"),
          
        };


        var param = {
          "id":bouteille.id.value,
          "nom":bouteille.nom.value,
          "pays":bouteille.pays.value,
          "millesime":bouteille.millesime.value,
          "id_cellier": bouteille.id_cellier.value,
          "id_type": bouteille.id_type.value,
          "quantite":bouteille.quantite.value,
          "date_achat":bouteille.date_achat.value,
          "prix_achat":bouteille.prix_achat.value,
          "garde_jusqua":bouteille.garde_jusqua.value,
          "notes":bouteille.notes.value,
        };
        let requete = new Request(BaseURL+"index.php?requete=modifierBouteilleCellier", {method: 'POST', body: JSON.stringify(param)});

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
      
      }).catch(error => {
        console.error(error);

        window.location = BaseURL + "?requete=listecellier";
      });
        

      })
    });
    
    /**
     * Modification d'une bouteille saq
     */
    document.querySelectorAll(".modifierBouteillesaq").forEach(function(e) {
      console.log(e);
      e.addEventListener('click', function(evt){
        //console.log(id);
        let bouteille = {
          id : document.querySelector("[name=id]"),
          millesime : document.querySelector("[name='millesime']"),
          id_cellier : document.querySelector("[name='id_cellier']"),
          date_achat : document.querySelector("[name='date_achat']"),
          garde_jusqua : document.querySelector("[name='garde_jusqua']"),
          notes : document.querySelector("[name='notes']"),
        };


        var param = {
          "id":bouteille.id.value,
          "millesime":bouteille.millesime.value,
          "id_cellier": bouteille.id_cellier.value,
          "date_achat":bouteille.date_achat.value,
          "garde_jusqua":bouteille.garde_jusqua.value,
          "notes":bouteille.notes.value,
        };

        // Said :
        
        // Validation des champs
        let status = validModifBouteilleSaq(param);
        if(status)
        {              
          let requete = new Request(BaseURL+"index.php?requete=modifierBouteilleCelliersaq", {method: 'POST', body: JSON.stringify(param)});
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
          
          }).catch(error => {
            console.error(error);
            window.location = BaseURL + "?requete=listecellier";

          });
        }    
      })
    });

    btn = document.querySelector("[data-js-submit]");//#ajout
    
    let form = document.querySelector('[data-name="form"]');
    console.log(btn); 
    btn.addEventListener("click", (e)=>{
      
      e.preventDefault();
      console.log(form);
      
      let bool = formValidator();
      console.log(bool);
      
      if (bool) {
        form.submit();
      }
    })
    
    /* document.querySelectorAll("#ajout").forEach(function (e) {
      //e.preventDefault();      
      e.addEventListener("click", function(evt) {
        e.preventDefault;
        evt.addEventListener("onsubmit", formValidator());       
      });
    }); */

    /**
     * Methode de validation du form d'ajout
     */
    function formValidator() {
      let formValid = true,      
          nom = form[1].value,
          millesime = form[2].value,
          quantite = form[3].value,
          prix_achat = form[4].value,
          pays = form[5].value,
          date_achat = form[6].value,
          garde_jusqua = form[7].value;
        console.log(garde_jusqua); 
      if (nom == "") {
        document.getElementById("nom").textContent = "Veuillez remplir ce champ";
        formValid = false;
        return false;
      } else {
        document.getElementById("nom").textContent = "";
      } 
      if (millesime == "") {
        document.getElementById("millesime").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("millesime").textContent = "";
      } 
      if (quantite < 1) {
        document.getElementById("quantite").textContent = "Veuillez entrer un chiffre";
        formValid = false;
        return false;
      } else {
        document.getElementById("quantite").textContent = "";
      } 
      if (prix_achat == "") {
        document.getElementById("prix_achat").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("prix_achat").textContent = "";
      } 
      if (pays == "") {
        document.getElementById("pays").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("pays").textContent = "";
      } 
      if (date_achat == "") {
        document.getElementById("date_achat").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("date_achat").textContent = "";
      }
      if (garde_jusqua == "") {
        document.getElementById("garde_jusqua").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("garde_jusqua").textContent = "";
      } 
      console.log(formValid);
      if (formValid === true) {

        return true;
      }
    }

    // SAID ..
    /**
     * Methode de validation de l'ajout d une nouvelle bouteille SAQ
     */
    function validAjoutNouvelleBouteilleSaq(params) {
      
      let formValid = true,  
          id_bouteille = params.id_bouteille;    
          millesime = params.millesime;
          quantite = params.quantite; 
          date_achat = params.date_achat; 
          garde_jusqua = params.garde_jusqua;
  
      // Valider nom bouteuille
      if (id_bouteille == "") {
        document.getElementById("nom_bouteille").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("nom_bouteille").textContent = "";
      } 

      // Valider date de recolte
      if (millesime == "") {
        document.getElementById("millesime").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        // N'est pas un chiffre
        if (!millesime.match(/^[0-9]{4}$/)){
          document.getElementById("millesime").textContent = "année de 4 chiffres";
          formValid = false;
          return false;
        }else{  
            if (millesime > '2023') {
              document.getElementById("millesime").textContent = "Millesime inférieure 2023";
              formValid = false;
              return false;
            }else{
              document.getElementById("millesime").textContent = "";
            } 
        }
      }

      // Valider Quantite
      if (!quantite.match(/^[0-9]+$/)){
        document.getElementById("quantite").textContent = "Valeur numerique";
        formValid = false;
        return false;
      }else{  
        if (quantite < 1){
          document.getElementById("quantite").textContent = "Veuillez entrer un chiffre";
          formValid = false;
          return false;
        } else {
          document.getElementById("quantite").textContent = "";
        }
      }

      // Valider date achat
      if (date_achat == "") {
        document.getElementById("date_achat").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("date_achat").textContent = "";
      }
      
      // Valider garde_jusqua
      if (garde_jusqua == "") {
        document.getElementById("garde_jusqua").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("garde_jusqua").textContent = "";
      } 

      // Retourner Resultat      
      if (formValid === true) {
        return true;
      }
    }

    
    /**
     * Methode de validation lors de la modification d une bouteille SAQ
    */
    function validModifBouteilleSaq(params) {
          
      let formValid = true,  
          millesime = params.millesime;
          notes = params.notes; 
          date_achat = params.date_achat; 
          garde_jusqua = params.garde_jusqua;

      // Valider date achat
      if (date_achat == "") {
        document.getElementById("date_achat").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("date_achat").textContent = "";
      }
      
      // Valider garde_jusqua
      if (garde_jusqua == "") {
        document.getElementById("garde_jusqua").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        document.getElementById("garde_jusqua").textContent = "";
      } 

      // Valider date de recolte
      if (millesime == "") {
        document.getElementById("millesime").textContent = "Champ obligatoire";
        formValid = false;
        return false;
      } else {
        // N'est pas un chiffre
        if (!millesime.match(/^[0-9]{4}$/)){
          document.getElementById("millesime").textContent = " Année 4 de chiffres";
          formValid = false;
          return false;
        }else{  
            if (millesime > '2023') {
              document.getElementById("millesime").textContent = "Millesime inférieure 2023";
              formValid = false;
              return false;
            }else{
              document.getElementById("millesime").textContent = "";
            } 
        }
      }

      // Valider Notes
      if (!notes.match(/^[0-9]+$/)){
        document.getElementById("notes").textContent = "Valeur numerique";
        formValid = false;
        return false;
      }else{  
        if ((notes < 1) || (notes > 10)) {
          document.getElementById("notes").textContent = "Chiffre de 1 à 10";
          formValid = false;
          return false;
        } else {
          document.getElementById("notes").textContent = "";
        }
      }

      // Retourner resultat
      if (formValid === true) {
        return true;
      }
    }

});

