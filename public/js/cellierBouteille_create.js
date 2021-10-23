document.addEventListener('DOMContentLoaded', function() {
    const recherche = document.querySelector('[name="recherche"]');
    const liste = document.querySelector('.autocomplete');
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

    let inputNom = document.querySelector('#nom');
  liste.addEventListener('click', e => {
            console.log(e.target.tagName)
      if(e.target.tagName == "DIV") {
        inputNom.nextElementSibling.className ='active';
        inputNom.value = e.target.innerHTML;
        inputNom.disabled = true;
        recherche.value = "";
        recherche.nextElementSibling.className ='';
        liste.innerHTML = "";
      }
  })
    
  var datepicker = document.querySelector('.datepicker');
    M.Datepicker.init(datepicker, {autoClose : true});

    

  });
