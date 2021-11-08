document.addEventListener('DOMContentLoaded', function() {
    var modals = document.querySelectorAll('.modal');
    M.Modal.init(modals);

    const celliers = document.querySelectorAll('.cellier');

    celliers.forEach(cellier => {

      cellier.addEventListener('click', (e) => {
        
         if(e.target.classList.contains('cellier') || e.target.classList.contains('nom-cellier') || e.target.classList.contains('localisation-cellier')){
            location.href = cellier.dataset.lien;
         }
         
        
      })
    })
  });