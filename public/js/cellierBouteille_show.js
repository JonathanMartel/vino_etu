document.addEventListener('DOMContentLoaded', function() {

    const boutonMillesime = document.querySelectorAll('[data-js-bouton]');
        console.log(boutonMillesime);

    const infoForm =  document.querySelector('[data-js-form]');
        console.log(infoForm);

    const infoInfo = document.querySelector('.form');
        console.log(infoInfo);

    const idCellier = location.pathname.split('/')[2]
        console.log(location.pathname);
    const idBouteille = location.pathname.split('/')[3]
    console.log(idCellier);
    console.log(idBouteille);

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
});