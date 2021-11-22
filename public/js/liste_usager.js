document.addEventListener('DOMContentLoaded', function() {
    var modals = document.querySelectorAll('.modal');
    M.Modal.init(modals);

    /**
    * Message Dialogue si l'information a été modifié
    */

     const modifie = document.querySelector(".modifie");

     if (modifie) {
         var toastHTML =
             '<span>L\'information d\'un usager a été modifié</span><button class="btn-flat toast-action">Fermer</button>';
         M.toast({ html: toastHTML, displayLength: 5000 });
 
         const message = document.querySelector(".toast-action");
         const messageContainer = document.querySelector("#toast-container");
         messageContainer.classList.add('flex-row');
         message.addEventListener("click", () => {
             M.Toast.dismissAll();
         });
     }

    /**
    * function pour search les usagers
    */ 

    //    var search_input = document.querySelector("#search");

    //    search_input.addEventListener("keyup", function(e){
    //       var noms = document.querySelectorAll(".nom");
    //       var courriels = document.querySelectorAll(".courriel");
    //       var date_naissances = document.querySelectorAll(".date_naissance");
    //       var search_item = e.target.value.toLowerCase();
  
    //       noms.forEach(function(item){
    //           console.log(item.textContent);
    //           if(item.textContent.toLowerCase().indexOf(search_item) != -1){
    //              item.closest("tr").style.display = "table-row";
    //           }
    //           else{
    //             item.closest("tr").style.display = "none";
    //             }
    //         })
  
    //    });




    /**
    * function pour search les usagers
    */ 

       const recherche = document.querySelector("#search");
   
       const rechercherUsagers = () => {
           fetch(`/rechercherUsager/${recherche.value.trim()}`)
           .then(response => {
               return (response.json())
           })
           .then(response => {
               
               document.querySelector('#table').innerHTML = response.table;
               
           }).catch(error => console.log(error))
       }

       const showListeUsager = () => {
            fetch(`/affichelisteUsager`)
            .then(response => {
                return (response.json())
            })
            .then(response => {
                
                document.querySelector('#table').innerHTML = response.table;
                
            }).catch(error => console.log(error))
    
       }
   
       recherche.addEventListener('input', () => {
           if(recherche.value){
               rechercherUsagers();
           }
           else{
               showListeUsager();
           }
           
       })
   
  
  });