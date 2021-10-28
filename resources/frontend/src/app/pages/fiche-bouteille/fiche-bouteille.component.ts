import { Component, OnInit } from '@angular/core';
<<<<<<< HEAD
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';
import { ActivatedRoute } from '@angular/router';
=======
import { ActivatedRoute } from '@angular/router';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
>>>>>>> b04df2bc6b3d5c2b0bae0a314889ac18141918d8

@Component({
  selector: 'app-fiche-bouteille',
  templateUrl: './fiche-bouteille.component.html',
  styleUrls: ['./fiche-bouteille.component.scss']
})
export class FicheBouteilleComponent implements OnInit {
<<<<<<< HEAD
=======

>>>>>>> b04df2bc6b3d5c2b0bae0a314889ac18141918d8
  bouteille:any;
  bouteilleId:any;

  constructor(private servBouteilleDeVin:BouteilleDeVinService, private actRoute: ActivatedRoute) { }

  ngOnInit(): void {

    this.bouteilleId = this.actRoute.snapshot.paramMap.get('id');

    this.servBouteilleDeVin.getBouteilleParId(this.bouteilleId).subscribe(bouteille => this.bouteille = bouteille.data);

<<<<<<< HEAD
  // console.log(this.actRoute.data);
=======
  console.log(this.actRoute.data);
>>>>>>> b04df2bc6b3d5c2b0bae0a314889ac18141918d8

    this.actRoute.data.subscribe(data => { this.bouteille = data.bouteille; });
  }

  ajouterBouteilleCellier(bouteilleId:any){

    this.servBouteilleDeVin.ajoutBouteilleCellier(bouteilleId).subscribe(response => {console.log(response)});
    //console.log(bouteilleId);
  }
<<<<<<< HEAD

  

=======
>>>>>>> b04df2bc6b3d5c2b0bae0a314889ac18141918d8
}
