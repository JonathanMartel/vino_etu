

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

        /**
         * Requête fetch pour décrémenter la quantité d'une bouteille à un cellier sans recharger la page
         */
        const btnRetirer = section.querySelector('[name="btnRetirerBouteille"]');
     
        
        btnRetirer.addEventListener('click', (e) => {
            e.preventDefault();  
                
            fetch(btnRetirer.href)
            .then(response => {
                return (response.json())
            })
            .then(response => {
                if(parseInt(quantitePrecedent.innerHTML) + response >= 0)
                quantitePrecedent.innerHTML = parseInt(quantitePrecedent.innerHTML) + response;
            }).catch(error => console.log(error))
        })
    })
    
     /**
     * Message Dialogue si une bouteille a été créé
     */

    const nouvelleBouteille = document.querySelector(".nouvelleBouteille");
    
    if(nouvelleBouteille) {
        var toastHTML = '<span>Une nouvelle bouteille a été ajoutée</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({html: toastHTML, displayLength : 5000})

        const message = document.querySelector('.toast-action')

        message.addEventListener('click', () => {
            M.Toast.dismissAll();
        })
    }

    /**
     * Note
     */
     new StarRating('.star-rating',{
        maxStars: 5,
        clearable : true,
        classNames: {
            active: 'gl-active',
            base: 'gl-star-rating',
            selected: 'gl-selected',
          },
          stars: function (el, item, index) {
            el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
          },
          tooltip: false,
          
    });

    /**
     * Ajouter un note à une bouteille en cliquant sur une étoile
     */
    const notes = document.querySelectorAll('.star-rating');

    notes.forEach(note => {
        note.addEventListener('change', (e) => {
    
            const idBouteille = e.target.dataset.idBouteille;
            const millesime = e.target.dataset.millesime;
            const idCellier = location.pathname.split('/')[2];
            const note = e.target.value;

            fetch(`/ajouterNote/${idCellier}/${idBouteille}/${millesime}/${note}`) 
            .catch(error => console.log(error))
        })
    })

    

    })