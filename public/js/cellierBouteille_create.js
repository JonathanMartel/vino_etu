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
                console.log(response)

                response.forEach(function(element){
                    liste.innerHTML += "<li data-id='"+element.id +"'>"+element.nom+"</li>";
                  })
                  
            }).catch(error => console.log(error))
        }else {
            liste.innerHTML = "";
        }
 
    })

    const listeLi = document. querySelectorAll('li');

    listeLi.forEach(li => {
        li.addEventListener(('click'), () => {
            console.log(li)
        })
    });
    
  

  });
