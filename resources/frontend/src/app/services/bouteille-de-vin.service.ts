import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class BouteilleDeVinService {

  private url:string = "http://127.0.0.1:8000/api";

  constructor(private http: HttpClient) { }

  getCellier(){

    return this.http.get(this.url+'/celliers');

  }

  getBouteillesCellier(){
    return this.http.get<any>(this.url + '/celliers/' + 1 + '/bouteilles');
  }

  getListeBouteille(){

    return this.http.get<any>(this.url+'/catalogue-bouteilles');
  }

  getBouteilleParId(id_bouteille:any){

    return this.http.get<any>(this.url + '/bouteilles/' + id_bouteille);
  }

  ajoutBouteilleCellier(bouteille_id:any){

    let body = {
      'celliers_id': 1,
      'bouteilles_id': bouteille_id,
      'inventaire': 1,
    }

    return this.http.post<any>(this.url +'/celliers/' + 1 + '/bouteilles', body);

  }
}


