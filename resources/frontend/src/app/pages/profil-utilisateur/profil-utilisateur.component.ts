import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { ModifierUtilisateurComponent } from '@pages/modifier-utilisateur/modifier-utilisateur.component';
import { AuthService } from '@services/auth.service';

@Component({
  selector: 'app-profil-utilisateur',
  templateUrl: './profil-utilisateur.component.html',
  styleUrls: ['./profil-utilisateur.component.scss']
})
export class ProfilUtilisateurComponent implements OnInit {

  utilisateur: any;


  constructor(private authService: AuthService, public dialog: MatDialog) { }

  ngOnInit(): void {

    this.utilisateur = this.authService.utilisateurAuthentifie;
    //console.log(this.utilisateur);

  }

  modifierUtilisateur(): void {
    //let utilisateur = this.utilisateur;
    let modifierUtilisateur = this.dialog.open(ModifierUtilisateurComponent, {
      data: {}
    });
  }

}
