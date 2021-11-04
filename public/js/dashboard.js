document.addEventListener('DOMContentLoaded', function() {
    let elEdits = document.querySelectorAll('[data-js-modifie]'),
        elBtns = document.querySelectorAll('[data-js-button]'),
        inputNom = document.querySelector('[data-js-inputNom]'),
        btnNom = document.querySelector('[data-js-btnNom]'),
        inputCourriel = document.querySelector('[data-js-inputCourriel]'),
        btnCourriel = document.querySelector('[data-js-btnCourriel]'),
        inputDateNaissance = document.querySelector('[data-js-inputDateNaissance]'),
        btnDateNaissance = document.querySelector('[data-js-btnDateNaissance]')
    ;
    
    for (let i = 0; i < elEdits.length; i++) {
        elEdits[i].addEventListener('click',(e)=>{
            if(elBtns[i].classList.contains('hidden')){
                elBtns[i].classList.remove('hidden');
            }else{
                elBtns[i].classList.add('hidden');
            }
        })
    }

    btnNom.addEventListener('click',(e)=>{
        let valInputNom = inputNom.value;
        // console.log(valInputNom);
        if(valInputNom == ""){
            btnNom.parentNode.nextElementSibling.innerHTML = 'Le champ nom est obligatoire.';
        }else if(valInputNom.length <2){
            btnNom.parentNode.nextElementSibling.innerHTML = 'Le texte nom doit contenir au moins 2 caractères.';
        }else if(valInputNom.length >25){
            btnNom.parentNode.nextElementSibling.innerHTML = 'Le texte de nom ne peut contenir plus de 25 caractères.';
        }else{
            btnNom.parentNode.nextElementSibling.innerHTML = '';
        }
    })
    


})