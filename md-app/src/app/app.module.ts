import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA, LOCALE_ID } from '@angular/core';
import { FormsModule } from "@angular/forms";

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

// heure française + LOCAL_ID
import { registerLocaleData } from "@angular/common";
import localeFr from '@angular/common/locales/fr';
import localeFrExtra from '@angular/common/locales/extra/fr';
registerLocaleData(localeFr, 'fr-FR', localeFrExtra);

// services
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { TokenInterceptor } from './services';

// cmp
import { ConnexionComponent } from './application/connexion/connexion.component';
import { EvaluationComponent } from './application/evaluation/evaluation.component';
import { HomeComponent } from './application/navigation-content/home/home.component';
import { FormationComponent } from "./application/formation/formation.component";
import { CourseComponent } from './application/course/course.component';
import { MenuComponent } from './application/navigation-content/menu/menu.component';
import { ModuleComponent } from './application/module/module.component';
import { HeaderComponent } from './application/navigation-content/header/header.component';

// MODULE
import { NgxSpinnerModule } from 'ngx-spinner';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgxDocViewerModule } from "ngx-doc-viewer";
import { DataTablesModule } from 'angular-datatables';
import { ToastrModule } from "ngx-toastr";

@NgModule({
  declarations: [
    AppComponent,
    ConnexionComponent,
    EvaluationComponent,
    HomeComponent,
    FormationComponent,
    CourseComponent,
    MenuComponent,
    ModuleComponent,
    HeaderComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    HttpClientModule,
    FormsModule,
    NgxSpinnerModule,
    NgbModule,
    NgxDocViewerModule,
    DataTablesModule,
    ToastrModule.forRoot()
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: TokenInterceptor,
      multi: true,
    },
    { provide: LOCALE_ID, useValue: 'fr-FR' }
  ],
  bootstrap: [AppComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class AppModule { }
