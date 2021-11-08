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

    for (let i = 0; i < boutonMillesime.length; i++) {

        boutonMillesime[i].addEventListener("click", function(e) {
        e.preventDefault();
        const millesime = boutonMillesime[i].dataset.jsBouton;
        

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