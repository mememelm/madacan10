import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ConnexionComponent } from './application/connexion/connexion.component';
import { EvaluationComponent } from './application/evaluation/evaluation.component';
import { HomeComponent } from "./application/home/home.component";

const routes: Routes = [
  { path: '', redirectTo: 'connexion', pathMatch: 'full' },
  { path: 'connexion', component: ConnexionComponent },
  { path: 'home', component: HomeComponent },
  { path: 'evaluation', component: EvaluationComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
