import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { Question } from "../constant/question";

@Injectable({
  providedIn: 'root'
})
export class QuestionService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient
  ) { }

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  }

  public getQuestionByModule(data): Observable<Question> {
    return this.httpClient.post<Question>(
      this.api + 'questions/get',
      JSON.stringify(data),
      this.httpOptions
    )
    .pipe(retry(1), catchError(this.handleError))
  }

  public handleError(error) {
    let errorMessage = '';
    if (error.error instanceof ErrorEvent) {
      errorMessage = error.error.message;
    } else {
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    console.log(['Erreur HTTP', errorMessage]);
    return throwError(errorMessage);
  }
}
