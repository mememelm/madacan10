import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Formation } from "../constant/formation";
import { environment } from '../../environments/environment'
import { retry, catchError } from 'rxjs/operators';
import { Observable, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class FormationService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient
  ) { }

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
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
      errorMessage = error.error.message;
    } else {
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    
    return throwError(errorMessage);
  }
}
