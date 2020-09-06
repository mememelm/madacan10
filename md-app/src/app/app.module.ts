import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { MatCardModule } from '@angular/material/card';
import { MatIconModule } from '@angular/material/icon';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatButtonModule } from '@angular/material/button';
import { MatToolbarModule } from '@angular/material/toolbar'
import { MatSelectModule } from '@angular/material/select';
import { MatListModule } from '@angular/material/list';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatDialogModule } from '@angular/material/dialog';

import { HomeComponent } from './application/home/home.component';
import { ConnexionComponent } from './application/connexion/connexion.component';
import { DoingComponent } from './application/doing/doing.component';
import { ExerciseComponent } from './application/exercise/exercise.component';
import { FormationComponent } from './application/formation/formation.component';
import { LessonComponent } from './application/lesson/lesson.component';
import { SupportComponent } from './application/modal/support/support.component';
import { EvaluationComponent } from './application/modal/evaluation/evaluation.component';
import { HeaderComponent } from './application/header/header.component';

// import { VgCoreModule } from 'videogular2/compiled/core';
// import { VgControlsModule } from 'videogular2/compiled/controls';
// import { VgOverlayPlayModule } from 'videogular2/compiled/overlay-play';
// import { VgBufferingModule } from 'videogular2/compiled/buffering';

import { MatVideoModule } from 'mat-video';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    ConnexionComponent,
    DoingComponent,
    ExerciseComponent,
    FormationComponent,
    LessonComponent,
    SupportComponent,
    EvaluationComponent,
    HeaderComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatCardModule,
    MatIconModule,
    MatFormFieldModule,
    MatButtonModule,
    MatToolbarModule,
    MatSelectModule,
    MatListModule,
    MatExpansionModule,
    MatDialogModule,
    // VgCoreModule,
    // VgControlsModule,
    // VgOverlayPlayModule,
    // VgBufferingModule
    MatVideoModule
  ],
  providers: [],
  bootstrap: [AppComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class AppModule { }
