import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { EvaluationService } from 'src/app/services/evaluation.service';
import { Subject } from "rxjs";
import { DatatableLanguage } from "../../constant/datatable-language";
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-evaluation',
  templateUrl: './evaluation.component.html',
  styleUrls: ['./evaluation.component.css']
})
export class EvaluationComponent implements OnInit {

  public dtOptions: any = {}
  public dtTigger = new Subject()
  public listEvaluation: any = []

  public totalPoint: any
  public pourcentPoint: any
  public formation: any

  // variable view
  public resultSuccess: any
  public showLastResult: any

  constructor(
    private router: Router,
    private evaluationService: EvaluationService,
    private spinner: NgxSpinnerService
  ) {
    this.showLastResult = false
  }

  ngOnInit(): void {

    this.spinner.show()

    this.dtOptions = {
      language: DatatableLanguage.french
    }

    this.loadEvaluationByUser()

    this.formation = localStorage.getItem('currentFormation')
    let result = localStorage.getItem('resultEvaluation')
    let evaluationState = localStorage.getItem('evaluationState')

    if (evaluationState == 'result') {
      this.showLastResult = true
      if (result == 'OK') {
        this.resultSuccess = true
      } else {
        this.resultSuccess = false
      }
      this.totalPoint = localStorage.getItem('totalPoint')
      let maxPoint: any = localStorage.getItem('totalQuestion')
      

      this.pourcentPoint = ((this.totalPoint / maxPoint) * 100).toFixed(2)
    } else {
      this.showLastResult = false
    }
  }

  /**
   * loadEvaluation
   */
  public loadEvaluationByUser() {
    let body = {
      userId: localStorage.getItem('userId')
    }
    this.evaluationService.getEvaluationByUser(body)
      .subscribe((res: any) => {
        this.listEvaluation = res.data
        
        this.dtTigger.next()
        this.spinner.hide()
      })
  }

  /**
   * route
   */
  public route(route) {
    this.router.navigateByUrl(route)
  }

}
