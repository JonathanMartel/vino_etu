import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { ActivatedRoute } from '@angular/router';
import { MatSnackBar } from '@angular/material/snack-bar';

@Component({
    selector: 'app-fiche-bouteille',
    templateUrl: './fiche-bouteille.component.html',
    styleUrls: ['./fiche-bouteille.component.scss']
})
export class FicheBouteilleComponent implements OnInit {
    bouteille: any;
    bouteilleId: any;

    constructor(private servBouteilleDeVin: BouteilleDeVinService, private actRoute: ActivatedRoute, private snackBar: MatSnackBar) { }

    ngOnInit(): void {

        this.bouteilleId = this.actRoute.snapshot.paramMap.get('id');

        this.servBouteilleDeVin.getBouteilleParId(this.bouteilleId).subscribe(bouteille => this.bouteille = bouteille.data);

        this.actRoute.data.subscribe(data => { this.bouteille = data.bouteille; });
    }

    openSnackBar(message: any, action: any) {
        this.snackBar.open(message, action);
    }

    ajouterBouteilleCellier() {
        const bouteilleAchetee = {
            nom             : this.bouteille.nom,
            description     : this.bouteille.description,
            url_image       : this.bouteille.url_image,
            url_achat       : this.bouteille.url_achat,
            url_info        : this.bouteille.url_info,
            origine         : this.bouteille.pays,
            millesime       : 1980,
            date_acquisition: "2021-11-01",
            prix_paye       : 25.58,
            conservation    : "4 ans",
            format          : this.bouteille.format,
            categories_id   : this.bouteille.categories_id,
            inventaire      : 4,
            celliers_id     : 1,
        }

        this.servBouteilleDeVin.ajoutBouteilleCellier(bouteilleAchetee).subscribe(() => { this.openSnackBar('Vous avez ajouté une bouteille à votre cellier', 'dismiss') });
    }

}
