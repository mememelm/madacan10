import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from "../../services/";

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
  }

  public connexion() {
    this.userService.postDataWithFormData('login_check', this.email, this.password)
  }
}
