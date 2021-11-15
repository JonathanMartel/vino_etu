document.addEventListener('DOMContentLoaded', function() {

         /**
     * Message Dialogue si une bouteille a été modifiée
     */

          const modifieBouteille = document.querySelector(".modifieBouteille");

          if (modifieBouteille) {
              var toastHTML =
                  '<span>Une bouteille a été modifié</span><button class="btn-flat toast-action">Fermer</button>';
              M.toast({ html: toastHTML, displayLength: 5000 });
      
              const message = document.querySelector(".toast-action");
      
              message.addEventListener("click", () => {
                  M.Toast.dismissAll();
              });
          }

        /**
     * Un select permettant de changer de cellier
     */
         var selectCellier = document.querySelector('[name="select-cellier"]');
         M.FormSelect.init(selectCellier);
     
         selectCellier.addEventListener("change", (e) => {
             location.href = location.origin + "/cellier/" + e.target.value;
         });
     
         var selectBouteille = document.querySelector('[name="select-bouteille"]');
         M.FormSelect.init(selectBouteille);
     
         selectBouteille.addEventListener("change", (e) => {
             location.href = location.origin + `/cellier/${selectCellier.value}/${e.target.value}`;
         });

    const boutonMillesime = document.querySelectorAll('[data-js-bouton]');
    const boutonModifier = document.querySelector('[data-js-modifier]');
    const inputs = document.querySelectorAll('[data-js-input]');
    const infoForm =  document.querySelector('[data-js-form]');
    const infoInfo = document.querySelector('.form');
    const btnAnnuleActive = document.querySelector('[data-js-btnAnnuler]')
    const btnValideActive = document.querySelector('[data-js-btnValider]')
    const btnEffacerActive = document.querySelector('[data-js-btnEffacer]')
    const idCellier = location.pathname.split('/')[2]
    const idBouteille = location.pathname.split('/')[3]
    
    sessionStorage.setItem('idCellier', idCellier);
    sessionStorage.setItem('idBouteille', idBouteille);

    const datepicker = document.querySelector('.datepicker');
    
    M.Datepicker.init(datepicker,
        {  autoClose : true,
            format : 'yyyy-mm-dd'
            
         });


    /**
     * Note
     */
     new StarRating(".star-rating", {
        maxStars: 5,
        clearable: true,
        classNames: {
            active: "gl-active",
            base: "gl-star-rating",
            selected: "gl-selected",
        },
        stars: function (el, item, index) {
            el.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
        },
        tooltip: false,
    });

     

    /**
     * Ajouter un note à une bouteille en cliquant sur une étoile
     */
     const notes = document.querySelectorAll(".star-rating");

     notes.forEach((note) => {
         note.addEventListener("change", (e) => {
         
           
             const millesime = document.querySelector('.millesime-item-selected').parentElement.dataset.jsBouton;
             
           
             const note = document.querySelector("[data-rating]").dataset.rating;
 
             fetch(
                 `/ajouterNote/${idCellier}/${idBouteille}/${millesime}/${note}`
             ).catch((error) => console.log(error));
         });
     });

 for (let i = 0; i < boutonMillesime.length; i++) {

        boutonMillesime[i].addEventListener("click", function(e) {
        e.preventDefault();
        const millesime = boutonMillesime[i].dataset.jsBouton;
        
        document.querySelectorAll('button').forEach(button => {
            button.classList.remove('millesime-item-selected');
        })

        
        boutonMillesime[i].querySelector('button').classList.add('millesime-item-selected');
        /* Fetch cellier_Bouteille */

        fetch(`/obtenirMillesime/${idCellier}/${idBouteille}/${millesime}`)
        
        .then(response => {
            return (response.json())
        })
        .then(response => {
           
            
            if(value=response[0].millesime != 0){
                infoForm.querySelector('#millesime').value=response[0].millesime;
            }else {
                infoForm.querySelector('#millesime').value = 'N/A';
            }
             infoForm.querySelector('#quantite').value=response[0].quantite;
             infoForm.querySelectorAll('[data-value]').forEach(etoile => {
               
                if(etoile.dataset.value < response[0].note ){
                    etoile.classList.add('gl-active')
                }else if (etoile.dataset.value == response[0].note) {
                    etoile.classList.add('gl-active', 'gl-selected');
                }else {
                    etoile.classList.remove('gl-active', 'gl-selected')
                }
             }

             )
             infoForm.querySelector('#prix').value=response[0].prix;
             infoForm.querySelector('#commentaire').value=response[0].commentaire;
             infoForm.querySelector('#date_achat').value=response[0].date_achat;
             infoForm.querySelector('#garde_jusqua').value=response[0].garde_jusqua;

        }).catch(error => console.log(error))
      });
    }

    /* Activer les champs inputs et les boutons annuler, valider, effacer */ 
    
    /* Bouton modifier*/ 
    boutonModifier.addEventListener("click", function(e) {
        e.preventDefault();

        boutonModifier.classList.add("non-active");
        for (let i = 0; i < inputs.length; i++){
                inputs[i].readOnly = false;
                inputs[i].classList.add("input-active");
                if (inputs[i].classList.contains("input-fiche-cercle")){
                    inputs[i].classList.remove("input-fiche-cercle");
                }
        }

        if (btnAnnuleActive.classList.contains("non-active")) {
            btnAnnuleActive.classList.remove("non-active");
             }
        if (btnValideActive.classList.contains("non-active")){
            btnValideActive.classList.remove("non-active");
        }
        if (btnEffacerActive.classList.contains("non-active")){
            btnEffacerActive.classList.remove("non-active");
        }
  
        datepicker.disabled = false;
    });

    /** Action bouton annuler, efface les champs modifié et retire les boutons annuler, valider et effacer. Réactive le bouton modifier **/
    btnAnnuleActive.addEventListener("click",function(e){
        e.preventDefault();
        boutonModifier.classList.remove("non-active");
        btnEffacerActive.classList.add("non-active");
        btnValideActive.classList.add("non-active");
        btnAnnuleActive.classList.add("non-active");
        infoForm.reset();

        for (let i = 0; i < inputs.length; i++){
            inputs[i].readOnly = true;
            inputs[i].classList.remove("input-active");
            inputs[i].classList.add("input-fiche-cercle");
            }

            datepicker.disabled =  true;
    });


    /** Bouton valider **/
        btnValideActive.addEventListener("click",function(e){
            e.preventDefault();
            let annee = millesime.value;
             
            if(commentaire.value.trim()==""){
                commentaire.value=" ";
             }
            
            if(isNaN(millesime.value)){
                annee = 0;
            }

            fetch(`/modifierCellierBouteille/${idCellier}/${idBouteille}/${annee}/${prix.value}/${quantite.value}/${date_achat.value}/${commentaire.value}/${garde_jusqua.value}`)
            .then(() => {
                commentaire.value = commentaire.value.trim()
            })
              .catch(error => console.log('Le fetch ne fonctionne toujours pas',error))
         
           /* Validation non-terminée*/ 

            // let messagePrix = "Entrez de 0 à 100000";
            // if (prix.value < 0 || prix.value > 6) {
            //     btnValideActive.disabled = true;
            //     document.getElementById("message").innerHTML = messagePrix;
                  
            // }else {

                for (let i = 0; i < inputs.length; i++){
                    inputs[i].readOnly = true;
                    inputs[i].classList.remove("input-active");
                    inputs[i].classList.add("input-fiche-cercle");
                }

                boutonModifier.classList.remove("non-active");
                btnAnnuleActive.classList.add("non-active");
                btnValideActive.classList.add("non-active");
                btnEffacerActive.classList.add("non-active");
            });


        btnEffacerActive.addEventListener("click",function(e){
            e.preventDefault();
            console.log('click effacer');

        });
});