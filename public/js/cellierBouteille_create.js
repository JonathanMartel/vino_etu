document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelector('.autocomplete');
    fetch("/liste")
    .then(response => {
        return (response.json())
    })
    .then(response => {
        console.log(response)
        var instances = M.Autocomplete.init(elems, {
            data: {
              "Apple": null,
              "Microsoft": null,
              "Google": 'https://placehold.it/250x250'
            },
          });
    })
  

  });
