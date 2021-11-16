import { Component, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { AuthService } from '@services/auth.service';

@Component({
    selector: 'app-menu-mobile',
    templateUrl: './menu-mobile.component.html',
    styleUrls: ['./menu-mobile.component.scss']
})
export class MenuMobileComponent implements OnInit {


    constructor(private servAuth: AuthService,
                private router: Router,
                private snackbar: MatSnackBar
    ) { }

    ngOnInit(): void {

    }

    // Fonction pour se deconnecter et envoyer une notification de confirmation
    /* deconnexion() {
        this.servAuth.deconnexion();
        this.router.navigate(['/connection']);
        this.snackbar.open(`Vous etes maintenant déconnecté`, "Fermer", {duration: 3000, panelClass: 'notif'});

    } */

    // Verifier si l'utilisateur est authentifie pour l'affichage des icones
    estAuthentifie() {
        return this.servAuth.estAuthentifie();
    }
}
