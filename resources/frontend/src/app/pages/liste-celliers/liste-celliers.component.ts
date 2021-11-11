import { Component, OnInit } from '@angular/core';
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-liste-celliers',
  templateUrl: './liste-celliers.component.html',
  styleUrls: ['./liste-celliers.component.scss']
})
export class ListeCelliersComponent implements OnInit {

  listeCelliers!: any[];
    idUser: any;

  constructor(private servBouteilleDeVin: BouteilleDeVinService,
    private authService: AuthService,) { }

  ngOnInit(): void {

    //console.log("init");

        // Charger la liste des celliers de l'utilisateur.
        this.servBouteilleDeVin.getListeCelliersParUtilisateur(this.authService.getIdUtilisateurAuthentifie())
            .subscribe((data: any) => {
                this.listeCelliers = data;
            })
    }
  

}
