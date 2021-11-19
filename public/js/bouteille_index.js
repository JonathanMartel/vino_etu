document.addEventListener('DOMContentLoaded', function() {
    const btnImport = document.querySelector('.btn-large');
    const preloader = document.querySelector('.preloader-wrapper');
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const message = document.querySelector('.message');
    let tableRow;
    let stop;
    let nbBouteille;
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
        stop = false;
        tableRow = '';
        nbBouteille = 0;
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
                
                
    
                
                   
                console.log(response)
                    response.forEach( data => {
                        if(data != 'stop') 
                        nbBouteille += data.length;
                    })
                   
                       
                        for (let index = 0; index < response.length; index++) {
                            if(response[index] == 'stop'){
                             stop = true;
                            }else {
                            for (let i = 0; i <  response[index].length; i++) { 
                               
                                tableRow += `<tr data-id="${response[index][i].idBouteille}">
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
                                
                        }
                        
                        }
                       
                       
                    
                    if(!stop){
                        importer(page + 7);
                    }else {
                        preloader.classList.remove('active');
                        btnImport.classList.remove('disabled');
                        
                        if(nbBouteille == 0) {
                            message.textContent = "Aucun bouteille a été ajoutée";
                        }else {
                            table.style.display = 'table';
                            message.textContent = nbBouteille + " bouteille(s) a été ajoutée(s)";
                            tbody.innerHTML = tableRow;
                        }

                        document.querySelectorAll('[data-id]').forEach(tr => {

                            tr.addEventListener('click', () => {
                                window.open(location.origin + "/vin/" + tr.dataset.id + "/edit", '_blank').focus();
                            })
                        })
                    }
                
            }).catch(error => console.log(error))

      }
  });