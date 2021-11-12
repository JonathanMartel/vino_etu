import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { FormControl } from '@angular/forms';
import { Subject } from 'rxjs';
import { debounceTime, distinctUntilChanged } from 'rxjs/operators';
import { MatDrawerMode } from '@angular/material/sidenav';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from '@services/auth.service';
import { Location } from '@angular/common';

@Component({
    selector: 'app-cellier',
    templateUrl: './cellier.component.html',
    styleUrls: ['./cellier.component.scss']
})
export class CellierComponent implements OnInit {

    // Id du cellier reçu en paramètre du router
    cellierId!: number;

    // Objet qui a les propriétés du cellier
    cellier!: any;

    // Sauvegarder la liste initiale de bouteilles afin de s'éviter une requête http/sql pour un "reset"
    bouteillesCellierInitiales: any;
    bouteillesCellier: any = [];

    test: any;

    // Sujet (observable) permettant de "debouncer" l'envoi de la recherche à la base de données
    rechercheSujet: Subject<string> = new Subject<string>();

    // Permet de savoir si l'utilisateur a effectué une recherche et ainsi présenté le bon template
    estFiltre: boolean = false;

    // Comportement de la sideNav 
    mode: MatDrawerMode = "over";

    //Form control
    texteRecherche = new FormControl('');

    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
        private actRoute: ActivatedRoute,
        private location: Location,
    ) {

    }

    ngOnInit(): void {
        this.cellier = this.location.getState();
        this.cellierId = this.actRoute.snapshot.params.id;

        // Charger les propriétés du cellier
        this.servBouteilleDeVin.getCellier(this.cellierId)
            .subscribe(data => {
                this.cellier = data;
            })

        // Utiliser le resolver pour charger le data des bouteilles du cellier
        this.actRoute.data.subscribe(data => {
            this.bouteillesCellier = this.bouteillesCellierInitiales = data.bouteillesCellier;
            console.log(this.bouteillesCellier);
        });
    }

    recherche($event: any): void {
        console.log(this.texteRecherche.value);
        if (this.texteRecherche.value.length < 3 && this.bouteillesCellier != this.bouteillesCellierInitiales) {
            this.bouteillesCellier = this.bouteillesCellierInitiales;
            return;
        }

        if (this.rechercheSujet.observers.length === 0) {
            this.rechercheSujet
                .pipe(debounceTime(400), distinctUntilChanged())
                .subscribe(recherche => {
                    if (this.texteRecherche.value.length >= 3) {
                        this.effectuerRechercheFiltree();
                    }
                });
        }

        this.rechercheSujet.next(this.texteRecherche.value);
    }

    effectuerRechercheFiltree(): void {
        this.estFiltre = true;

        this.servBouteilleDeVin
            .getBouteillesParCellier(
                this.cellierId,
                {
                    texteRecherche: this.texteRecherche.value.replace("-", " ")
                }
            )
            .subscribe(bouteillesCellier => {
                this.bouteillesCellier = bouteillesCellier.data;
            });
    }

    /**
     *
     * Charger les bouteilles contenues dans le présent cellier
     *
     * @returns {void}
     *
     */
    chargerBouteilles() {
        this.servBouteilleDeVin.getBouteillesParCellier(this.cellierId)
            .subscribe(cellier => {
                this.bouteillesCellier = this.bouteillesCellierInitiales = cellier.data
            });
    }


    /**
     *
     * Vérifier si le cellier contient des bouteilles retourn true ou false
     *
     * @returns {boolean}
     *
     */

    cellierContientBouteille() {
        return this.bouteillesCellier.length > 0;
    }
}
