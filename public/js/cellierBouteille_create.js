document.addEventListener('DOMContentLoaded', function() {
    const recherche = document.querySelector('[name="autocomplete"]');
    const liste = document.querySelector('ul');
    recherche.addEventListener('input', () => {

        if(recherche.value.trim() != "") {
            liste.innerHTML = "";
            fetch("/rechercheBouteilles/" + recherche.value)
            .then(response => {
                return (response.json())
            })
            .then(response => {

                response.forEach(function(element){
                    liste.innerHTML += "<li data-id='"+element.id +"'>"+element.nom+"</li>";
                  })
                  
            }).catch(error => console.log(error))
        }else {
            liste.innerHTML = "";
        }
 
    })

    let inputNom = document.querySelector('#nom');
  liste.addEventListener('click', e => {
        
      if(e.target.tagName == "LI") {
        inputNom.nextElementSibling.className ='active';
        inputNom.value = e.target.innerHTML;
        inputNom.disabled = true;
        recherche.value = "";
        recherche.nextElementSibling.className ='';
        liste.innerHTML = "";
      }
  })
    
  var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, {autoClose : true});

  });
