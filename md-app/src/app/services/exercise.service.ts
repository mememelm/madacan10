import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Exercise } from '../constant/exercise';
import { environment } from '../../environments/environment';
import { retry, catchError } from 'rxjs/operators';
import { identity, Observable, throwError } from 'rxjs';
import { identifierName } from '@angular/compiler';

@Injectable({
  providedIn: 'root'
})
export class ExerciseService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient
  ) { }

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
    }),
  }

  /**
   * createExercise
   */
  public createExercise(data): Observable<Exercise> {
    return this.httpClient
      .post<Exercise>(
        this.api + 'exercises/create',
        JSON.stringify(data),
        this.httpOptions
      )
      .pipe(retry(1), catchError(this.handleError))
  }

  /**
   * getExerciseByUser
   */
  public getExerciseByUser(data): Observable<Exercise> {
    return this.httpClient
      .post<Exercise>(
        this.api + 'exercises/findby-user',
        JSON.stringify(data),
        this.httpOptions
      )
      .pipe(retry(1), catchError(this.handleError))
  }

  /**
   * getExerciseByUserByModule
   */
  public getExerciseByUserByModule(data): Observable<Exercise> {
    return this.httpClient
      .post<Exercise>(
        this.api + 'exercises/findby-user-bymodule',
        JSON.stringify(data),
        this.httpOptions
      )
      .pipe(retry(1), catchError(this.handleError))
  }

  /**
   * updateExerciseByUser
   */
  public updateExerciseByUser(data, id): Observable<Exercise> {
    return this.httpClient
      .post<Exercise>(
        this.api + 'exercises/update/' + id,
        JSON.stringify(data),
        this.httpOptions
      )
      .pipe(retry(1), catchError(this.handleError))
  }

  // Error handling
  public handleError(error) {
    let errorMessage = ''
    if (error.error instanceof ErrorEvent) {
      errorMessage = error.error.message
    } else {
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`
    }
    console.log(['Erreur HTTP', errorMessage])
    return throwError(errorMessage)
  }
}
