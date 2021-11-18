document.addEventListener('DOMContentLoaded', function() {
    const recherche = document.querySelector("#search");
   
    recherche.addEventListener('input', () => {
        fetch(`/rechercherCatalogue/${recherche.value.trim()}`)
        .then(response => {
            return (response.json())
        })
        .then(response => {
         
            
            document.querySelector('#table').innerHTML = response.table;
           paginationApresRecherche();
            
        }).catch(error => console.log(error))
    })

    const paginationApresRecherche = () => {
        const pagination = document.querySelector('.pagination');
        if(pagination){
            pagination.querySelectorAll('a').forEach(lien => {
                lien.addEventListener('click', e => {
                    e.preventDefault();
                    fetch(lien.href)
                    .then(response => {
                        return (response.json())
                    })
                    .then(response => {
                      
                        document.querySelector('#table').innerHTML = response.table;
                        paginationApresRecherche();
                        window.scrollTo(0, 0);
                    })
                })
            })
        }
    }
   
    

    const paginationDepart = () => { 
        const pagination = document.querySelector('.pagination');
        pagination.querySelectorAll('a').forEach(lien => {
            lien.addEventListener('click', e => {
                e.preventDefault();
            
                fetch(lien.href)
                .then(response => {
                    
                    return (response.text())
                })
                .then(response => {
                    let html = document.createElement('html')
                    html.innerHTML = response;
                    document.querySelector('#table').innerHTML = html.querySelector('#table').innerHTML;
                    paginationDepart();
                    window.scrollTo(0, 0);
                })
            })
        }) 
    }

    paginationDepart();
});