import { Component, Input, OnInit, Output } from '@angular/core';
import { startWith, pairwise, debounceTime, distinctUntilChanged } from "rxjs/operators"
import { FormControl, Validators } from '@angular/forms';
import { MatDialog } from '@angular/material/dialog';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { Subject } from 'rxjs';
import { EventEmitter } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';

@Component({
    selector: 'app-cellier-bouteille',
    templateUrl: './cellier-bouteille.component.html',
    styleUrls: ['./cellier-bouteille.component.scss']
})
export class CellierBouteilleComponent implements OnInit {

    bouteille: any;

    // Sujet (observable) permettant de "debouncer" l'envoi de la modification à la base de données
    inventaireSubject: Subject<number> = new Subject<number>();

    // Propriété permettant de rapidement savoir si la bouteille est en stock ou non
    enStock !: boolean;

    inventaire: FormControl = new FormControl("", [
        Validators.min(0)
    ]);

    @Input() set uneBouteille(bouteille: any) {
        this.bouteille = bouteille
        if (bouteille) {
            this.inventaire.setValue(bouteille.inventaire);
            this.enStock = bouteille.inventaire > 0;
            this.inventaire.valueChanges
                .pipe(startWith(undefined), pairwise())
                .subscribe(valeurs => {
                    const oldValeur = valeurs[0];
                    const newValeur = valeurs[1];

                    if (newValeur < 0) {
                        this.inventaire.setValue(0);
                        return;
                    }

                    // Ajuster la "disponibilité" selon la nouvelle valeur reçue
                    this.enStock = newValeur > 0;

                    if (newValeur !== oldValeur) {
                        if (this.inventaireSubject.observers.length === 0) {
                            this.inventaireSubject
                                .pipe(debounceTime(700), distinctUntilChanged())
                                .subscribe(inventaire => {
                                    this.enregistrerNouvelInventaire();
                                });
                        }

                        this.inventaireSubject.next(newValeur);
                    }
                })
        }

    };

    @Output("chargerBouteilles") chargerBouteilles: EventEmitter<any> = new EventEmitter();

    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
        public formModifierBouteille: MatDialog,
        private snackBar: MatSnackBar
    ) { }

    ngOnInit(): void {

    }


    augmenter() {
        this.inventaire.setValue(this.inventaire.value + 1);
    }

    diminuer() {
        this.inventaire.setValue(this.inventaire.value - 1);
    }


   enregistrerNouvelInventaire() {
        this.servBouteilleDeVin.modifierInventaireCellierBouteille(this.bouteille.inventaireId, this.inventaire.value)
            .subscribe()
    }

    openSnackBar(message: any, action: any) {
        this.snackBar.open(message, action, {
            duration: 3000,
            panelClass: 'notif-success'
        });
    }

    supprimerBouteille(){
        this.servBouteilleDeVin.confirmDialog('Voulez vous vraiment supprimer la bouteille ?')
         .afterClosed().subscribe(res => {
             if(res){
                this.servBouteilleDeVin.supprimerBouteilleCellier(this.bouteille.inventaireId).subscribe(()=>{
                   this.chargerBouteilles.emit();
                   this.openSnackBar('Vous avez supprimer la bouteille avec succès', 'Fermer');

                });
             }
         })

       // console.log(this.bouteille)


    }


}
