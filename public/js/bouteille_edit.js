document.addEventListener('DOMContentLoaded', function() {

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
        var toastHTML = '<span>Cette bouteille existe déjà</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({html: toastHTML, displayLength : 5000})

        const message = document.querySelector('.toast-action')

        message.addEventListener('click', () => {
            M.Toast.dismissAll();
        })
    }

    const form = document.querySelector('.edit-vin');
  
    form.addEventListener('input', () => {
        
        form.querySelector('.btn-modifier').removeAttribute('disabled');
    })

  });
