import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class AuthService {

    _utilisateurAuthentifie!: object;
    _utilisateurToken!: string;


    private url: string = "http://127.0.0.1:8000/api";
    //private url:string = "http://kalimotxo-vino.akira.dev/api";

    constructor(
        private http: HttpClient
    ) { }

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
    get utilisateurAuthentifie(): object {
        return this._utilisateurAuthentifie;
    }

    /**
     *
     * Getter public du token de l'utilisateur auth du service d'authentification
     *
     * @returns chaîne du token api de l'utilisateur authentifié
     *
     */

    get utilisateurToken(): string {
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
     * @returns Observable La réponse reçue confirmant ou non la déconnexion
     *
     */
    deconnexion(): Observable<object> {
        const entete = {
            'Authorization': `Bearer ${this.utilisateurToken}`,
        }

        return this.http.post<any>(
            this.url + '/deconnexion',
            null, // Pas de body à envoyer
            {
                headers: entete
            }
        );
    }

}
