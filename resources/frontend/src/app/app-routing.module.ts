import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AccueilComponent } from '@pages/accueil/accueil.component';
import { CellierComponent } from '@pages/cellier/cellier.component';
import { ListeBouteilleComponent } from '@pages/liste-bouteille/liste-bouteille.component';
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';
import { ConnectionComponent } from '@pages/connection/connection.component';
import { CreerCompteComponent } from '@pages/creer-compte/creer-compte.component';

const routes: Routes = [
    {path:"", component:AccueilComponent},
    {path:"cellier", component:CellierComponent},
    {path:"bouteilles", component:ListeBouteilleComponent},
    {path:"ajout", component:AjoutBouteilleComponent},
    {path:"connection", component:ConnectionComponent},
    {path:"creerCompte", component:CreerCompteComponent},
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})

export class AppRoutingModule { }
