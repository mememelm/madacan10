import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Support } from "../constant/support";
import { environment } from '../../environments/environment'
import { retry, catchError } from 'rxjs/operators';
import { Observable, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SupportService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient
  ) { }

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  }

  /**
   * pushUserEvaluation
   */
  public getSupportModule(data): Observable<Support> {
    return this.httpClient.post<Support>(
      this.api + 'supports/get',
      JSON.stringify(data),
      this.httpOptions
    ).pipe(retry(1), catchError(this.handleError))
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
