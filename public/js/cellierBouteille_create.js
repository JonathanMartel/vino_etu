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
                console.log(response)
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
    liste.addEventListener('click', e => {
                console.log(e.target.tagName)
        if(e.target.tagName == "DIV") {
            inputNom.nextElementSibling.className ='active';
            inputNom.value = e.target.innerHTML;
            inputNom.disabled = true;
            recherche.value = "";
            recherche.nextElementSibling.className ='';
            liste.innerHTML = "";
            inputBouteilleId.value = e.target.dataset.id;
        }
    })

    /**
     * Remplir le select de millesime
     */
    const millesime = document.querySelector('[name="millesime"]');
    M.FormSelect.init(millesime);

    const date = new Date();
    const anneePresent = date.getFullYear();
    const anneDebut = 1700;

    for(var annee = anneePresent; annee >= anneDebut; annee--){
        millesime.options[millesime.options.length] = new Option(annee, annee);
    };

    M.FormSelect.init(millesime); 

    /**
     * Calendier de la date d'achat
     */
    const datepicker = document.querySelector('.datepicker');
    M.Datepicker.init(datepicker, {autoClose : true});

    const radios = document.querySelectorAll('input[type="radio"]');
    const inputNote = document.querySelector('note');
    radios.forEach(radio => {

        radio.addEventListener('click', (e) => {
            e.preventDefault()
            e.stopPropagation()
           
            console.log(radio.value)
        })
        
    });
    const success = document.querySelector(".success");
    console.log(success)
    if(success) {
        var toastHTML = '<span>Cette bouteille existe déjà dans vôtre cellier</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({html: toastHTML, displayLength : 5000})
    }
  });
