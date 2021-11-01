import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';
import { ActivatedRoute } from '@angular/router';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatDialog } from '@angular/material/dialog';
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';

@Component({
  selector: 'app-fiche-bouteille',
  templateUrl: './fiche-bouteille.component.html',
  styleUrls: ['./fiche-bouteille.component.scss']
})
export class FicheBouteilleComponent implements OnInit {
  bouteille:any;
  bouteilleId:any;

  constructor(private servBouteilleDeVin:BouteilleDeVinService, private actRoute: ActivatedRoute, private snackBar:MatSnackBar, public formAjout: MatDialog) { }

  ngOnInit(): void {

    this.bouteilleId = this.actRoute.snapshot.paramMap.get('id');

    this.servBouteilleDeVin.getBouteilleParId(this.bouteilleId).subscribe(bouteille => this.bouteille = bouteille.data);

    this.actRoute.data.subscribe(data => { this.bouteille = data.bouteille; });
  }

  openSnackBar(message:any, action:any){
    this.snackBar.open(message, action);
  }

  ajouterBouteilleCellier(bouteilleId:any){

    this.servBouteilleDeVin.ajoutBouteilleCellier(bouteilleId).subscribe(()=> {this.openSnackBar('Vous avez ajouté une bouteille à votre cellier', 'dismiss')});

  }


  formulaireAjout(data:any): void {
    let formulaire = this.formAjout.open(AjoutBouteilleComponent, {
      data
    });

    formulaire.afterClosed().subscribe(result => {
      console.log('formulaire rempli')
    })
  }



}
