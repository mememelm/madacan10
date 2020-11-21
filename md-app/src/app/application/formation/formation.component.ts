import { Component, OnInit, EventEmitter, OnChanges, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { EvaluationService } from 'src/app/services/evaluation.service';
import { QuestionService } from 'src/app/services/question.service';
import { ModuleService } from '../../services/module.service';
import { NgxSpinnerService } from "ngx-spinner";
import { AnswerService } from 'src/app/services/answer.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ExerciseService } from 'src/app/services/exercise.service';

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit, OnChanges {

  @ViewChild('confirmAction') confirmAction: any
  @ViewChild('confirmExercise') confirmExercise: any
  @ViewChild('alertSkipExercise') alertSkipExercise: any
  @ViewChild('emptyResponse') emptyResponse: any

  public dtTiggers = new Subject()

  public userId: any

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
  public showBeginButton: any

  public selectedAnswer: any
  public stateAnswer: any
  public initPoint: any = 0
  public countPoint: any
  public alertNumberExercise: any
  public numberExercise: any
  public exerciseId: any

  constructor(
    private router: Router,
    private moduleService: ModuleService,
    private questionService: QuestionService,
    private evaluationService: EvaluationService,
    private answerService: AnswerService,
    private exerciseService: ExerciseService,
    private spinner: NgxSpinnerService,
    private ngbModal: NgbModal
  ) {
    this.indexQuestions = 0
    this.showNextButton = true
    this.showPreviouxButton = this.showBeginButton = false
    this.countPoint = 0
  }

  ngOnInit(): void {

    this.userId = localStorage.getItem('userId')

    localStorage.setItem('totalPoint', this.initPoint)
    localStorage.removeItem('resultEvaluation')
    localStorage.removeItem('totalQuestion')

    this.alertQuestions = this.formationContent = this.alertNumberExercise = false
    console.log('indexQuestions', this.indexQuestions)
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
    if (this.formationContent == true) {
      this.ngbModal.open(this.alertSkipExercise)
    } else {
      // INITIALISATION STORAGE + CONTENT PRINCIPAL
      this.indexQuestions = 0
      localStorage.setItem('response', 'empty')
      localStorage.setItem('totalPoint', this.initPoint)
      localStorage.removeItem('totalQuestion')
      localStorage.removeItem('resultEvaluation')
      this.emitModule.emit(item)
      this.moduleId = item.id
      localStorage.setItem('moduleId', this.moduleId)
      this.moduleName = item.name

      // GET NUMBER EXERCISE BY MODULE    
      this.getExerciseNumber(this.userId, localStorage.getItem('moduleId'))

      console.log('module', [this.moduleId, this.moduleName])
    }
  }

  /**
   * getExerciseNumber
   */
  public getExerciseNumber(userId, moduleId) {
    let body = {
      user: userId,
      module: moduleId
    }
    this.exerciseService.getExerciseByUserByModule(body)
      .subscribe((res: any) => {

        let exercise = res.data
        console.log('exercise', exercise)

        // GESTION VUE EXERCICE
        if (exercise.length == 0) {
          this.numberExercise = 0
          localStorage.setItem('numberExercise', this.initPoint)
          // BTN AND CONTENT EXCERCICE
          this.showBeginButton = true
          this.alertNumberExercise = this.formationContent = this.showPreviouxButton = false
        } else {
          this.exerciseId = localStorage.setItem('exerciseId', res.data[0].id)
          this.numberExercise = res.data[0].number
          localStorage.setItem('numberExercise', this.numberExercise)
          console.log('numberExercise', this.numberExercise)
          if (this.numberExercise == 2) {
            this.showBeginButton = this.formationContent = this.showPreviouxButton = false
            this.alertNumberExercise = true
          } else {
            this.showBeginButton = true
            this.alertNumberExercise = false
          }
        }
      })
  }

  /**
   * skipeExercise
   */
  public skipExercise() {
    this.indexQuestions = 0
    
    localStorage.setItem('response', 'empty')
    localStorage.setItem('totalPoint', this.initPoint)

    this.getExerciseNumber(this.userId, localStorage.getItem('moduleId'))

    localStorage.removeItem('totalQuestion')
    localStorage.removeItem('resultEvaluation')
    localStorage.removeItem('moduleId')

    this.showBeginButton = true
    this.formationContent = this.showNextButton = this.showPreviouxButton = this.alertNumberExercise = false
    this.ngbModal.dismissAll()
  }

  /**
   * beginExercise
   */
  public beginExercise() {

    let number: any = Number(localStorage.getItem('numberExercise'))
    let exercise: any = localStorage.getItem('exerciseId')

    // ADD OR UPDATE NUMBER EXERCISE
    if (number == 2) {
      return
    }

    // UPDATE N exercise
    if (number == 1) {
      let body = {
        user: this.userId,
        module: this.moduleId,
        number: number + 1
      }
      this.exerciseService.updateExerciseByUser(body, exercise)
        .subscribe((res: any) => {
          console.log(res)
        })

      this.ngbModal.dismissAll()

      this.loadQuestion(this.moduleId)
      this.formationContent = true
    }

    // ADD N exercise
    else {
      this.showBeginButton = false
      console.log('begin exercice module', [this.moduleId, this.moduleName])

      let body = {
        user: this.userId,
        module: this.moduleId,
        number: 1
      }
      this.exerciseService.createExercise(body)
        .subscribe((res: any) => {
          console.log(res)
        })

      this.ngbModal.dismissAll()

      this.loadQuestion(this.moduleId)
      this.formationContent = true
    }
  }

  // selection réponse pour state
  onSelectionChange(item: any) {
    this.selectedAnswer = Object.assign({}, this.selectedAnswer, item)
    this.stateAnswer = this.selectedAnswer.state
    localStorage.setItem('response', 'notEmpty')
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

    let response = localStorage.getItem('response')
    if (response == 'empty') {
      this.ngbModal.open(this.emptyResponse)
    } else {

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
    let exercise: any = localStorage.getItem('numberExercise')
    if (exercise == 2) {
      return
    } else {
      this.ngbModal.open(modal)
    }
  }
}