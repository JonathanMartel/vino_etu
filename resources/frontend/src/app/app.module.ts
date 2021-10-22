import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AccueilComponent } from './accueil/accueil.component';
import { CellierComponent } from './cellier/cellier.component';
import { BouteilleDeVinService } from './bouteille-de-vin.service';
import { HttpClientModule } from '@angular/common/http';
import { EnteteComponent } from './entete/entete.component';
import {MatToolbarModule} from '@angular/material/toolbar';
import {MatIconModule} from '@angular/material/icon';
import { MenuMobileComponent } from './menu-mobile/menu-mobile.component';
import { ListeBouteilleComponent } from './liste-bouteille/liste-bouteille.component';


@NgModule({
  declarations: [
    AppComponent,
    AccueilComponent,
    CellierComponent,
    EnteteComponent,
    MenuMobileComponent,
    ListeBouteilleComponent
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
