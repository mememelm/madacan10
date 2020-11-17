import { Component, OnInit, EventEmitter, OnChanges, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { EvaluationService } from 'src/app/services/evaluation.service';
import { QuestionService } from 'src/app/services/question.service';
import { ModuleService } from '../../services/module.service';
import { NgxSpinnerService } from "ngx-spinner";
import { AnswerService } from 'src/app/services/answer.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit, OnChanges {

  @ViewChild('confirmAction') confirmAction: any
  public dtTiggers = new Subject()

  public formation: any
  public listModules: any = []

  public emitModule: EventEmitter<any> = new EventEmitter
  public moduleId: any
  public moduleName: any

  public listQuestions: any = []
  public question: any
  public questionId: any
  public listAnswers: any = []

  public formationContent: any
  public indexQuestions: any
  public showNextButton: any
  public showPreviouxButton: any

  public alertQuestions: any

  public selectedAnswer: any
  public stateAnswer: any
  public initPoint: any = 0
  public countPoint: any

  constructor(
    private router: Router,
    private moduleService: ModuleService,
    private questionService: QuestionService,
    private evaluationService: EvaluationService,
    private answerService: AnswerService,
    private spinner: NgxSpinnerService,
    private ngbModal: NgbModal
  ) {
    this.indexQuestions = 0
    this.showNextButton = true
    this.showPreviouxButton = false
    this.countPoint = 0
  }

  ngOnInit(): void {

    localStorage.setItem('totalPoint', this.initPoint)
    localStorage.removeItem('resultEvaluation')
    localStorage.removeItem('totalQuestion')

    this.alertQuestions = false

    console.log('indexQuestions', this.indexQuestions)

    this.formationContent = false
    this.formation = localStorage.getItem('currentFormation')

    let body = {
      formationId: localStorage.getItem('formationId')
    }

    this.moduleService.getModuleByFormation(body)
      .subscribe((res: any) => {
        this.listModules = res.data
        console.log('listModules-formation/exercice/test', this.listModules)
      })
  }

  ngOnChanges(): void {
    this.loadQuestion(this.moduleId)
  }

  /**
   * beginExercise
   */
  public beginExercise() {
    
  }

  /**
   * loadQuestion
   */
  public loadQuestion(moduleId: any): void {
    let body = {
      moduleId: moduleId
    }

    this.questionService.getQuestionByModule(body)
      .subscribe((res: any) => {

        this.listQuestions = res.data
        console.log('listQuestions', this.listQuestions)

        if (this.listQuestions.length == 0) {
          console.log('AUCUNE QUESION')
          this.alertQuestions = true
        } else {
          console.log('QUESTION EXISTE')
          localStorage.setItem('totalQuestion', this.listQuestions.length)
          this.alertQuestions = false
          this.question = res.data[this.indexQuestions].content
          // this.listAnswers = res.data[this.indexQuestions].questions

          let questionChecked = res.data[this.indexQuestions].id
          console.log('questionChecked', questionChecked)

          this.loadAnswers(questionChecked)

          console.log('question', this.question)
          console.log([this.indexQuestions, this.listQuestions.length])
          // console.log('listAnswers', [this.listAnswers, this.listAnswers.length])

          if ((this.indexQuestions + 1) == this.listQuestions.length) {
            this.showNextButton = false
          } else {
            this.showNextButton = true
          }
          this.dtTiggers.next()
        }
      })
  }

  /**
   * loadAnswers
   */
  public loadAnswers(question: number) {
    let body = {
      questionId: question
    }
    this.answerService.getAnswer(body)
      .subscribe((res: any) => {
        this.listAnswers = res.data
        console.log('listAnswers', this.listAnswers)
      })
  }

  // emit idModule for content
  public emitDataModule(item: any) {
    this.indexQuestions = 0
    localStorage.setItem('totalPoint', this.initPoint)
    localStorage.removeItem('totalQuestion')
    localStorage.removeItem('resultEvaluation')
    this.showPreviouxButton = false
    this.emitModule.emit(item)
    this.moduleId = item.id
    localStorage.setItem('moduleId', this.moduleId)
    this.moduleName = item.name
    this.loadQuestion(this.moduleId)
    this.formationContent = true    
    console.log('module', [this.moduleId, this.moduleName])
  }

  // selection réponse pour state
  onSelectionChange(item: any) {
    this.selectedAnswer = Object.assign({}, this.selectedAnswer, item)
    this.stateAnswer = this.selectedAnswer.state
    console.log('selectedAnswer', [this.selectedAnswer, this.stateAnswer])
  }

  // ========= slide question ======================================
  // NEXT
  public next() {  
    this.indexQuestions += 1      
    console.log('next', this.indexQuestions)

    this.getIndexQuestion(this.indexQuestions)
    this.loadQuestion(this.moduleId)
    
    if (this.stateAnswer == true) {
      this.countPoint += 1
      localStorage.setItem('totalPoint', this.countPoint)
    }
  }

  // PREVIOUS
  public previous() {  
    this.indexQuestions -= 1  
    console.log('previous', this.indexQuestions)
    this.getIndexQuestion(this.indexQuestions)
    this.loadQuestion(this.moduleId)    
  }

  // PUSH RESULTAT
  public pushResult() {
    this.closeModal()
    if (this.stateAnswer == true) {
      this.countPoint += 1
      localStorage.setItem('totalPoint', this.countPoint)
    }

    this.spinner.show()

    let totalPoint: any = localStorage.getItem('totalPoint')
    let maxPoint: any = localStorage.getItem('totalQuestion')
    let pourcentPoint: any = (totalPoint / maxPoint) * 100

    let resultFormation = Number(localStorage.getItem('formationPourcentage'))
    console.log('RESULTAT EVALUATION', [pourcentPoint, resultFormation])

    if (pourcentPoint < resultFormation) {
      localStorage.setItem('resultEvaluation', 'KO')
    } else {
      localStorage.setItem('resultEvaluation', 'OK')
    }
    console.log('RESULAT EVAL', localStorage.getItem('resultEvaluation'))

    let body = {
      user: localStorage.getItem('userId'),
      result: pourcentPoint.toFixed(2),
      date: new Date(),
      score: localStorage.getItem('totalPoint')
    }

    console.log('body', body)

    this.evaluationService.pushUserEvaluation(body)
      .subscribe((res: any) => {
        console.log('resultat', res)
        this.router.navigateByUrl('evaluation')
        this.spinner.hide()
      })
  }
  // ================================================================

  public getIndexQuestion(index: any) {
    if (index !== 0) {
      this.showPreviouxButton = true
    } else {
      this.showPreviouxButton = false
    }
  }

  // ROUTE
  public logout() {
    this.router.navigateByUrl('')
    localStorage.clear()
  }

  public toHome() {
    this.router.navigateByUrl('home')
  }

  // MODAL ===================================================

  /**
   * closeModal
   */
  public closeModal() {
    this.ngbModal.dismissAll()
  }

  /**
   * openModal
   */
  public openModal(modal: any) {
    this.ngbModal.open(modal)
  }
}