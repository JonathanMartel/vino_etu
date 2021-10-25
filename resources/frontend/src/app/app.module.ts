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
import {MatToolbarModule} from '@angular/material/toolbar';
import {MatIconModule} from '@angular/material/icon';
import { MenuMobileComponent } from './components/menu-mobile/menu-mobile.component';
import { ListeBouteilleComponent } from '@pages/liste-bouteille/liste-bouteille.component';
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';


@NgModule({
  declarations: [
    AppComponent,
    AccueilComponent,
    CellierComponent,
    EnteteComponent,
    MenuMobileComponent,
    ListeBouteilleComponent,
    AjoutBouteilleComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    HttpClientModule,
    MatToolbarModule,
    MatIconModule,
  ],
  providers: [BouteilleDeVinService],
  bootstrap: [AppComponent]
})
export class AppModule { }