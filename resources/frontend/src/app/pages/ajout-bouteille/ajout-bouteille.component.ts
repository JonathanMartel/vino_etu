import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute } from '@angular/router';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
    selector: 'app-ajout-bouteille',
    templateUrl: './ajout-bouteille.component.html',
    styleUrls: ['./ajout-bouteille.component.scss']
})
export class AjoutBouteilleComponent implements OnInit {
    bouteilleAchetee: any;

    ajoutBouteille = new FormGroup({
        millesime: new FormControl(''),
        inventaire: new FormControl(''),
        date_acquisition: new FormControl(''),
        prix_paye: new FormControl(''),
        conservation: new FormControl(''),
        notes_personnelles: new FormControl(''),
    });

    constructor(private servBouteilleDeVin: BouteilleDeVinService,
        private actRoute: ActivatedRoute,
        private snackBar: MatSnackBar,
        public formulaireRef: MatDialogRef<AjoutBouteilleComponent>,
        @Inject(MAT_DIALOG_DATA) public data: any) { }

    ngOnInit(): void {
        this.data;
        console.log(this.data.pays);
    }

    openSnackBar(message: any, action: any) {
        this.snackBar.open(message, action, {
            duration: 3000
        });
    }

    postBouteilleCellier(bouteille: any) {
        /* const bouteilleAchetee = {
            nom: this.bouteille.nom,
            description: this.bouteille.description,
            url_image: this.bouteille.url_image,
            url_achat: this.bouteille.url_achat,
            url_info: this.bouteille.url_info,
            origine: this.bouteille.pays,
            millesime: 1980,
            date_acquisition: "2021-11-01",
            prix_paye: 25.58,
            conservation: "4 ans",
            format: this.bouteille.format,
            categories_id: this.bouteille.categories_id,
            inventaire: 4,
            celliers_id: 1,
            users_id: 1,
        } */

        this.bouteilleAchetee = { ...this.data, ...bouteille }

        this.bouteilleAchetee.origine = this.data.pays;
        this.bouteilleAchetee.celliers_id = 1;
        this.bouteilleAchetee.users_id = 1;

        console.log(this.bouteilleAchetee);

        this.servBouteilleDeVin.ajoutBouteilleCellier(this.bouteilleAchetee).subscribe(() => {
            this.openSnackBar('Vous avez ajouté une bouteille à votre cellier', 'Fermer') 
         });

        setTimeout(() => {
            this.formulaireRef.close();
        }, 2000)

    }


}
