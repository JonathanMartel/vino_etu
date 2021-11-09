document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll("section");

    sections.forEach((section) => {
        /**
         * Requête fetch pour incrémenter la quantité d'une bouteille à un cellier sans recharger la page
         */
        const btnAjouter = section.querySelector(
            '[name="btnAjouterBouteille"]'
        );
        const quantitePrecedent = section.querySelector(".quantite > span");

        btnAjouter.addEventListener("click", (e) => {
            e.preventDefault();

            fetch(btnAjouter.href)
                .then((response) => {
                    return response.json();
                })
                .then((response) => {
                    quantitePrecedent.innerHTML =
                        parseInt(quantitePrecedent.innerHTML) + response;
                })
                .catch((error) => console.log(error));
        });

        /**
         * Requête fetch pour décrémenter la quantité d'une bouteille à un cellier sans recharger la page
         */
        const btnRetirer = section.querySelector(
            '[name="btnRetirerBouteille"]'
        );

        btnRetirer.addEventListener("click", (e) => {
            e.preventDefault();

            fetch(btnRetirer.href)
                .then((response) => {
                    return response.json();
                })
                .then((response) => {
                    if (parseInt(quantitePrecedent.innerHTML) + response >= 0)
                        quantitePrecedent.innerHTML =
                            parseInt(quantitePrecedent.innerHTML) + response;
                })
                .catch((error) => console.log(error));
        });
    });

    /**
     * Message Dialogue si une bouteille a été créé
     */

    const nouvelleBouteille = document.querySelector(".nouvelleBouteille");

    if (nouvelleBouteille) {
        var toastHTML =
            '<span>Une nouvelle bouteille a été ajoutée</span><button class="btn-flat toast-action">Fermer</button>';
        M.toast({ html: toastHTML, displayLength: 5000 });

        const message = document.querySelector(".toast-action");

        message.addEventListener("click", () => {
            M.Toast.dismissAll();
        });
    }

    /**
     * Note
     */
    new StarRating(".star-rating", {
        maxStars: 5,
        clearable: true,
        classNames: {
            active: "gl-active",
            base: "gl-star-rating",
            selected: "gl-selected",
        },
        stars: function (el, item, index) {
            el.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
        },
        tooltip: false,
    });

    /**
     * Ajouter un note à une bouteille en cliquant sur une étoile
     */
    const notes = document.querySelectorAll(".star-rating");

    notes.forEach((note) => {
        note.addEventListener("change", (e) => {
            const idBouteille = e.target.dataset.idBouteille;
            const millesime = e.target.dataset.millesime;
            const idCellier = location.pathname.split("/")[2];
            const uneNote = note.closest('span').querySelector('[data-rating]').dataset.rating;
            
            fetch(
                `/ajouterNote/${idCellier}/${idBouteille}/${millesime}/${uneNote}`
            ).catch((error) => console.log(error));
        });
    });

    /**
     * Un select permettant de changer de cellier
     */
    var selectCellier = document.querySelector('[name="select-cellier"]');
    M.FormSelect.init(selectCellier);

    selectCellier.addEventListener("change", (e) => {
        location.href = location.origin + "/cellier/" + e.target.value;
    });

    const btnRecherche = document.querySelector(".searchbutton");
    const barreRecherche = document.querySelector(".search");
    const btnAjouterVin = document.querySelector(".bouton-ajout-vin");

    btnRecherche.addEventListener("click", (e) => {
        e.preventDefault();

        btnRecherche.classList.toggle("focus");

        if (btnRecherche.classList.contains("focus")) {
            btnAjouterVin.style.visibility = "hidden";
            barreRecherche.focus();
        } else {
            barreRecherche.blur();
            btnAjouterVin.style.visibility = "visible";
        }
    });

    window.addEventListener("click", (e) => {
        if (!btnRecherche.contains(e.target)) {
            btnRecherche.classList.remove("focus");
            btnAjouterVin.style.visibility = "visible";
        }
    });

    const idCellier = location.pathname.split("/")[2];
    const articlesConteneur = document.querySelector(".articlesConteneur");
    let chemin; 
    let timer; //https://typeofnan.dev/how-to-execute-a-function-after-the-user-stops-typing-in-javascript/
    barreRecherche.addEventListener("input", () => {
        chemin = `/rechercheDansCellier/${barreRecherche.value}/${idCellier}`;
        clearTimeout(timer);
        timer = setTimeout(() => {
        if(barreRecherche.value.trim() == '')  {
            chemin = `/reinitialiserCellier/${idCellier}`;
        }

        articlesConteneur.innerHTML = "";
    
            fetch(chemin)
            .then((response) => {
                return response.json();
            })
            .then((response) => {
                if(response.length  <=0 && barreRecherche.value.trim() == '') {
                    articlesConteneur.innerHTML = ` <div class="list-empty">
                                                        <p>Vous n'avez pour l'instant aucun vin.</p>
                                                    </div>`;
                }else {
                    let bouteilles = {};

                    for (let index = 0; index < response.length; index++) {
                        if (!bouteilles[response[index].bouteille_id]) {
                            
                            bouteilles[response[index].bouteille_id] = {
                                nom: response[index].nom,
                                pays: response[index].pays,
                                taille: response[index].taille,
                                url_img: response[index].url_img,
                                url_saq: response[index].url_saq,
                                type: response[index].type,
                                cellierBouteilles: [
                                    {
                                        millesime: response[index].millesime,
                                        quantite: response[index].quantite,
                                        note: response[index].note,
                                        prix : response[index].prix,
                                        garde_jusqua : response[index].garde_jusqua,
                                        description : response[index].description,
                                        date_achat : response[index].date_achat,
                                    },
                                ],
                            };
                        } else {
                            bouteilles[response[index].bouteille_id].cellierBouteilles.push({
                                millesime: response[index].millesime,
                                quantite: response[index].quantite,
                                note: response[index].note,
                                prix : response[index].prix,
                                garde_jusqua : response[index].garde_jusqua,
                                description : response[index].description,
                                date_achat : response[index].date_achat,
                            });
                        }
                    }

                    for (const key of Object.keys(bouteilles)) {
                        
                        let saq = "";
                        if (bouteilles[key].url_saq != null) {
                            saq = `<div class="bouteilleSAQConteneur"> <a class="lienSAQ" href="${bouteilles[key].url_saq}">SAQ</a>
                                        <div class="cercle ">
                                            <i class="material-icon check">check</i>
                                        </div>
                                    </div>`;
                        } else {
                            saq = ` <div class="bouteilleSAQConteneur"> 
                                        <p>SAQ</p>
                                        <div class="cercle ">
                                            <i class="material-icon check">close</i>
                                        </div>
                                    </div>`;
                        }
                        let infoCellierBouteilleConteneur = '<div class="infoCellierBouteilleConteneur">'
                        bouteilles[key].cellierBouteilles.forEach((cellierBouteille) => {
                            if (cellierBouteille.millesime > 0) {
                                millesimeTexte = `  <p>${cellierBouteille.millesime}</p>`;
                            } else {
                                millesimeTexte = `<p>Non millisimé</p>`;
                            }

                            extraInfo = `<div>
                                            <div class="chip">
                                            ${cellierBouteille.prix} $
                                            </div>`
                                            if(cellierBouteille.garde_jusqua != null) {
                                                extraInfo +=  `<div class="chip">
                                                            ${cellierBouteille.garde_jusqua}
                                                            </div>`
                                            }
                                            if(cellierBouteille.date_achat != null) {
                                                extraInfo += `<div class="chip">
                                                                ${cellierBouteille.date_achat}
                                                            </div>`}
                                            if(cellierBouteille.description != null) {
                                                extraInfo +=`<div class="chip">
                                                                ${cellierBouteille.description}
                                                            </div>`
                                            }
                            extraInfo += `</div>`
                            note = `  <div class="select">
                                            <select class="star-rating" data-id-bouteille="${key}" data-millesime="${cellierBouteille.millesime}" name="note">
                                                <option value="">Choisir une note</option>
                                                <option value="5"`; if(cellierBouteille.note == 5) {note += `selected`} note +=`>Excellent</option>
                                                <option value="4"`; if(cellierBouteille.note == 4) {note += `selected`} note +=`>Très bon</option>
                                                <option value="3"`; if(cellierBouteille.note == 3) {note += `selected`} note +=`>Passable</option>
                                                <option value="2"`; if(cellierBouteille.note == 2) {note += `selected`} note +=`>Médiocre</option>
                                                <option value="1"`; if(cellierBouteille.note == 1) {note += `selected`} note +=`>Terrible</option>
                                            </select>
                                        </div>`;
                            infoCellierBouteilleConteneur += `   <section class="infoCellierBouteille">
                                                                    <div class="infoUnitaires">
                                                                        ${millesimeTexte}     
                                                                        ${note}
                                                
                                                                        <p class="quantite">Quantité : <span>${cellierBouteille.quantite}</span></p>
                                                                    </div>
                                                                    <div class=" flex bouton-conteneur">
                                                                        <div class="cercle bouton-cercle-remove">
                                                                            <a class="btn-floating btn-large waves-effect waves-light " name="btnRetirerBouteille" href="/boireBouteille/${idCellier}/${key}/${cellierBouteille.millesime}">
                                                                                <i class="material-icon">remove</i>
                                                                            </a>
                                                                        </div>
                                                                        <div class="cercle bouton-cercle-add">
                                                                            <a class="btn-floating btn-large waves-effect waves-light" name="btnAjouterBouteille" href="/ajouterBouteille/${idCellier}/${key}/${cellierBouteille.millesime}">
                                                                                <i class="material-icon">add</i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </section>`;
                        });
                        infoCellierBouteilleConteneur += '</div>'
                        if(barreRecherche.value.trim() != '')  {
                            articlesConteneur.innerHTML += extraInfo;
                        }
                    
                        articlesConteneur.innerHTML += `<article class="articleVin">
                                                            <a href="/cellier/${idCellier}/${key}">
                                                                <div class="nomVinConteneur">
                                                                    <h2>${bouteilles[key].nom}</h2>
                                                                </div>
                                                            </a>
                                                            <div class="infoBouteilleConteneur">
                                                                <img class="image" src="${bouteilles[key].url_img}" alt="Image ${bouteilles[key].nom}">
                                                                <div class="info">
                                                                    <div>
                                                                        <p>${bouteilles[key].pays}</p>
                                                                        <p>${bouteilles[key].type}</p>
                                                                    </div>                
                                                                    <p class="taille">${bouteilles[key].taille} cl</p>                 
                                                                </div>
                                                                ${saq}
                                                            </div>
                                                            ${infoCellierBouteilleConteneur}
                                                                
                                                        </article>`;
                    }

                    new StarRating(".star-rating", {
                        maxStars: 5,
                        clearable: true,
                        classNames: {
                            active: "gl-active",
                            base: "gl-star-rating",
                            selected: "gl-selected",
                        },
                        stars: function (el, item, index) {
                            el.innerHTML =
                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
                        },
                        tooltip: false,
                    });
                
                    const sections = document.querySelectorAll("section");

                    sections.forEach((section) => {
                        /**
                         * Requête fetch pour incrémenter la quantité d'une bouteille à un cellier sans recharger la page
                         */
                        const btnAjouter = section.querySelector(
                            '[name="btnAjouterBouteille"]'
                        );
                        const quantitePrecedent =
                            section.querySelector(".quantite > span");

                        btnAjouter.addEventListener("click", (e) => {
                            e.preventDefault();

                            fetch(btnAjouter.href)
                                .then((response) => {
                                    return response.json();
                                })
                                .then((response) => {
                                    quantitePrecedent.innerHTML =
                                        parseInt(quantitePrecedent.innerHTML) +
                                        response;
                                })
                                .catch((error) => console.log(error));
                        });

                        /**
                         * Requête fetch pour décrémenter la quantité d'une bouteille à un cellier sans recharger la page
                         */
                        const btnRetirer = section.querySelector(
                            '[name="btnRetirerBouteille"]'
                        );

                        btnRetirer.addEventListener("click", (e) => {
                            e.preventDefault();

                            fetch(btnRetirer.href)
                                .then((response) => {
                                    return response.json();
                                })
                                .then((response) => {
                                    if (
                                        parseInt(quantitePrecedent.innerHTML) +
                                            response >=
                                        0
                                    )
                                        quantitePrecedent.innerHTML =
                                            parseInt(
                                                quantitePrecedent.innerHTML
                                            ) + response;
                                })
                                .catch((error) => console.log(error));
                        });
                    });

                     /**
                     * Ajouter un note à une bouteille en cliquant sur une étoile
                     */
                    const notes = document.querySelectorAll(".star-rating");

                    notes.forEach((note) => {
                        note.addEventListener("change", (e) => {
                            const idBouteille = e.target.dataset.idBouteille;
                            const millesime = e.target.dataset.millesime;
                            const idCellier = location.pathname.split("/")[2];
                            const uneNote = note.closest('span').querySelector('[data-rating]').dataset.rating;
                            
                            fetch(
                                `/ajouterNote/${idCellier}/${idBouteille}/${millesime}/${uneNote}`
                            ).catch((error) => console.log(error));
                        });
                    });
                
                        var elems = document.querySelectorAll('.chips');
                        var instances = M.Chips.init(elems);
                    
                }
            }).catch((error) => console.log(error));
        }, 300);
    });
});

