import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Evaluation } from "../constant/evaluation";
import { environment } from '../../environments/environment'
import { retry, catchError } from 'rxjs/operators';
import { Observable, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EvaluationService {

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
  public pushUserEvaluation(data): Observable<Evaluation> {
    return this.httpClient.post<Evaluation>(
      this.api + 'evaluations/create',
      JSON.stringify(data),
      this.httpOptions
    ).pipe(retry(1), catchError(this.handleError))
  }

  /**
   * getEvaluationByUser
   */
  public getEvaluationByUser(data): Observable<Evaluation> {
    return this.httpClient.post<Evaluation>(
      this.api + 'evaluations/get',
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
