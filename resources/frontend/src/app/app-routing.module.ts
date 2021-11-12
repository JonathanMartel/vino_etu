import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AccueilComponent } from '@pages/accueil/accueil.component';
import { CellierComponent } from '@pages/cellier/cellier.component';
import { ListeBouteilleComponent } from '@pages/liste-bouteille/liste-bouteille.component';
import { ListeCelliersComponent } from './pages/liste-celliers/liste-celliers.component'
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';
import { ConnectionComponent } from '@pages/connection/connection.component';
import { CreerCompteComponent } from '@pages/creer-compte/creer-compte.component';
import { FicheBouteilleComponent } from '@pages/fiche-bouteille/fiche-bouteille.component';
import { BouteilleResolverServiceService } from '@services/bouteille-resolver-service.service';
import { ModifierCellierBouteilleComponent } from '@pages/modifier-cellier-bouteille/modifier-cellier-bouteille.component';
import { ProfilUtilisateurComponent } from '@pages/profil-utilisateur/profil-utilisateur.component';
import { AuthGuard } from "@services/auth.guard";
import { BouteillesCellierResolver } from '@services/bouteilles-cellier.resolver';

const routes: Routes = [
    {
        path: "",
        component: AccueilComponent,
        canActivate: [AuthGuard],
    },
    {
        path: "celliers/:id",
        component: CellierComponent,
        canActivate: [AuthGuard],
        resolve: {
            bouteillesCellier: BouteillesCellierResolver
        }
    },
    {
        path: "bouteilles",
        component: ListeBouteilleComponent,
    },
    {
        path: "celliers",
        component: ListeCelliersComponent,
        canActivate: [AuthGuard],
    },
    {
        path: "profil",
        component: ProfilUtilisateurComponent,
        canActivate: [AuthGuard],
    },
    {
        path: "bouteilles/ajout",
        component: AjoutBouteilleComponent,
        canActivate: [AuthGuard],
    },
    {
        path: "bouteilles-achetees/:id/modifier",
        component: ModifierCellierBouteilleComponent,
        canActivate: [AuthGuard],
    },
    { path: "connection", component: ConnectionComponent },
    { path: "creerCompte", component: CreerCompteComponent },
    {
        path: "ficheBouteille/:id",
        component: FicheBouteilleComponent,
        resolve: {
            bouteille: BouteilleResolverServiceService
        }
    },
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})

export class AppRoutingModule { }
