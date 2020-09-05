import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-exercise',
  templateUrl: './exercise.component.html',
  styleUrls: ['./exercise.component.css']
})
export class ExerciseComponent implements OnInit {

  constructor(private router: Router) { }

  ngOnInit(): void {
  }

  public closeExercise() {
    this.router.navigateByUrl('formation')
  }
}