document.addEventListener('DOMContentLoaded', function() {
    const btnImport = document.querySelector('.btn-large');
    const preloader = document.querySelector('.preloader-wrapper');
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const message = document.querySelector('.message');

    /**
     * Afficher dans un table les bouteilles du site de la SAQ qui n'étaient pas dans la BD
     */
    btnImport.addEventListener('click', (e) => {
        e.preventDefault();
        table.style.display = 'none';
        message.textContent = "";
        preloader.classList.add('active');
        btnImport.classList.add('disabled');
        fetch(btnImport.href)
        .then(response => {
            return (response.json())
        })
        .then(response => {
          
            setTimeout(()=> { 
                preloader.classList.remove('active');
                btnImport.classList.remove('disabled');
                if(response.length != 0){ 
                    table.style.display = 'table';
                    for (let index = 0; index < response.length; index++) {
                    
                        tbody.innerHTML += `<tr>
                                                <td> <img class='image'  src="${response[index].url_img}" alt="${response[index].nom}"></td>
                                                <td>${response[index].nom}</td>
                                                <td>${response[index].pays}</td>
                                                <td>${response[index].description}</td>
                                                <td>${response[index].code_saq}</td>
                                                <td>${response[index].prix_saq}</td>
                                                <td>${response[index].url_saq}</td>
                                                <td>${response[index].format}</td>
                                                <td>${response[index].type}</td>
                                            </tr>`;
                            
                    }
                    message.textContent = response.length + " bouteille(s) a été ajoutée(s)";
                   
                }else {
                    
                    message.textContent = "Aucun bouteille a été ajoutée";
                }
            }, 2000)
            
        }).catch(error => console.log(error))
      
    })
  });