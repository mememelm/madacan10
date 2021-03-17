import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { environment } from '../../environments/environment'
import { Router } from "@angular/router";
import { NgxSpinnerService } from "ngx-spinner";
import { ToastrService } from 'ngx-toastr';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  public api = environment.urlApi

  constructor(
    private httpClient: HttpClient,
    private router: Router,
    private spinner: NgxSpinnerService,
    private toastr: ToastrService
  ) { }

  // POST FORM DATA 
  public login(email, password) {
    let alert = true
    this.spinner.show()

    const formData = new FormData()
    formData.append('email', email)
    formData.append('password', password)

    this.httpClient.post<any>(this.api + 'login_check', formData)
      .subscribe((res: any) => {
        if (res.code == 401) {
          this.spinner.hide()
          this.toastr.error('Email ou mot de passe incorrect.')
        }
        if (res.data) {
          alert = false
          let currentUser = []
          let userData = {
            email: res.data.email,
            firstname: res.data.firstName,
            lastname: res.data.lastName,
            avatar: res.data.avatar,
            codePostal: res.data.code_postal,
            country: res.data.country,
            phone: res.data.phone,
            dob: res.data.dob,
            pob: res.data.pob,
            sexe: res.data.sexe,
            town: res.data.ville
          }
          currentUser.push(userData)
          localStorage.setItem('currentUser', JSON.stringify(userData))
          localStorage.setItem('userId', res.data.id)
          localStorage.setItem('token', res.data.token)
          this.router.navigateByUrl('home')
          this.spinner.hide()
        }
      })

    setTimeout(() => {
      this.spinner.hide()
      if (alert == true) {
        this.toastr.error('Email ou mot de passe incorrect.')
      }
    }, 6000)
  }
}
