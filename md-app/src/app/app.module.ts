import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { HomeComponent } from './application/home/home.component';
import { ConnexionComponent } from './application/connexion/connexion.component';
import { DoingComponent } from './application/doing/doing.component';
import { ExerciseComponent } from './application/exercise/exercise.component';
import { FormationComponent } from './application/formation/formation.component';
import { LessonComponent } from './application/lesson/lesson.component';
import { SupportComponent } from './application/modal/support/support.component';
import { EvaluationComponent } from './application/modal/evaluation/evaluation.component';

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
    EvaluationComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule
  ],
  providers: [],
  bootstrap: [AppComponent],
  schemas: [ CUSTOM_ELEMENTS_SCHEMA ]
})
export class AppModule { }
