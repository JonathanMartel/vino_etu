

document.addEventListener('DOMContentLoaded', function() {
    const recherche = document.querySelector('[name="recherche"]');
    const liste = document.querySelector('.autocomplete');

    /**
     * Recherche les noms des bouteilles dans la base de données  qui correspondent au mot-clé 
     */
    recherche.addEventListener('input', () => {

        if(recherche.value.trim() != "") {
            liste.innerHTML = "";
            fetch("/rechercheBouteilles/" + recherche.value)
            .then(response => {
                return (response.json())
            })
            .then(response => {

                response.forEach(function(element){
                    liste.innerHTML += "<div data-id='"+element.id +"'>"+element.nom+"</div>";
                  })
                  
            }).catch(error => console.log(error))
        }else {
            liste.innerHTML = "";
        }
 
    })

    /**
     * Insérer le nom de la bouteille lorsqu'on clique sur le nom d'une bouteille
     */
    const inputNom = document.querySelector('#nom');
    const inputBouteilleId = document.querySelector('#bouteille_id');
    const fileInput = document.querySelector(".file-field");

    liste.addEventListener('click', e => {
        
        if(e.target.tagName == "DIV") {
            inputNom.nextElementSibling.className ='active';
            inputNom.value = e.target.innerHTML;
            inputNom.readOnly = true;
            inputNom.className = "valid";
            recherche.value = "";
            recherche.nextElementSibling.className ='';
            liste.innerHTML = "";
            inputBouteilleId.value = e.target.dataset.id;
            fileInput.style.display = "none";
        }
    })

    /**
     *  le select de millesime
     */
    const millesime = document.querySelector('[name="millesime"]');
    M.FormSelect.init(millesime);

    /**
     * Calendier de la date d'achat
     */
    const datepicker = document.querySelector('.datepicker');
    M.Datepicker.init(datepicker, {autoClose : true});

   
    /**
     * Message Dialogue si une bouteille existe déjà
     */
    const success = document.querySelector(".success");

    if(success) {
        var toastHTML = '<span>Cette bouteille existe déjà dans vôtre cellier</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({html: toastHTML, displayLength : 5000})
    }

    if( inputBouteilleId.value) {
        fileInput.style.display = "none";
        inputNom.readOnly = true;
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
          tooltip: 'Choisir une note',
          
    });

     /**
     * Réinitialiser le formulaire d'ajout
     */
      const form = document.querySelector('form');
      const btnReset = form.querySelector('[name="reinitialiser"]');
  
      btnReset.addEventListener('click', (e) => {
        e.preventDefault()
        form.reset();

        form.querySelectorAll('input').forEach(input => {
            input.value = null;
            input.classList.remove('valid');
        })
        
        form.querySelector('select').options.selectedIndex = null;
        
        form.querySelectorAll('.gl-active').forEach(etoile => {
        etoile.classList.remove('gl-active', 'gl-selected');
        })

        form.querySelector('.gl-star-rating--stars').setAttribute('aria-label', 'Choisir une note');
        form.querySelector('.gl-star-rating--stars').setAttribute('data-rating', 0);
        form.querySelector('textarea').value = "";
        fileInput.style.display = "block";
        inputNom.readOnly = false;

      })
  });

  

 
