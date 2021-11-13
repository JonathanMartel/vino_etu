import { LOCALE_ID, NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AccueilComponent } from './pages/accueil/accueil.component';
import { CellierComponent } from '@pages/cellier/cellier.component';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
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
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { MatCardModule } from '@angular/material/card';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { ModifierCellierBouteilleComponent } from './pages/modifier-cellier-bouteille/modifier-cellier-bouteille.component';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatDialogModule } from '@angular/material/dialog';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatConfirmDialogComponent } from './components/mat-confirm-dialog/mat-confirm-dialog.component';
import { MatSelectModule } from '@angular/material/select'
import { ListeCelliersComponent } from './pages/liste-celliers/liste-celliers.component';
import { AjoutCellierComponent } from './pages/ajout-cellier/ajout-cellier.component'
import { TokenInterceptor } from './token.interceptor';
import { BouteillesCellierResolver } from '@services/bouteilles-cellier.resolver';
import { DatePipe, registerLocaleData } from '@angular/common';
import localeFrCa from "@angular/common/locales/fr-CA"
import { StringHelpersService } from '@services/helpers/string-helpers.service';

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
        MatConfirmDialogComponent,
        ListeCelliersComponent,
        AjoutCellierComponent,

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
        MatDialogModule,
        MatExpansionModule,
        MatSelectModule,
        FormsModule,
    ],
    providers: [
        BouteilleDeVinService,
        BouteilleResolverServiceService,
        BouteillesCellierResolver,
        {
            provide: HTTP_INTERCEPTORS,
            useClass: TokenInterceptor,
            multi: true,
        },
        DatePipe,
        StringHelpersService,
    ],
    bootstrap: [AppComponent],
    entryComponents:[MatConfirmDialogComponent],
})
export class AppModule {
    constructor() {
        registerLocaleData(localeFrCa);
    }
}