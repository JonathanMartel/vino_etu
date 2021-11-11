import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
    selector: 'app-ajout-bouteille',
    templateUrl: './ajout-bouteille.component.html',
    styleUrls: ['./ajout-bouteille.component.scss']
})
export class AjoutBouteilleComponent implements OnInit {
    bouteilleAchetee: any;
    listeCelliers!: any[];

    ajoutBouteille = new FormGroup({
        millesime: new FormControl(''),
        inventaire: new FormControl('', Validators.required),
        date_acquisition: new FormControl(''),
        prix_paye: new FormControl(''),
        conservation: new FormControl(''),
        notes_personnelles: new FormControl(''),
        cellierId: new FormControl(''),
    });

    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
        private authService: AuthService,
        private actRoute: ActivatedRoute,
        public formulaireRef: MatDialogRef<AjoutBouteilleComponent>,
        @Inject(MAT_DIALOG_DATA) public data: any,
        private snackBar: MatSnackBar,
        private router: Router) { }

    ngOnInit(): void {
        console.log("init");

        // Charger la liste des celliers de l'utilisateur.
        this.servBouteilleDeVin.getListeCelliersParUtilisateur(this.authService.getIdUtilisateurAuthentifie())
            .subscribe((data: any) => {
                this.listeCelliers = data;
            })
    }

    get erreur() {
        return this.ajoutBouteille.controls;
    }

    openSnackBar(message: any, action: any) {
        this.snackBar.open(message, action, {
            duration: 3000,
            panelClass: 'notif-success'
        });
    }

    postBouteilleCellier(bouteille: any) {

        this.bouteilleAchetee = { ...this.data, ...bouteille }

        this.bouteilleAchetee.origine = this.data.pays;
        this.bouteilleAchetee.users_id = 1;

        this.servBouteilleDeVin.ajoutBouteilleCellier(bouteille.cellierId, this.bouteilleAchetee)
            .subscribe(() => {
                this.openSnackBar('Vous avez ajouté une bouteille à votre cellier', 'Fermer')
                this.formulaireRef.close();

                this.router.navigate(['/bouteilles']);
            });
    }


}
