import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Observable } from 'rxjs';
import { switchMap } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class AuthService {

    private _utilisateurAuthentifie!: any;
    private _utilisateurToken!: any;


    // private url: string = "http://127.0.0.1:8000/api";
    private url: string = "http://kalimotxo-vino.akira.dev/api";
    // private url: string = new URL(window.location.href).origin + "/api";

    constructor(
        private http: HttpClient,
        private snackBar: MatSnackBar,
    ) {

    }

    connexion(data: any) {
        return this.http.post<any>(
            this.url + '/connection',
            data
        ).subscribe(
            (data) => {
                this.setUtilisateurActif(data.utilisateur, data.token);
                this.enregistrerUtilisateurActifLocalStorage(data.utilisateur, data.token);
            },
            (error) => {
                this.snackBar.open(error.error.message, "Fermer", { duration: 3000, panelClass: 'notif-danger' });
                return false;
            }
        );
    }

    private setUtilisateurActif(utilisateur: any, token: string): void {
        this._utilisateurAuthentifie = utilisateur;
        this._utilisateurToken = token;
    }

    /**
     *
     * Getter public des propriétés privées de l'utilisateur authentifié
     *
     * @returns objet des propriétés de l'utilisateur authentifié
     *
     */
    get utilisateurAuthentifie(): object | null {
        return this._utilisateurAuthentifie;
    }

    /**
     *
     * Getter public du token de l'utilisateur auth du service d'authentification
     *
     * @returns chaîne du token api de l'utilisateur authentifié
     *
     */

    getToken(): string | null {
        return this._utilisateurToken;
    }

    /**
     *
     * Setter public des propriétés privées de l'utilisateur authentifié
     *
     */
    set utilisateur(utilisateur: object) {
        this._utilisateurAuthentifie = utilisateur;
    }

    /**
     *
     * Setter public du token api de l'utilisateur authentifié
     *
     */
    set token(token: string) {
        this._utilisateurToken = token;
    }

    /**
     *
     * Déconnecter l'usager présentement authentifié
     *
     * @returns La réponse reçue confirmant ou non la déconnexion
     *
     */
    deconnexion(): any {
        const entete = {
            'Authorization': `Bearer ${this.getToken()}`,
        }
        return this.http.post<any>(
            this.url + '/deconnexion',
            null, // Pas de body à envoyer
            {
                headers: entete
            }
        )
            .subscribe(
                data => {
                    this.reinitialiserUtilisateur();
                    console.log(this._utilisateurAuthentifie);
                    return data;
                },
                error => {
                    return error;
                }
            );
    }

    reinitialiserUtilisateur() {
        this._utilisateurAuthentifie = null;
        this._utilisateurToken = null;
    }

    estAuthentifie(): boolean {
        return this._utilisateurToken ? true : false;
    }

    getIdUtilisateurAuthentifie(): number {
        return this._utilisateurAuthentifie.id ?? false;
    }
}
