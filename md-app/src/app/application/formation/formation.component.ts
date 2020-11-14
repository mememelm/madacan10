import { Component, OnInit, EventEmitter, OnChanges } from '@angular/core';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { QuestionService } from 'src/app/services/question.service';
import { ModuleService } from '../../services/module.service';

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit, OnChanges {

  public formation: any
  public listModules: any = []

  public emitModule: EventEmitter<any> = new EventEmitter
  public moduleId: any
  public moduleName: any

  public listQuestions: any = []
  public stateAnswer: any
  public dtTiggers = new Subject()

  constructor(
    private router: Router,
    private moduleService: ModuleService,
    private questionService: QuestionService
  ) { }

  ngOnInit(): void {
    this.formation = localStorage.getItem('currentFormation')

    let body = {
      formationId: localStorage.getItem('formationId')
    }

    this.moduleService.getModuleByFormation(body)
      .subscribe((res: any) => {
        this.listModules = res.data
        console.log('listModules', this.listModules)
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
        this.dtTiggers.next()
      })
  }

  // emit idModule for content
  public emitDataModule(item: any) {
    this.emitModule.emit(item)
    this.moduleId = item.id
    this.moduleName = item.name
    this.loadQuestion(this.moduleId)
    console.log('moduleId', [this.moduleId, this.moduleName])
  }

  // public emitState(item: any) {
  //   this.stateAnswer = this.emitModule.emit(item.state)    
  //   console.log('state', this.stateAnswer)
  // }

  // ROUTE
  public logout() {
    this.router.navigateByUrl('')
    localStorage.clear()
  }

  public toHome() {
    this.router.navigateByUrl('home')
  }
}