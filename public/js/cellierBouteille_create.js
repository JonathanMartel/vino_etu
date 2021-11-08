document.addEventListener('DOMContentLoaded', function() {
    const recherche = document.querySelector('[name="recherche"]');
    const liste = document.querySelector('.autocomplete');
    
    /**
     * Calendier de la date d'achat
     */
    const date = new Date();
    const datepicker = document.querySelector('.datepicker');
    
    M.Datepicker.init(datepicker,
        {  autoClose : true,
            defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
            setDefaultDate: true});
     
    let timer; //https://typeofnan.dev/how-to-execute-a-function-after-the-user-stops-typing-in-javascript/
    /**
     * Recherche les noms des bouteilles dans la base de données  qui correspondent au mot-clé 
     */
    recherche.addEventListener('input', () => {
        clearTimeout(timer);
        timer = setTimeout(() => {      
        if(recherche.value.trim() != "") {
            liste.innerHTML = "";
           
         
                fetch("/rechercheBouteillesParMotCle/" + recherche.value)
                .then(response => {
                    return (response.json())
                })
                .then(response => {

                    response.forEach(function(element){
                        liste.innerHTML += `<div  data-description="${element.description}" data-pays="${element.pays}" data-idtype="${element.type_id}" data-idformat="${element.format_id}" data-id="${element.id}" data-prix="${element.prix_saq}"  data-imgurl="${element.url_img}" data-nom="${element.nom}" >${element.nom} - ${element.type} -  ${element.taille} cL - ${element.pays}</div>`;
                    })
                    
                }).catch(error => console.log(error))
          
        }else {
            liste.innerHTML = "";
        }
    }, 200);
    })

    /**
     * Insérer les informations de la bouteille lorsqu'on clique sur le nom d'une bouteille
     */
    const inputNom = document.querySelector('#nom');
    const inputBouteilleId = document.querySelector('#bouteille_id');
    const description = document.querySelector('#description');
    const type_id = document.querySelector('[name="type_id"]');
    const format_id = document.querySelector('[name="format_id"]');
    const labelMillesime = document.querySelector('[name="labelMillesime"]');
    const pays = document.querySelector('[name="pays"]');
    const img = document.querySelector('[name="img-bouteille"]');
    const imgUrl = document.querySelector('[name="url_img"]');
    const millesimeExistant = document.querySelector('[name="millesime-existant"]');
    const prix = document.querySelector('[name="prix"]');
    if(!imgUrl.value) {
            img.style.display = "none";
    }
      
    liste.addEventListener('click', e => {
        
        if(e.target.tagName == "DIV") {
            labelMillesime.innerHTML = "Millésime";
            
            img.style.display = "block";
            img.src = e.target.dataset.imgurl;
            img.alt = e.target.dataset.nom; 
            
            inputNom.value = e.target.dataset.nom;
            inputNom.className = 'valid';
            
            imgUrl.value = e.target.dataset.imgurl;

            prix.value = parseFloat(e.target.dataset.prix).toFixed(2);

            if(e.target.dataset?.description != ''){
                description.value = e.target.dataset.description;
          
            }
            const idCellier = location.pathname.split('/')[2];

            fetch(`/obtenirMillesimesParBouteille/${idCellier}/${e.target.dataset.id}`)
            .then(response => {
                return (response.json())
            })
            .then(response => {
                if(response[0])
                {
                    labelMillesime.innerHTML += " (existant : ";

                    response.forEach((millesime, i) => {
                      
                        if(millesime.millesime == 0)
                        {
                            millesime.millesime = "sans millesime";
                        }

                        if(response[i +1] != undefined)
                        {
                          
                            labelMillesime.innerHTML += ` ${millesime.millesime}, `;
                        }else {
                            
                            labelMillesime.innerHTML += ` ${millesime.millesime}`; 
                        }
                    })
                    labelMillesime.innerHTML += ")";

                    millesimeExistant.value = labelMillesime.innerHTML;
                }
                
            }).catch(error => console.log(error))
            
            type_id.value = e.target.dataset.idtype;
            format_id.value = e.target.dataset.idformat;
            
            M.FormSelect.init(elems);
          
            recherche.value = "";
            recherche.nextElementSibling.className ='';
            
            liste.innerHTML = "";
            inputBouteilleId.value = e.target.dataset.id;
           
            if(e.target.dataset?.pays != ''){
                pays.value = e.target.dataset.pays;

            }

            M.updateTextFields();

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
        var toastHTML = '<span>Cette bouteille existe déjà dans votre cellier</span><button class="btn-flat toast-action">Fermer</button>';
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
          tooltip: 'Choisir une note',
          
    });
    
  });
