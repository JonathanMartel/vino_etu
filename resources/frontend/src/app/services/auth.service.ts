import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

    _utilisateurAuthentifie!: any;
    _utilisateurToken!: any;


    // private url: string = "http://127.0.0.1:8000/api";
    private url:string = "http://kalimotxo-vino.akira.dev/api";

    constructor(
        private http: HttpClient
    ) {
        this.connexion({
            email: "vino@kalimotxo.com",
            password: "password",
        })
        .subscribe(
            data => {
                console.log(data);
                this.utilisateur = data.utilisateur;
                this.token = data.token;
                return data;
            },
            error => {
                return error;
            }
        )
    }

    connexion(data: any) {
        return this.http.post<any>(
            this.url + '/connection',
            data
        );
    }

    /**
     *
     * Getter public des propriétés privées de l'utilisateur authentifié
     *
     * @returns objet des propriétés de l'utilisateur authentifié
     *
     */
    get utilisateurAuthentifie(): object|null {
        return this._utilisateurAuthentifie;
    }

    /**
     *
     * Getter public du token de l'utilisateur auth du service d'authentification
     *
     * @returns chaîne du token api de l'utilisateur authentifié
     *
     */

    get utilisateurToken(): string|null {
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
            'Authorization': `Bearer ${this.utilisateurToken}`,
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
