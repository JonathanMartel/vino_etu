import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { Utilisateur } from '@interfaces/utilisateur';
import { EMPTY, empty, Observable, Subscription, throwError } from 'rxjs';
import { catchError, switchMap } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class AuthService {
    readonly VENDOR_PREFIX = "Kalimotxo:Vino:";
    readonly VAR_LS_UTILISATEUR = this.VENDOR_PREFIX +  "utilisateurActif";
    readonly VAR_LS_TOKEN = this.VENDOR_PREFIX +  "tokenActif";
    readonly VAR_LS_EXPIRATION = this.VENDOR_PREFIX +  "expirationToken";

    private utilisateurAuthentifie!: Utilisateur|null;
    private utilisateurToken!: string|null;

    // Durée de vie du token, en secondes
    private expirationEnSecondes: number = 3600; // 1 heure

    private url: string = "http://127.0.0.1:8000/api";
    // private url: string = "http://kalimotxo-vino.akira.dev/api";
    // private url: string = new URL(window.location.href).origin + "/api";

    constructor(
        private http: HttpClient,
        private router: Router,
        private snackBar: MatSnackBar,
    ) {
        // Vérifier s'il existe un utilisaeur déjà enregistré dans le localStorage et le charger dans le service dans le cas échéant.
        if(this.aUtilisateurDansLocalStorage()) {
            this.autoAuthentificationLocalStorage();
        };
    }

    /**
     *
     * Vérifier l'existence d'un utilisateur dans le localStorage
     *
     * @returns {boolean}
     */
    private aUtilisateurDansLocalStorage(): any {
        const estAuthentifie = localStorage.getItem(this.VAR_LS_UTILISATEUR) &&
        localStorage.getItem(this.VAR_LS_TOKEN) &&
        localStorage.getItem(this.VAR_LS_EXPIRATION)

        return estAuthentifie;
    }

    /**
     *
     * Vérifier si le token est expiré à l'aide de la date d'expiration du localStorage.
     *
     * @returns {boolean}
     *
     */
    private tokenEstExpire(): any {
        const expiration = new Date(localStorage.getItem(this.VAR_LS_EXPIRATION) as string);

        if(!expiration) {
            return true;
        }

        const maintenant =  new Date();

        console.log(maintenant > expiration);
        return maintenant > expiration;
    }

    /**
     *
     * Authentifier l'utilisateur dans l'application et persister les données pertinentes dans le localStorage
     *
     * @param {Object} data Objet comportant les données sur l'utilisateur ainsi que le token d'authentification
     * @returns {Subscription}
     *
     */
    connexion(data: any): Subscription {
        return this.http.post<any>(
            this.url + '/connection',
            data
        ).pipe(
            catchError(
                (error) => {
                    this.snackBar.open(error.error.message, "Fermer", { duration: 3000, panelClass: 'notif-danger' });
                    return EMPTY;
                })
        ).subscribe(
            (data) => {
                this.setUtilisateurActif(data.utilisateur, data.token);
                this.enregistrerUtilisateurLocalStorage(data.utilisateur, data.token);
                this.snackBar.open(
                    `Salut, ${this.getPrenomUtilisateurAuthentifie()} ! Heureux de vous revoir`,
                    "Fermer",
                    { duration: 3000, panelClass: 'notif' }
                );
                this.router.navigate(['/']);
            },

        );
    }

    /**
     *
     * Automatiquement authentifié l'utilisateur au service à partir du localStorage, si le token n'est pas expiré
     *
     */
    private autoAuthentificationLocalStorage(): void {
        // Vérifier si le token est expiré et réinitialiser toutes les variables du localStorage si c'est le cas.
        if(this.tokenEstExpire()) {
            this.reinitialiserUtilisateurLocalStorage();
            return;
        }

        this.utilisateurAuthentifie = JSON.parse(localStorage.getItem(this.VAR_LS_UTILISATEUR) as string);
        this.utilisateurToken = localStorage.getItem(this.VAR_LS_TOKEN);
    }

    /**
     *
     * Charger l'utilisateur authentifié dans le service
     *
     * @param {Utilisateur} utilisateur Infos sur l'utilisateur
     * @param {string} token Token d'Authentification auprès du serveur
     *
     */
    private setUtilisateurActif(utilisateur: Utilisateur, token: string): void {
        this.utilisateurAuthentifie = utilisateur;
        this.utilisateurToken = token;
    }

    /**
     *
     * Charger l'utilisateur authentifié ainsi qu'un délai d'expiration dans le localStorage afin de faire persister l'utilisateur à travers les rafraichissements et fermetures d'onglet / fenêtre
     *
     * @param utilisateur
     * @param token
     */
    enregistrerUtilisateurLocalStorage(utilisateur: Utilisateur, token: string) {
        const maintenant: Date = new Date();

        const expiration = new Date(maintenant.getTime() + (this.expirationEnSecondes * 1000));

        localStorage.setItem(
            this.VAR_LS_UTILISATEUR,
            JSON.stringify(utilisateur)
        )
        localStorage.setItem(
            this.VAR_LS_TOKEN,
            token
        )
        localStorage.setItem(
            this.VAR_LS_EXPIRATION,
            expiration.toString()
        )
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
                (data) => {
                    this.reinitialiserUtilisateurActif();
                    this.reinitialiserUtilisateurLocalStorage();
                    console.log(this.utilisateurAuthentifie);
                    return data;
                },
                (error) => {
                    return error;
                }
            );
    }

    /**
     *
     * Détruire les données de l'utilisateur actif du service afin de le déconnecter de la session
     *
     */
     reinitialiserUtilisateurActif() {
        this.utilisateurAuthentifie = null;
        this.utilisateurToken = null;
    }


    /**
     *
     * Détruire les données de l'utilisateur actif du localStorage afin de le déconnecter de la session
     *
     */
     reinitialiserUtilisateurLocalStorage() {
        localStorage.removeItem(this.VAR_LS_UTILISATEUR);
        localStorage.removeItem(this.VAR_LS_TOKEN);
        localStorage.removeItem(this.VAR_LS_EXPIRATION);
    }


    /**
     *
     * Véfirier s'il y a un quelconque utilisateur d'authentifié sur le service
     *
     * @returns {boolean}
     */
    estAuthentifie(): boolean {
        return this.utilisateurToken ? true : false;
    }

    /**
     *
     * Récupérer l'id de l'utilisateur actif du service, retourne false si il n'y a pas d'utilisateur actif.
     *
     * @returns {number/null}
     */
    getIdUtilisateurAuthentifie(): number|null {
        return (this.utilisateurAuthentifie) ? this.utilisateurAuthentifie.id : null;
    }

     /**
     *
     * Récupérer le prénom de l'utilisateur actif du service, retourne false si il n'y a pas d'utilisateur actif.
     *
     * @returns {string/null}
     */
    getPrenomUtilisateurAuthentifie(): string|null {
        return (this.utilisateurAuthentifie) ?
            this.utilisateurAuthentifie.first_name :
            null;
    }

    /**
     *
     * Récupérer le token de l'utilisateur actif du service, retourne false si il n'y a pas d'utilisateur actif.
     *
     * @returns {string|false}
     */
    getToken(): string|false {
        return (this.utilisateurToken) ?
            this.utilisateurToken :
            false;
    }


}
