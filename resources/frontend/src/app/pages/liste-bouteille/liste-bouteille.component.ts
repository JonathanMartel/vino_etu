import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { Subject } from 'rxjs';
import { debounceTime, distinctUntilChanged } from 'rxjs/operators';


@Component({
    selector: 'app-liste-bouteille',
    templateUrl: './liste-bouteille.component.html',
    styleUrls: ['./liste-bouteille.component.scss']
})
export class ListeBouteilleComponent implements OnInit {
    bouteille: any;

    // Sujet (observable) permettant de "debouncer" l'envoi de la recherche à la base de données
    rechercheSujet: Subject<string> = new Subject<string>();

    // Sauvegarder la liste initiale de bouteilles afin de s'éviter une requête http/sql pour un "reset"
    bouteillesInitiales: any;

    texteRecherche: FormControl = new FormControl("");

    constructor(private servBouteilleDeVin: BouteilleDeVinService) { }

    ngOnInit(): void {
        this.servBouteilleDeVin
            .getListeBouteille()
            .subscribe(bouteille => this.bouteillesInitiales = this.bouteille = bouteille.data);
    }

    recherche($event: any): void {

        if (this.texteRecherche.value.length < 3 && this.bouteille != this.bouteillesInitiales) {
            this.bouteille = this.bouteillesInitiales;
            return;
        }

        if (this.rechercheSujet.observers.length === 0) {
            this.rechercheSujet
                .pipe(debounceTime(700), distinctUntilChanged())
                .subscribe(recherche => {
                    this.effectuerRechercheFiltree();
                });
        }

        this.rechercheSujet.next(this.texteRecherche.value);
    }

    effectuerRechercheFiltree(): void {
        this.servBouteilleDeVin
            .getListeBouteille({
                texteRecherche: this.texteRecherche.value
            })
            .subscribe(bouteille => {
                this.bouteille = bouteille.data;
            });
    }
}
