import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';

@Injectable({
    providedIn: 'root'
})
export class BouteilleDeVinService {

    private url:string = "http://127.0.0.1:8000/api";
    // private url:string = "http://kalimotxo-vino.akira.dev/api";
    // private url: string = new URL(window.location.href).origin + "/api";

    constructor(private http: HttpClient) {
        console.log(this.url);
     }

    getBouteillesParCellier(filtres = {}) {

        return this.http.get<any>(
            this.url + '/celliers/' + 1 + '/bouteilles',
            {
                params: filtres
            }
        );
    }

    getBouteillesCellier(filtres = {}) {

        return this.http.get<any>(
            this.url + '/celliers/' + 1 + '/bouteilles',
            {
                params: filtres
            }
        );

    }

    getListeBouteille(filtres = {}) {
        /*filtres = {
            texteRecherche: "états"
        };*/


        return this.http.get<any>(this.url + '/catalogue-bouteilles', {
            params: filtres
        });
    }

    getBouteilleParId(id_bouteille: any) {

        return this.http.get<any>(this.url + '/bouteilles/' + id_bouteille);
    }

    getBouteilleAcheteeParId(id_bouteille: any) {

        return this.http.get<any>(this.url + '/bouteilles-achetees/' + id_bouteille);
    }

    ajoutBouteilleCellier(bouteilleAchetee: any) {
        return this.http.post<any>(this.url + '/celliers/' + 1 + '/bouteilles', bouteilleAchetee);

    }

    modifierInventaireCellierBouteille(bouteille_id: any, nouvelInventaire: any) {

        let body = {
            'inventaire': nouvelInventaire,
        }

        return this.http.put<any>(this.url + '/celliers/modifier-inventaire/' + bouteille_id, body)
    }


    modifierBouteilleCellier(bouteilleAchetee_id:any, data:any){

        return this.http.put<any>(this.url + '/bouteilles-achetees/' + bouteilleAchetee_id, data)

    }

    ajouterUtilisateur(data:any){

        let body = {
            'data': data,

        }
    }

}


