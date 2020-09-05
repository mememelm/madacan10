import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit {

  constructor(
    private router: Router,
  ) { }

  ngOnInit(): void {
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