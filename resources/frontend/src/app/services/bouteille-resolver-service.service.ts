import { Injectable } from '@angular/core';
import { ActivatedRoute, ActivatedRouteSnapshot, Resolve, RouterState, RouterStateSnapshot } from '@angular/router';
import { map } from 'rxjs/operators';
import { BouteilleDeVinService } from './bouteille-de-vin.service';

@Injectable({
    providedIn: 'root'
})
export class BouteilleResolverServiceService implements Resolve<any>{

    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
    ) { }

    resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {

        let bouteilleId = route.paramMap.get('id');

        return this.servBouteilleDeVin.getBouteilleParId(bouteilleId)
            .pipe(
                map(data => {
                    return data.data;
                })
            );
    }
}
