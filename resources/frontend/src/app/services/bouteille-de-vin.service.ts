import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class BouteilleDeVinService {

  private url_cellier:string = "http://127.0.0.1:8000/api/cellier";
  private url_bouteille:string = "http://127.0.0.1:8000/api/catalogue-bouteilles";

  constructor(private http: HttpClient) { }

  getCellier(){

    return this.http.get(this.url_cellier);

  }

  getListeBouteille(){

    return this.http.get<any>(this.url_bouteille);
  }
}


