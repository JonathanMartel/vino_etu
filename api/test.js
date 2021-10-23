let body = {
    "emplacement_cellier": "Sous-sol",
    "usager_id": '1'
}

fetch('http://localhost/vino_etu/api/celliers/', {
        method: 'POST',
        headers: new Headers({
            'Authorization': 'Basic ' + btoa('1:test'),
            'Content-Type': 'application/json'
        }),
        body: JSON.stringify(body)
    })
    .then(response => response.json())
    .then(data => console.log(data))