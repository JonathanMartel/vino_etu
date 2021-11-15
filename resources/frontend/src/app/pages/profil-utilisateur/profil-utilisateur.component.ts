import { Component, OnInit } from '@angular/core';
import { MatDialog, MatDialogConfig } from '@angular/material/dialog';
import { ModifierUtilisateurComponent } from '@pages/modifier-utilisateur/modifier-utilisateur.component';
import { AuthService } from '@services/auth.service';

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
    public dialog: MatDialog,
  ) { }

  ngOnInit(): void {

    // Recuperer les données de l'utilisateur authentifie
    this.utilisateur = this.authService.utilisateurAuthentifie;
  }

  formulaireModifierUtilisateur(utilisateur: any): void {

    let modifierUtilisateur = this.dialog.open(ModifierUtilisateurComponent, {

      data: utilisateur
    });

    this.profilUtilisateur();

    //const response = modifierUtilisateur.componentInstance.profilUtilisateur.subscribe(() => {this.profilUtilisateur()});
  }


  profilUtilisateur() {
    this.utilisateurModifier = this.authService.utilisateurAuthentifie;
    this.utilisateurModifier = this.utilisateur;
  }

}
