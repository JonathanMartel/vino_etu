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
  
  });