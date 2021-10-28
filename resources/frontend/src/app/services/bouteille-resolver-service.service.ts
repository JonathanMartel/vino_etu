import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, Resolve, RouterStateSnapshot } from '@angular/router';
import { BouteilleDeVinService } from './bouteille-de-vin.service';

@Injectable({
  providedIn: 'root'
})
export class BouteilleResolverServiceService implements Resolve<any>{


  constructor(
    private servBouteilleDeVin:BouteilleDeVinService,
    ) { }

  resolve( route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {

    let bouteilleId = route.paramMap.get('id');

    console.log(route.paramMap);


    return this.servBouteilleDeVin.getBouteilleParId(bouteilleId);
  }
}
