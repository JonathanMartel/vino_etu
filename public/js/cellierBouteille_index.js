

document.addEventListener('DOMContentLoaded', function() {

    
    const sections = document.querySelectorAll('section')

    sections.forEach(section => {

         /**
         * Requête fetch pour incrémenter la quantité d'une bouteille à un cellier sans recharger la page
         */
        const btnAjouter = section.querySelector('[name="btnAjouterBouteille"]');
        const quantitePrecedent = section.querySelector('.quantite > span');
        
        btnAjouter.addEventListener('click', (e) => {
            e.preventDefault();
            
            fetch(btnAjouter.href)
            .then(response => {
                return (response.json())
            })
            .then(response => {
                quantitePrecedent.innerHTML = parseInt(quantitePrecedent.innerHTML) + response;
            }).catch(error => console.log(error))
        })

        const btnRetirer = section.querySelector('[name="btnRetirerBouteille"]');
     
        
        btnRetirer.addEventListener('click', (e) => {
            e.preventDefault();
            
            fetch(btnRetirer.href)
            .then(response => {
                return (response.json())
            })
            .then(response => {
                quantitePrecedent.innerHTML = parseInt(quantitePrecedent.innerHTML) + response;
            }).catch(error => console.log(error))
        })
    })
    
    
    const nouvelleBouteille = document.querySelector(".nouvelleBouteille");
    
    if(nouvelleBouteille) {
        console.log('kl')
        var toastHTML = '<span>Une nouvelle bouteille a été ajoutée</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({html: toastHTML, displayLength : 5000})

        const message = document.querySelector('.toast-action')

        message.addEventListener('click', () => {
            M.Toast.dismissAll();
        })
    }


    })