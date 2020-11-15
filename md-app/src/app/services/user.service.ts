import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { environment } from '../../environments/environment'
import { Router } from "@angular/router";
import { NgxSpinnerService } from "ngx-spinner";

@Injectable({
  providedIn: 'root'
})
export class UserService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient,
    private router: Router,
    public spinner: NgxSpinnerService
  ) { }

  // POST FORM DATA 
  public postDataWithFormData(email, password) {

    this.spinner.show()

    const formData = new FormData()
    formData.append('email', email)
    formData.append('password', password)

    this.httpClient.post<any>(this.api + 'login_check', formData)
      .subscribe((res: any) => {
        
        if (res.code == 401) {
          console.log('ERREUR CONNEXION')
          this.spinner.hide()
        } else {          
          console.log(res)
          let currentUser = []
          let userData = {
            email: res.data.email,
            firstname: res.data.firstName,
            lastname: res.data.lastName,
            avatar: res.data.avatar
          }
          currentUser.push(userData)
          localStorage.setItem('currentUser', JSON.stringify(userData))
          localStorage.setItem('userId', res.data.id)
          localStorage.setItem('token', res.data.token)
          this.router.navigateByUrl('home')
          this.spinner.hide()
        }
      })
  }
}
