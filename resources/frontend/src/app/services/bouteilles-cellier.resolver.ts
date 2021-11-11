import { Injectable } from '@angular/core';
import {
    Router,
    Resolve,
    RouterStateSnapshot,
    ActivatedRouteSnapshot
} from '@angular/router';
import { Observable, of } from 'rxjs';
import { map } from 'rxjs/operators';
import { BouteilleDeVinService } from './bouteille-de-vin.service';

@Injectable({
    providedIn: 'root'
})
export class BouteillesCellierResolver implements Resolve<boolean> {
    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
    ) {

    }

    resolve(
        route: ActivatedRouteSnapshot,
        state: RouterStateSnapshot): Observable<boolean> {

        let cellierId: number|string|null = route.paramMap.get('id');

        if(cellierId !== null) {
            cellierId = +(cellierId);
        }

        return this.servBouteilleDeVin.getBouteillesParCellier(cellierId)
            .pipe(
                map(data => {
                    console.log(data);
                    return data.data;
                })
            );


    }
}
