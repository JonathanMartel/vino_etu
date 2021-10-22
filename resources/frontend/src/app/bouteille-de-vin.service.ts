import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class BouteilleDeVinService {

  private url:string = "http://127.0.0.1:8000/api/cellier";

  constructor(private http: HttpClient) { }

  getCellier(){
    console.log("super fetch!!!!!!");
    return this.http.get(this.url);
    
  }
}


