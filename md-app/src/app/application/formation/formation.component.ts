import { Component, OnInit, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
import { ModuleService } from '../../services/module.service';

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit {

  public formation: any
  public listModules: any = []

  public emitModule:EventEmitter<any> = new EventEmitter

  public moduleId: any

  constructor(
    private router: Router,
    private moduleService: ModuleService
  ) { }

  ngOnInit(): void {    
    this.formation = localStorage.getItem('currentFormation')  
    
    let body = {
      formationId: localStorage.getItem('formationId')
    }

    this.moduleService.getModuleByFormation(body)
      .subscribe((res:any) => {
        this.listModules = res.data
        console.log('listModules', this.listModules)
      })
  }

  // emit idModule for content
  public emitDataModule(moduleId) {
    this.emitModule.emit(moduleId)
    this.moduleId = moduleId
    console.log('moduleId', this.moduleId)
  }

  // ROUTE
  public logout() {
    this.router.navigateByUrl('')
    localStorage.clear()
  }

  public toHome() {
    this.router.navigateByUrl('home')
  }
}