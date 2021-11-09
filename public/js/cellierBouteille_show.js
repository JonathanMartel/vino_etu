document.addEventListener('DOMContentLoaded', function() {

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
  
  

    let btnActive = document.querySelector('#bouton-millesime');
    console.log(btnActive);
    // btnActive.addEventListener('click', () => btnActive.style.backgroundColor = 'blue')

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
             const idBouteille = e.target.dataset.idBouteille;
             const millesime = e.target.dataset.millesime;
             const idCellier = location.pathname.split("/")[2];
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
     

        /* Fetch cellier_Bouteille */

        fetch(`/obtenirMillesime/${idCellier}/${idBouteille}/${millesime}`)
        
        .then(response => {
            return (response.json())
        })
        .then(response => {
            infoForm.querySelector('#millesime').value=response[0].millesime;
             infoForm.querySelector('#quantite').value=response[0].quantite;
             infoForm.querySelector('#note').value=response[0].note;
             infoForm.querySelector('#prix').value=response[0].prix;
             infoForm.querySelector('#commentaire').value=response[0].commentaire;
             infoForm.querySelector('#date_achat').value=response[0].date_achat;
             infoForm.querySelector('#garde_jusqua').value=response[0].garde_jusqua;

           console.log(response[0].millesime);
        }).catch(error => console.log(error))


        // if (infoInfo.classList.contains("form")) {
        //     infoInfo.classList.remove("form");
        // }else{
        //     infoInfo.classList.add("form");
        // }
      });
    }

    /* Activer les champs inputs */ 
    boutonModifier.addEventListener("click", function(e) {
        e.preventDefault();
        console.log('click bouton mod');
        boutonModifier.remove();
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

    });
});