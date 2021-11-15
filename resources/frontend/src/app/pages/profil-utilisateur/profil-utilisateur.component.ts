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

  constructor(
    private authService: AuthService,
    public dialog: MatDialog,
  ) { }

  ngOnInit(): void {

    // Recuperer les données de l'utilisateur authentifie
    this.utilisateur = this.authService.utilisateurAuthentifie;
    //console.log(this.utilisateur);
  }

  modifierUtilisateur(utilisateur: any): void {
    console.log(utilisateur);

    let modifierUtilisateur = this.dialog.open(ModifierUtilisateurComponent, {

      data: utilisateur
    });
  }

}
