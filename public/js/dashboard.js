document.addEventListener('DOMContentLoaded', function() {
    

    /**
    * Message Dialogue si l'information a été modifié
    */

    const modifieInfo = document.querySelector(".modifieInfo");

    if (modifieInfo) {
        var toastHTML =
            '<span>L\'information personnelle a été modifié</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({ html: toastHTML, displayLength: 5000 });

        const message = document.querySelector(".toast-action");

        message.addEventListener("click", () => {
            M.Toast.dismissAll();
        });
    }

    /**
    * Message Dialogue si le mot de passe a été modifié
    */

    const modifiePassword = document.querySelector(".modifiePassword");

    if (modifiePassword) {
        var toastHTML =
            '<span>Le mot de passe a été modifié</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({ html: toastHTML, displayLength: 5000 });

        const message = document.querySelector(".toast-action");

        message.addEventListener("click", () => {
            M.Toast.dismissAll();
        });
    }

    


})