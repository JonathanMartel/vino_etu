import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';


@Component({
  selector: 'app-creer-compte',
  templateUrl: './creer-compte.component.html',
  styleUrls: ['./creer-compte.component.scss']
})
export class CreerCompteComponent implements OnInit {
  ajouterUtilisateur = new FormGroup({

    first_name: new FormControl(''),
    last_name: new FormControl(''),
    email: new FormControl(''),
    password: new FormControl(''),

  });

  constructor(private servBouteilleDeVin:BouteilleDeVinService) { }

  ngOnInit(): void {
  }

  postUser(data:any){
    console.log(data);
    
  }

}
