import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-modifier-utilisateur',
  templateUrl: './modifier-utilisateur.component.html',
  styleUrls: ['./modifier-utilisateur.component.scss']
})
export class ModifierUtilisateurComponent implements OnInit {

  utilisateur: any;

  champEnModification: string = "";

  modifierDonneesUtilisateur = new FormGroup({
    first_name: new FormControl('', [Validators.required, Validators.minLength(3)]),
      last_name: new FormControl('', [Validators.required, Validators.minLength(3)]),
      city: new FormControl('', [Validators.required]),
      dob: new FormControl('', [Validators.required]),
      email: new FormControl('', [Validators.required, Validators.email]),
      password: new FormControl('', Validators.required)
  })

  constructor(private servBouteilleDeVin: BouteilleDeVinService,
              private authService: AuthService,
              public modifierUtilisateur: MatDialogRef<ModifierUtilisateurComponent>,
              ) { }

  ngOnInit(): void {
    this.utilisateur = this.authService.utilisateurAuthentifie;
    this.initChampsModification();
  }


  initChampsModification() {
    this.modifierDonneesUtilisateur.patchValue({
        first_name: this.utilisateur.first_name,
        last_name: this.utilisateur.last_name,
        city: this.utilisateur.city,
        dob: this.utilisateur.dob,
    })
}


  putUtilisateur(data:any){}


}
