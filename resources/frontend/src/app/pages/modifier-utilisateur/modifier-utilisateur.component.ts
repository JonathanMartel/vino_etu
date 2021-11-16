import { Component, Inject, OnInit, Output, ViewChild } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { Location } from '@angular/common'
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { EventEmitter } from '@angular/core';

@Component({
  selector: 'app-modifier-utilisateur',
  templateUrl: './modifier-utilisateur.component.html',
  styleUrls: ['./modifier-utilisateur.component.scss']
})
export class ModifierUtilisateurComponent implements OnInit {

  userId: any;

  champEnModification: string = "";

  modifierDonneesUtilisateur = new FormGroup({
    first_name: new FormControl('', [Validators.required]),
    last_name: new FormControl('', [Validators.required]),
    city: new FormControl(''),
    dob: new FormControl(''),
  })

  // Émetteur d'événnement afin d'afficher la liste des celliers sans refresh après la modification
  @Output("profilUtilisateur") profilUtilisateur: EventEmitter<any> = new EventEmitter();


  constructor(
    private servBouteilleDeVin: BouteilleDeVinService,
    private authService: AuthService,
    private snackBar: MatSnackBar,
    public formModifierUtilisateur: MatDialogRef<ModifierUtilisateurComponent>,
    @Inject(MAT_DIALOG_DATA) public data:any,
    private router: Router,
    private location: Location,
  ) { }

  ngOnInit(): void {

    this.userId = this.data.id;

    this.initChampsModification();

  }

  // Affichage d'erreur quand le champ n'est pas rempli
  get erreur() {
    return this.modifierDonneesUtilisateur.controls;
  }

  initChampsModification() {
    this.modifierDonneesUtilisateur.patchValue({
      first_name: this.data.first_name,
      last_name: this.data.last_name,
      city: this.data.city,
      dob: this.data.dob,
    })
  }

  openSnackBar(message: any, action: any) {
    this.snackBar.open(message, action, {
        duration: 3000,
        panelClass: 'notif-success'
    });
  }

  // Revenir à la page précédente
  back(): void {
    this.location.back()
  }

  putUtilisateur(nouvelleInfo:any){
    console.log(nouvelleInfo);

    this.servBouteilleDeVin.modifierUtilisateur(this.userId, nouvelleInfo).subscribe(() => {
      this.openSnackBar('Vous avez modifié les informations personnelle avec succès', 'Fermer');

      this.formModifierUtilisateur.close();

      this.profilUtilisateur.emit();

      //this.router.navigate(['profil']);
    });
  }
}
