let body = {
    "emplacement_cellier": "Chalet",
    "usager_id": '1'
}

fetch('http://localhost/vino_etu/api/saq/t', {
        method: 'GET',
        //body: JSON.stringify(body)
    })
    .then(response => response.json())
    .then(data => console.log(data))