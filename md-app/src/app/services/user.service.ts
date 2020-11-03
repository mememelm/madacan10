import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from '../../environments/environment'
import { Router } from "@angular/router";


@Injectable({
  providedIn: 'root'
})
export class UserService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient,
    public router: Router
  ) { }

  // POST FORM DATA 
  postDataWithFormData(file, email, password) {
    const formData = new FormData()
    formData.append('email', email)
    formData.append('password', password)
    console.log(formData)
    this.httpClient.post<any>(this.api + file, formData)
      .subscribe((res) => {
        if (res) {
          console.log(res)
          let currentUser = []
          let userData = {
            email: res.data.email,
            firstname: res.data.firstName,
            lastname: res.data.lastName
          }
          currentUser.push(userData)
          localStorage.setItem('currentUser', JSON.stringify(userData))
          localStorage.setItem('userId', res.data.id)
          localStorage.setItem('token', res.data.token)
          this.router.navigateByUrl('home')
        } else {
          console.log('ERREUR CONNEXION')
        }
      })
  }
}