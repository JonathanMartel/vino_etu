import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AccueilComponent } from './pages/accueil/accueil.component';
import { CellierComponent } from '@pages/cellier/cellier.component';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { HttpClientModule } from '@angular/common/http';
import { EnteteComponent } from './components/entete/entete.component';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatIconModule } from '@angular/material/icon';
import { MenuMobileComponent } from './components/menu-mobile/menu-mobile.component';
import { ListeBouteilleComponent } from '@pages/liste-bouteille/liste-bouteille.component';
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';
import { ConnectionComponent } from '@pages/connection/connection.component';
import { CreerCompteComponent } from '@pages/creer-compte/creer-compte.component';
import { BouteilleResolverServiceService } from '@services/bouteille-resolver-service.service';
import { FicheBouteilleComponent } from './pages/fiche-bouteille/fiche-bouteille.component';
import { MatButtonModule } from '@angular/material/button';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { CellierBouteilleComponent } from './components/cellier-bouteille/cellier-bouteille.component';
import { ReactiveFormsModule } from '@angular/forms';
import { MatCardModule } from '@angular/material/card';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { ModifierCellierBouteilleComponent } from './pages/modifier-cellier-bouteille/modifier-cellier-bouteille.component';
import {MatSidenavModule} from '@angular/material/sidenav';
import {MatRadioModule} from '@angular/material/radio';





@NgModule({
    declarations: [
        AppComponent,
        AccueilComponent,
        CellierComponent,
        EnteteComponent,
        MenuMobileComponent,
        ListeBouteilleComponent,
        AjoutBouteilleComponent,
        ConnectionComponent,
        CreerCompteComponent,
        FicheBouteilleComponent,
        CellierBouteilleComponent,
        ModifierCellierBouteilleComponent,
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        HttpClientModule,
        MatToolbarModule,
        MatIconModule,
        MatButtonModule,
        MatFormFieldModule,
        MatInputModule,
        ReactiveFormsModule,
        MatCardModule,
        MatSnackBarModule,
        MatSidenavModule,
        MatRadioModule,
        
    ],
    providers: [BouteilleDeVinService, BouteilleResolverServiceService],
    bootstrap: [AppComponent]
})
export class AppModule { }
