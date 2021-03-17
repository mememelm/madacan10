import { Component, OnInit, EventEmitter, OnChanges, ViewChild } from '@angular/core';
import { LocationStrategy } from '@angular/common';
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
  @ViewChild('confirmBeginTest') confirmBeginTest: any

  public dtTiggers = new Subject()

  public userId: any

  public formation: any
  public listModules: any = []
  public lastUserModules: any

  public emitModule: EventEmitter<any> = new EventEmitter
  public moduleId: any
  public moduleName: any

  public evaluationAffiliation: any
  public evaluationState: any

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

  public safeSkip: any

  public showModuleMenu: any
  public showTimeout: any
  public moduleDuration: any
  public timer: any

  constructor(
    private locationStrategy: LocationStrategy,
    private router: Router,
    private moduleService: ModuleService,
    private questionService: QuestionService,
    private evaluationService: EvaluationService,
    private answerService: AnswerService,
    private exerciseService: ExerciseService,
    private spinner: NgxSpinnerService,
    private ngbModal: NgbModal
  ) {
    this.locationStrategy.onPopState(() => {
      history.pushState(null, null, window.location.href)
    });

    this.indexQuestions = this.countPoint = 0
    this.showNextButton = this.showPreviouxButton = this.showBeginButton = false
    this.safeSkip = true
  }

  ngOnInit(): void {
    this.showModuleMenu = true

    this.userId = localStorage.getItem('userId')

    localStorage.setItem('totalPoint', this.initPoint)
    localStorage.removeItem('resultEvaluation')
    localStorage.removeItem('totalQuestion')

    this.alertQuestions = this.formationContent = this.alertNumberExercise = this.showTimeout = false
    
    this.formation = localStorage.getItem('currentFormation')

    let body = {
      formationId: localStorage.getItem('formationId')
    }

    // this.moduleService.getModuleByFormation(body)
    //   .subscribe((res: any) => {
    //     this.listModules = res.data
        
    //   })

    // this.getLastEvaluationUser()
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
        

        if (this.listQuestions.length == 0) {
          
          this.alertQuestions = true
          this.showNextButton = false
        } else {
          
          localStorage.setItem('totalQuestion', this.listQuestions.length)
          this.alertQuestions = false
          this.question = res.data[this.indexQuestions].content
          // this.listAnswers = res.data[this.indexQuestions].questions

          let questionChecked = res.data[this.indexQuestions].id
          

          this.loadAnswers(questionChecked)

          
          
          // 

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
        
      })
  }

  // emit idModule for content
  public emitDataModule(item: any) {
    if (this.formationContent == true) {
      this.ngbModal.open(this.alertSkipExercise)
      if (this.listQuestions.length !== 0) {
        this.safeSkip = false
      } else {
        this.safeSkip = true
      }

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
      this.moduleDuration = item.duration
      localStorage.setItem('moduleDuration', this.moduleDuration)

      // GET NUMBER EXERCISE BY MODULE    
      this.getExerciseNumber(this.userId, localStorage.getItem('moduleId'))

      
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
   * getLastEvaluationUser
   */
  public getLastEvaluationUser() {
    let body = {
      userId: localStorage.getItem('userId')
    }
    this.evaluationService.getEvaluationByUser(body)
      .subscribe((res: any) => {
        
        let result = res.data
        for (let i = 0; i < result.length; i++) {
          this.lastUserModules = res.data[i]
          let data = []
          let objectData = {
            affiliation : res.data[i].affiliation,
            module: res.data[i].module,
            state: res.data[i].state,
            date: res.data[i].date.date
          }
          data.push(objectData)
          localStorage.setItem('lastUserModules', JSON.stringify(objectData))
        }
        
        
      })
  }

  /**
   * skipeExercise
   */
  public skipExercise() {

    if (this.listQuestions.length == 0) {
      let body = {
        user: this.userId,
        module: this.moduleId,
        number: 0
      }
      this.exerciseService.updateExerciseByUser(body, localStorage.getItem('exerciseAddedId'))
        .subscribe((res: any) => {
          
          this.formationContent = false
          this.ngbModal.dismissAll()
        })
    } else {
      this.initDataExerciseAfterSkip()
    }
  }

  // init DATA EXERCISE SKIPE
  public initDataExerciseAfterSkip() {
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

    localStorage.setItem('userDoing', 'exercise')

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
          
        })

      this.ngbModal.dismissAll()

      this.loadQuestion(this.moduleId)
      this.formationContent = true
    }

    // ADD N exercise
    else {
      this.showBeginButton = false
      

      let body = {
        user: this.userId,
        module: this.moduleId,
        number: 1
      }
      this.exerciseService.createExercise(body)
        .subscribe((res: any) => {
          
          localStorage.setItem('exerciseAddedId', res.exercise.id)
        })

      this.ngbModal.dismissAll()

      this.loadQuestion(this.moduleId)
      this.formationContent = true
    }
  }

  /**
   * confirmBeginTest
   */
  public confirmBeginTestModule() {
    this.ngbModal.open(this.confirmBeginTest)
  }

  /**
   * beginTestModule
   */
  public beginTestModule() {

    // initialisation environnement test
    let duration = Number(localStorage.getItem('moduleDuration'))
    this.showModuleMenu = false
    this.formationContent = this.showTimeout = true
    localStorage.setItem('userDoing', 'test')

    this.loadQuestion(this.moduleId)
    this.closeModal()
    this.testTimeoutIntervalle(duration)

  }

  /**
   * testTimeoutIntervalle
   */
  public testTimeoutIntervalle(duration: number) {
    this.timer = duration * 60
    
    setInterval(() => {
      this.timer -= 1
      if (this.timer == 0) {
        this.pushResult()
      }
    }, 1000)
  }

  // selection réponse pour state
  onSelectionChange(item: any) {
    this.selectedAnswer = Object.assign({}, this.selectedAnswer, item)
    this.stateAnswer = this.selectedAnswer.state
    localStorage.setItem('response', 'notEmpty')
    
  }

  // ========= slide question ======================================
  // NEXT
  public next() {
    this.indexQuestions += 1
    

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
    
    this.getIndexQuestion(this.indexQuestions)
    this.loadQuestion(this.moduleId)
  }

  // PUSH RESULTAT
  public pushResult() {

    let userDoing = localStorage.getItem('userDoing')
    let response = localStorage.getItem('response')

    if (userDoing == 'exercise') {
      this.evaluationAffiliation = 'Exercice'
    } else {
      this.evaluationAffiliation = 'Test'
    }

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
      

      if (pourcentPoint < resultFormation) {
        localStorage.setItem('resultEvaluation', 'KO')
        this.evaluationState = 0
      } else {
        localStorage.setItem('resultEvaluation', 'OK')
        this.evaluationState = 1
      }
      

      let body = {
        user: localStorage.getItem('userId'),
        result: pourcentPoint.toFixed(2),
        date: new Date(),
        score: localStorage.getItem('totalPoint'),
        module: this.moduleId,
        affiliation: this.evaluationAffiliation,
        state: this.evaluationState
      }

      

      this.evaluationService.pushUserEvaluation(body)
        .subscribe((res: any) => {
          
          this.router.navigateByUrl('evaluation')
          localStorage.setItem('evaluationState', 'result')
          this.timer = -1
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