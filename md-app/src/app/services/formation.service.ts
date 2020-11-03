import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Formation } from "../constant/formation";
import { environment } from '../../environments/environment'
import { retry, catchError } from 'rxjs/operators';
import { Observable, throwError, forkJoin } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class FormationService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient
  ) { }

  // token = JSON.parse(localStorage.getItem('currentUser'))

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
      // 'Authorization': 'Bearer ' + this.token.token => JWT Token interceptor
    })
  }

  // GET Formation user
  public getFormationByUser(data): Observable<Formation> {
    return this.httpClient
      .post<Formation>(
        this.api + 'formations/get',
        JSON.stringify(data),
        this.httpOptions
      )
      .pipe(retry(1), catchError(this.handleError));
  }

  // Error handling
  public handleError(error) {
    let errorMessage = '';
    if (error.error instanceof ErrorEvent) {
      // Get client-side error
      errorMessage = error.error.message;
    } else {
      // Get server-side error
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    // window.alert(errorMessage);
    console.log(['Erreur HTTP', errorMessage]);
    return throwError(errorMessage);
  }
}
