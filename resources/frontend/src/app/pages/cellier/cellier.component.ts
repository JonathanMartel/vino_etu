import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-cellier',
  templateUrl: './cellier.component.html',
  styleUrls: ['./cellier.component.scss']
})
export class CellierComponent implements OnInit {
  cellier:any;


  constructor(private servBouteilleDeVin:BouteilleDeVinService) {

  }

  ngOnInit(): void {


    this.servBouteilleDeVin.getCellier().subscribe(cellier => {this.cellier = cellier.data, console.log(this.cellier)});

  }

  

}
