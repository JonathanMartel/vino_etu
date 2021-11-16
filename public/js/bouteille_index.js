document.addEventListener('DOMContentLoaded', function() {
    const btnImport = document.querySelector('.btn-large');
    const preloader = document.querySelector('.preloader-wrapper');
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const message = document.querySelector('.message');
    let tableRow;
    let stop = false;
    let nbBouteilleTotal;
    /**
     * Afficher dans un table les bouteilles du site de la SAQ qui n'étaient pas dans la BD
     */
    btnImport.addEventListener('click', (e) => {
        e.preventDefault();
        table.style.display = 'none';
        message.textContent = "";
        preloader.classList.add('active');
        btnImport.classList.add('disabled');
        let page = 1;
        tableRow = '';
        nbBouteilleTotal = 0;
        importer(page)
    })
    
         const importer = (page) => {
        
            Promise.all([
                fetch(`/obtenirListeSAQ/${page}`),
                fetch(`/obtenirListeSAQ/${page + 1}`),
                fetch(`/obtenirListeSAQ/${page + 2}`),
                fetch(`/obtenirListeSAQ/${page + 3}`),
                fetch(`/obtenirListeSAQ/${page + 4 }`),
                fetch(`/obtenirListeSAQ/${page + 5}`),
                fetch(`/obtenirListeSAQ/${page + 6}`),
            ]).then(function (responses) {
                // Get a JSON object from each of the responses
                return Promise.all(responses.map(function (response) {
                    return response.json();
                }));
            }).then(response => {
                
                let nbBouteille = 0;
    
                
                   
    
                    response.forEach( data => {
                        nbBouteille += data.length;
                    })
                    if(nbBouteille != 0){ 
                       
                        for (let index = 0; index < response.length; index++) {
                            if(response[index] == 'stop'){
                             stop = true;
                            }else {
                            for (let i = 0; i <  response[index].length; i++) { 
                               
                                tableRow += `<tr>
                                                        <td> <img class='image'  src="${response[index][i].url_img}" alt="${response[index][i].nom}"></td>
                                                        <td>${response[index][i].nom}</td>
                                                        <td>${response[index][i].pays}</td>
                                                        <td>${response[index][i].description}</td>
                                                        <td>${response[index][i].code_saq}</td>
                                                        <td>${response[index][i].prix_saq}</td>
                                                        <td>${response[index][i].url_saq}</td>
                                                        <td>${response[index][i].format}</td>
                                                        <td>${response[index][i].type}</td>
                                                    </tr>`;
                                
                            }
                                nbBouteilleTotal += nbBouteille;
                        }
                        }
                       
                       
                    }
                    if(!stop){
                        importer(page + 7);
                    }else {
                        preloader.classList.remove('active');
                        btnImport.classList.remove('disabled');
                        if(nbBouteilleTotal == 0) {
                            message.textContent = "Aucun bouteille a été ajoutée";
                        }else {
                            table.style.display = 'table';
                            message.textContent = nbBouteille + " bouteille(s) a été ajoutée(s)";
                            tbody.innerHTML = tableRow;
                        }
                    }
                
            }).catch(error => console.log(error))
      /*       fetch(`/obtenirListeSAQ/${page}`)
        .then(response => {
            return (response.json())
        })
        .then(response => {
            
            if(response != 'stop'){
               
                
           
             
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
           
            page++;
            importer(94);
            }else {
                preloader.classList.remove('active');
                btnImport.classList.remove('disabled');
            }
        }).catch(error => console.log(error)) */
      }
  });