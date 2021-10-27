import { Injectable } from '@angular/core';
import { ActivatedRoute, ActivatedRouteSnapshot, Resolve, RouterState, RouterStateSnapshot } from '@angular/router';
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
