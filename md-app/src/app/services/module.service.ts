import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Module } from "../constant/module";
import { environment } from '../../environments/environment'
import { retry, catchError } from 'rxjs/operators';
import { Observable, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ModuleService {

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
  public getModuleByFormation(data): Observable<Module> {
    return this.httpClient
      .post<Module>(
        this.api + 'modules/get',
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
