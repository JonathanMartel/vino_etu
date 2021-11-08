import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

    utilisateurAuthentifie!: object;
    utilisateurToken!: string;


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

    set utilisateur(utilisateur: object) {
        this.utilisateurAuthentifie = utilisateur;
    }

    set token(token: string) {
        this.utilisateurToken = token;
    }
}