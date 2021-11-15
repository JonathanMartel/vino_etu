import { Component, OnInit} from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { AjoutCellierComponent } from '@pages/ajout-cellier/ajout-cellier.component';
import { ModifierCellierComponent } from '@pages/modifier-cellier/modifier-cellier.component';
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-liste-celliers',
  templateUrl: './liste-celliers.component.html',
  styleUrls: ['./liste-celliers.component.scss']
})
export class ListeCelliersComponent implements OnInit {

  listeCelliers!: any[];


 // cellierInitiales: any;

  celliers: any = [];


  constructor(
    private servBouteilleDeVin: BouteilleDeVinService,
    private authService: AuthService,
    public formAjout: MatDialog,
    public formModif: MatDialog
  ) { }

  ngOnInit(): void {

    // Charger la liste des celliers de l'utilisateur.
    this.servBouteilleDeVin.getListeCelliersParUtilisateur(this.authService.getIdUtilisateurAuthentifie())
        .subscribe((data: any) => {
          this.listeCelliers = data;
        })
  }

  // Appel du formulaire pour l'ajout d'un cellier

  formulaireAjout(data: any): void {
    let refModal = this.formAjout.open(AjoutCellierComponent, {
        data
    });

    const response = refModal.componentInstance.chargerCelliers.subscribe(() => {this.chargerCelliers()});
 }

  // Appel du formulaire pour la modification d'un cellier

  formulaireModification(data: any): void {

    let refModal = this.formModif.open(ModifierCellierComponent, {
      data
  });

  const response = refModal.componentInstance.chargerCelliers.subscribe(() => {this.chargerCelliers()});
  
 }

  // Affichage de la liste avec le nouveau cellier
  chargerCelliers() {
    this.servBouteilleDeVin.getListeCelliersParUtilisateur(this.authService.getIdUtilisateurAuthentifie()).subscribe( (cellier: any) => {
        this.celliers = this.listeCelliers = cellier

        console.log(cellier);
    });
  }

}
