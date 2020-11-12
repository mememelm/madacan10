import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ModuleService } from "../../services/module.service";

@Component({
  selector: 'app-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.css']
})
export class CourseComponent implements OnInit {

  public formation: any
  public listModules: any = []

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

  public toHome() {
    this.router.navigateByUrl('home')
  }
}
