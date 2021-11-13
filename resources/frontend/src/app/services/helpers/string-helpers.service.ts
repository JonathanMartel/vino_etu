import { formatCurrency } from '@angular/common';
import { Injectable } from '@angular/core';

@Injectable({
    providedIn: 'root'
})
export class StringHelpersService {

    constructor() { }

    /**
     *
     * Transformer un nombre en devise canadienne
     *
     * @param {number} nombre Nombre à formatter en dollars canadiens
     * @returns {string}
     */
    formaterNombreEnDollarsCanadiens(nombre: number): string {
        return formatCurrency(nombre, "fr-CA", "$");
    }

    recupererNombreDeDevise(chaine: string): number {
        return +(chaine.replace(",", ".").replace(/[^\d\.]/g, ""));
    }
}
