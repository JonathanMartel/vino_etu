import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  utilisateurAuthentifie!:string;
  utilisateurToken!:string;

  
  private url:string = "http://127.0.0.1:8000/api";

  constructor(private http: HttpClient) { }

  connexion(data:any) {
    return this.http.post<any>(this.url + '/connection', data).subscribe( data => {
      this.utilisateurAuthentifie = data.utilisateur;
      this.utilisateurToken = data.token;
    });
  }

}
