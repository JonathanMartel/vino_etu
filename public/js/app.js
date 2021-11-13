document.addEventListener('DOMContentLoaded', function() {
  //document.head.innerHTML = document.head.innerHTML + "<base href='" + document.location.origin + "/InVinoVeritas' />";
    var elems = document.querySelectorAll('.sidenav');


    var instances = M.Sidenav.init(elems, {
      edge: 'right'
    });
  
    const page = location.href.split('/')[3];
    const footerNav = document.querySelector('.footer-nav');
    const url = location.href;

    if(page != 'login' && page != 'registration' && page != 'importerBouteille' && (page != 'cellier' || location.href.split('/')[4])){   

      footerNav.style.display = 'flex';
      
      let timer = null;
      document.addEventListener('scroll', ()=> {
    
        if(timer !== null) {
          clearTimeout(timer);        
      }

        footerNav.style.opacity = '0';
        timer = setTimeout(() => {
          footerNav.style.opacity = '100';
          }, 300)
      }) 

      
      footerNav.addEventListener('click', ()=> {
        
        if(url.split('/')[3] == 'user'){
          location.href = location.origin + "/dashboard" ;
          
        }else if(url.split('/')[3] == 'vin'){
          location.href = location.origin + "/cellier/" + sessionStorage.getItem('idCellier') + "/" + sessionStorage.getItem('idBouteille');
          
        }else if(url.split('/')[5] == 'edit') {
          location.href = location.origin + "/cellier" ;
        }
        else if(url.split('/')[5] != null){
          location.href = location.origin + "/cellier/" + url.split('/')[4];
        }
        else if(url.split('/')[3] == "dashboard" || url.split('/')[4] != null){
          location.href = location.origin + "/cellier" ;
        }
      })
  
  }
  
    
  });