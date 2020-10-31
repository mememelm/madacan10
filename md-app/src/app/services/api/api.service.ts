import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { map } from 'rxjs/operators'
import { Router } from '@angular/router';
import { retry, catchError } from 'rxjs/operators';
import { Observable, throwError, forkJoin } from 'rxjs';
import { Formation } from "../../constant/formation";
// import 'rxjs/add/operator/map';
// import 'rxjs/Rx';


@Injectable({
  providedIn: 'root'
})
export class ApiService {

  userToken: string

  public urlApi = "http://192.168.17.72/madacan/web/app_dev.php/api/"

  constructor(
    private httpClient: HttpClient,
    private router: Router
  ) {
    this.getToken()
  }

  // GET TOKEN
  public getToken() {
    let currentUser = JSON.parse(localStorage.getItem('currentUser'))
    console.log('currentUser', currentUser)
    if (currentUser.token) {
      this.userToken = currentUser.token
      console.log(this.userToken)
      console.log('Obtention token')
    } else {
      console.log('token doesn\'t exist')
    }
  }

  // ============================ DATA WITHOUT TOKEN =============================
  // GET DATA WITHOUT TOKEN
  public getData() {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json; charset=UTF-8'
    });
    const options = {
      headers: headers
    };
    let file: 'formations/get'
    return this.httpClient.get(this.urlApi + file, options)
  }

  // POST DATA WITHOUT TOKEN
  public postData(body, file) {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json; charset=UTF-8'
    });
    const options = {
      headers: headers
    };
    return this.httpClient.post(this.urlApi + file, JSON.stringify(body), options)
  }

  //  ============================ DATA WITH TOKEN ===============================
  // GET DATA WITH + TOKEN
  public getDataWithToken(file) {
    if (this.userToken === undefined) {
      this.getToken()

      setTimeout(() => {
        const headers = new HttpHeaders().set('Authorization', 'Bearer ' + this.userToken)
        const options = {
          headers: headers
        };
        console.log('here 1', this.userToken);
        return this.httpClient.get(this.urlApi + file, options)
          .subscribe((res) => {
            console.log(res)
          })
      })

    } else {
      const headers = new HttpHeaders().set('Authorization', 'Bearer ' + this.userToken)
      const options = {
        headers: headers
      };
      console.log('here 2', this.userToken);
      return this.httpClient.get(this.urlApi + file, options)
        .subscribe((res) => {
          console.log(res)
        })
    }
  }

  // POST DATA + TOKEN
  public postDataWithToken(body, file){

    if (this.userToken === undefined) {

      // get token
      this.getToken();
      setTimeout(() => {
        const headers = new HttpHeaders().set('Authorization', 'Bearer ' + this.userToken);
        const options = {
          headers: headers
        };
        console.log('header 1', [body, options]);
        return this.httpClient.post(this.urlApi + file, JSON.stringify(body), options).forEach(res => console.log(res))
      }, 2000);

    } else {
      const headers = new HttpHeaders().set('Authorization', 'Bearer ' + this.userToken);
      const options = {
        headers: headers
      };
      console.log('header 2', [body, options]);
      return this.httpClient.post<Formation>(this.urlApi + file, JSON.stringify(body), options)
    }
  }

  // POST FORM DATA 
  postDataWithFormData(file, email, password) {
    const formData = new FormData()
    formData.append('email', email)
    formData.append('password', password)
    console.log(formData)
    this.httpClient.post<any>(this.urlApi + file, formData)
      .subscribe((res) => {
        if (res) {
          console.log(res)
          let currentUser = []
          let userData = {
            userId: res.data.id,
            email: res.data.email,
            firstmane: res.data.firstName,
            lastname: res.data.lastName,
            token: res.data.token
          }
          currentUser.push(userData)
          localStorage.setItem('currentUser', JSON.stringify(userData))

          this.router.navigateByUrl('formation')
        } else {
          console.log('ERREUR CONNEXION')
        }        
      })
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
