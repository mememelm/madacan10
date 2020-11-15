import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-evaluation',
  templateUrl: './evaluation.component.html',
  styleUrls: ['./evaluation.component.css']
})
export class EvaluationComponent implements OnInit {

  public totalPoint: any
  public pourcentPoint: any

  public resultSuccess: any

  constructor() { }

  ngOnInit(): void {
    let result= localStorage.getItem('resultEvaluation')
    if (result == 'OK') {
      this.resultSuccess = true
    } else {
      this.resultSuccess = false
    }
    this.totalPoint = localStorage.getItem('totalPoint')
    let maxPoint: any = localStorage.getItem('totalQuestion')
    console.log('BASE EVALUATION', [this.totalPoint, maxPoint])

    this.pourcentPoint = (this.totalPoint/maxPoint)*100
  }

}
