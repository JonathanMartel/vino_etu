import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';
import {FormControl} from '@angular/forms';

@Component({
  selector: 'app-cellier',
  templateUrl: './cellier.component.html',
  styleUrls: ['./cellier.component.scss']
})
export class CellierComponent implements OnInit {
  cellier:any;
  mode = new FormControl('over');
  shouldRun = [/(^|\.)plnkr\.co$/, /(^|\.)stackblitz\.io$/].some(h => h.test(window.location.host));


  constructor(private servBouteilleDeVin:BouteilleDeVinService) {

  }

  ngOnInit(): void {


    this.servBouteilleDeVin.getCellier().subscribe(cellier => {this.cellier = cellier.data, console.log(this.cellier)});

  }



}
