import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from "../../services/api/api.service";

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit {

  userId : any

  constructor(
    private router: Router,
    private apiService: ApiService
  ) { }

  ngOnInit(): void {
    let user = JSON.parse(localStorage.getItem('currentUser')) 
    this.userId = user.userId
    console.log('===> id', this.userId)
    let body = {
      id: this.userId
    }
    setTimeout(() => {
      this.apiService.postDataWithToken(body, 'formations/get').subscribe(res => console.log(res))
    },1000)   
  }

  exerciseRoute() {
    this.router.navigateByUrl('exercise')
  }

  lessonRoute() {
    this.router.navigateByUrl('lesson')
  }

  logout() {
    sessionStorage.clear()
    this.router.navigateByUrl('connexion')
  }
}