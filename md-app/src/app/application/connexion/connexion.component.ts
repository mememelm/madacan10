import { Component, OnInit } from '@angular/core';
import { UserService } from "../../services/";
// import * as screenfull from 'screenfull';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent implements OnInit {

  public email: any
  public password: any

  constructor(
    private userService: UserService
  ) { }

  ngOnInit(): void {

    // if (screenfull.isEnabled) {
    //   screenfull.request()
    // }

    localStorage.clear()
  }

  public connexion() {
    this.userService.spinner
    this.userService.postDataWithFormData(this.email, this.password)
  }
}
