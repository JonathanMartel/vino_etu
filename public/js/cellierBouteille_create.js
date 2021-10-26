document.addEventListener('DOMContentLoaded', function() {
    const recherche = document.querySelector('[name="recherche"]');
    const liste = document.querySelector('.autocomplete');

        /**
     * Calendier de la date d'achat
     */
         const datepicker = document.querySelector('.datepicker');
         const datepickerIns = M.Datepicker.init(datepicker, {autoClose : true});
     
    
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
                    liste.innerHTML += `<div  data-description="${element.description}" data-pays="${element.pays}" data-idtype="${element.type_id}" data-idformat="${element.format_id}" data-id="${element.id}"  data-imgurl="${element.url_img}">${element.nom}</div>`;
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
    const description = document.querySelector('#description');
    const type_id = document.querySelector('[name="type_id"]');
    const format_id = document.querySelector('[name="format_id"]');
    const millesime = document.querySelector('[name="millesime"]');
    const pays = document.querySelector('[name="pays"]');
    const commentaire = document.querySelector('[name="commentaire"]');
    const date_achat = document.querySelector('[name="date_achat"]');
    const garde_jusqua = document.querySelector('[name="garde_jusqua"]');
    const quantite = document.querySelector('[name="quantite"]');
    const prix = document.querySelector('[name="prix"]');
    liste.addEventListener('click', e => {
        
        if(e.target.tagName == "DIV") {
            
            
            inputNom.nextElementSibling.className ='active';
            inputNom.value = e.target.innerHTML;
            //inputNom.readOnly = true;
            inputNom.className = "valid";
            if(e.target.dataset?.description != ''){
                description.value = e.target.dataset.description;
                description.className ='active';
                description.nextElementSibling.className ='active';
            }

            console.log( e.target.dataset.millesime)
            millesime.value = e.target.dataset.millesime;
            type_id.value = e.target.dataset.idtype;
            format_id.value = e.target.dataset.idformat;
            M.FormSelect.init(elems);
          
            recherche.value = "";
            recherche.nextElementSibling.className ='';
            liste.innerHTML = "";
            inputBouteilleId.value = e.target.dataset.id;
            if(e.target.dataset?.pays != ''){
                pays.value = e.target.dataset.pays;
                pays.nextElementSibling.className ='active';
            }
            //fileInput.style.display = "none";
        }
    })

    /**
     *  les selects
     */
     var elems = document.querySelectorAll('select:not(.star-rating)');
     M.FormSelect.init(elems);

   
    /**
     * Message Dialogue si une bouteille existe déjà
     */
    const success = document.querySelector(".success");

    if(success) {
        var toastHTML = '<span>Cette bouteille existe déjà dans vôtre cellier</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({html: toastHTML, displayLength : 5000})
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
   
  });

  

 
