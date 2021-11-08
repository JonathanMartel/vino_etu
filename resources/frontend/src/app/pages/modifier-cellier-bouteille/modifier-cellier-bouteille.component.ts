import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute } from '@angular/router';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
    selector: 'app-modifier-cellier-bouteille',
    templateUrl: './modifier-cellier-bouteille.component.html',
    styleUrls: ['./modifier-cellier-bouteille.component.scss']
})
export class ModifierCellierBouteilleComponent implements OnInit {
    bouteille: any;
    bouteilleId: any;

    // Nom du champ qui est présentement modifiable. Il ne peut donc y en avoir qu'un seul à la fois.
    champEnModification: string = "";


    modifierBouteilleCellier = new FormGroup({
        url_image: new FormControl(''),
        nom: new FormControl(''),
        description: new FormControl(''),
        format: new FormControl(''),
        origine: new FormControl(''),
        url_achat: new FormControl(''),
        millesime: new FormControl(''),
        inventaire: new FormControl(''),
        date_acquisition: new FormControl(''),
        prix_paye: new FormControl(''),
        conservation: new FormControl(''),
        notes_personnelles: new FormControl(''),
    });


    constructor(private servBouteilleDeVin: BouteilleDeVinService, private actRoute: ActivatedRoute,
        private snackBar: MatSnackBar
              /* public formulaireRef: MatDialogRef<ModifierCellierBouteilleComponent>,
              @Inject(MAT_DIALOG_DATA) public data:any */) { }

    ngOnInit(): void {

        this.bouteilleId = this.actRoute.snapshot.params.id;
        //console.log(this.bouteilleId);
        this.servBouteilleDeVin.getBouteilleAcheteeParId(this.bouteilleId).subscribe(rep => {
            this.bouteille = rep.data;
           // console.log(this.bouteille);
            this.initChampsModification();
        })

    }

    initChampsModification() {
        this.modifierBouteilleCellier.patchValue({
            url_image: this.bouteille.url_image,
            nom: this.bouteille.nom,
            description: this.bouteille.description,
            format: this.bouteille.format,
            origine: this.bouteille.origine,
            url_achat: this.bouteille.url_achat,
            millesime: this.bouteille.millesime,
            inventaire: this.bouteille.inventaire,
            date_acquisition: this.bouteille.date_acquisition,
            prix_paye: this.bouteille.prix_paye,
            conservation: this.bouteille.conservation,
            notes_personnelles: this.bouteille.notes_personnelles,
        })
    }

    openSnackBar(message: any, action: any) {
        this.snackBar.open(message, action, {
            duration: 3000
        });
    }

    putBouteille(nouvellesDonnes: any) {

        this.servBouteilleDeVin.modifierBouteilleCellier(this.bouteilleId, nouvellesDonnes).subscribe(() => {
            this.openSnackBar('Vous avez modifer la bouteille avec succès', 'Fermer');
        });

       // console.log(nouvellesDonnes);
    }
}
