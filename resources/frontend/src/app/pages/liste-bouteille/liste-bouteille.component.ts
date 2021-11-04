import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';


@Component({
    selector: 'app-liste-bouteille',
    templateUrl: './liste-bouteille.component.html',
    styleUrls: ['./liste-bouteille.component.scss']
})
export class ListeBouteilleComponent implements OnInit {
    bouteille: any;

    // Sauvegarder la liste initiale de bouteilles afin de s'éviter une requête http/sql pour un "reset"
    bouteillesInitiales: any;

    constructor(private servBouteilleDeVin: BouteilleDeVinService) { }

    ngOnInit(): void {
        this.servBouteilleDeVin
            .getListeBouteille()
            .subscribe(bouteille => this.bouteillesInitiales = this.bouteille = bouteille.data);
    }

    recherche($event: any): void {
        const texteRecherche: string = $event.target.value;

        if (texteRecherche.length < 3 && this.bouteille != this.bouteillesInitiales) {
            this.bouteille = this.bouteillesInitiales;
            return;
        }

        this.servBouteilleDeVin
            .getListeBouteille({
                texteRecherche: texteRecherche
            })
            .subscribe(bouteille => {
                this.bouteille = bouteille.data;
            });
    }
}
