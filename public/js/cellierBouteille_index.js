

document.addEventListener('DOMContentLoaded', function() {

    
    let btnAjouterBouteilles = document.querySelectorAll('[name="btnAjouterBouteille"]')

    
    /**
     * Requête fetch pour incrémenter la quantité d'une bouteille à un cellier sans recharger la page
     */
    Array.from (btnAjouterBouteilles).forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            fetch(btn.href)
            .then(response => {
                return (response.json())
            })
            .then(response => {
                const quantitePrecedent = parseInt( btn.closest('tr').querySelector('[name="quantite"]').innerHTML);
                btn.closest('tr').querySelector('[name="quantite"]').innerHTML = quantitePrecedent + response;
            }).catch(error => console.log(error))
        })
    });

    let btnRetirerBouteilles = document.querySelectorAll('[name="btnRetirerBouteille"]')

    /**
     * Requête fetch pour incrémenter la quantité d'une bouteille à un cellier sans recharger la page
     */
    Array.from (btnRetirerBouteilles).forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            fetch(btn.href)
            .then(response => {
                return (response.json())
            })
            .then(response => {
                const quantitePrecedent = parseInt( btn.closest('tr').querySelector('[name="quantite"]').innerHTML);
                btn.closest('tr').querySelector('[name="quantite"]').innerHTML = quantitePrecedent + response;
            }).catch(error => console.log(error))
        })
    });

});