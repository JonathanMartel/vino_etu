import { Component, OnInit } from '@angular/core';
import { MatDialog, MatDialogConfig } from '@angular/material/dialog';
import { ModifierUtilisateurComponent } from '@pages/modifier-utilisateur/modifier-utilisateur.component';
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-profil-utilisateur',
  templateUrl: './profil-utilisateur.component.html',
  styleUrls: ['./profil-utilisateur.component.scss']
})
export class ProfilUtilisateurComponent implements OnInit {

  utilisateur: any;

  utilisateurModifier: any;

  constructor(
    private authService: AuthService,
    private servBouteilleDeVin: BouteilleDeVinService,
    public dialog: MatDialog,
  ) { }

  ngOnInit(): void {

    // Recuperer l'utilisateur authentifie
    this.servBouteilleDeVin.getUtilisateurParId(this.authService.getIdUtilisateurAuthentifie()).subscribe((data: any) => {
      console.log(data);
      this.utilisateur = data;
    });
  }

  formulaireModifierUtilisateur(utilisateur: any): void {

    let modifierUtilisateur = this.dialog.open(ModifierUtilisateurComponent, {

      data: utilisateur
    });

    this.profilUtilisateur();

    const response = modifierUtilisateur.componentInstance.profilUtilisateur.subscribe(() => {this.profilUtilisateur()});
  }


  profilUtilisateur() {
    this.servBouteilleDeVin.getUtilisateurParId(this.authService.getIdUtilisateurAuthentifie()).subscribe((data: any) => {
      console.log(data);
      this.utilisateurModifier = this.utilisateur = data;
    });
  }

}
