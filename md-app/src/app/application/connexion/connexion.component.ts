import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from "../../services/api/api.service";
import { of } from 'rxjs'

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent implements OnInit {

  public email: any
  public password: any

  constructor(
    private router: Router,
    private apiService: ApiService) { }

  ngOnInit(): void {
  }

  public connexion() {
    this.apiService.postDataWithFormData('login_check', this.email, this.password)
  }
}
