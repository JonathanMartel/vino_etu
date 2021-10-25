let body = {
    "emplacement_cellier": "Sous-sol",
    "usager_id": '1'
}

fetch('http://localhost/vino_etu/api/bouteilles/1', {
        method: 'GET',
        headers: new Headers({
            'Authorization': 'Basic ' + btoa('vino:vino'),
            'Content-Type': 'application/json'
        }),
        // body: JSON.stringify(body)
    })
    .then(response => response.json())
    .then(data => console.log(data))