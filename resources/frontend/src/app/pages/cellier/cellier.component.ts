import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';
import {FormControl} from '@angular/forms';

@Component({
  selector: 'app-cellier',
  templateUrl: './cellier.component.html',
  styleUrls: ['./cellier.component.scss']
})
export class CellierComponent implements OnInit {

  // Sauvegarder la liste initiale de bouteilles afin de s'éviter une requête http/sql pour un "reset"
  cellierInitiales: any;

  cellier:any;
  mode = new FormControl('over');
  shouldRun = [/(^|\.)plnkr\.co$/, /(^|\.)stackblitz\.io$/].some(h => h.test(window.location.host));


  constructor(private servBouteilleDeVin:BouteilleDeVinService) {

  }

  ngOnInit(): void {


    this.servBouteilleDeVin.getCellier().subscribe(cellier => {this.cellier = this.cellierInitiales = cellier.data});

  }

  recherche($event: any): void {

  /*  const texteRecherche: string = $event.target.value;

    console.log(texteRecherche);

    if (texteRecherche.length < 3 && this.cellier != this.cellierInitiales) {
        this.cellier = this.cellierInitiales;
        return;
    }

    this.servBouteilleDeVin
        .getBouteillesCellier({
            texteRecherche: texteRecherche
        })
        .subscribe(cellier => {
            this.cellier = cellier.data;
        }); */
}

  

}
