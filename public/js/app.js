document.addEventListener('DOMContentLoaded', function() {
    console.log("hello");
    var elems = document.querySelectorAll('.sidenav');
    // var option={edge: left};

    var instances = M.Sidenav.init(elems);
    
  });