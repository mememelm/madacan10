import { Component, OnInit, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
import { SupportService } from 'src/app/services/support.service';
import { ModuleService } from "../../services/module.service";
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.css']
})
export class CourseComponent implements OnInit {

  public formation: any
  public listModules: any = []
  public listSupports: any = []

  public emitModule: EventEmitter<any> = new EventEmitter
  public moduleId: any
  public moduleName: any

  public filePdf: any = []
  public filePpt: any = []
  public fileVideo: any = []
  public fileName: any = []

  public alertCourseEmpty: any
  public courseContent: any

  constructor(
    private router: Router,
    private moduleService: ModuleService,
    private supportService: SupportService,
    private spinner: NgxSpinnerService
  ) { }

  ngOnInit(): void {
    this.courseContent = false
    this.formation = localStorage.getItem('currentFormation')

    let body = {
      formationId: localStorage.getItem('formationId')
    }

    this.moduleService.getModuleByFormation(body)
      .subscribe((res: any) => {
        this.listModules = res.data
        console.log('listModules-course', this.listModules)
      })
  }

  /**
   * loadSupportByModule
   */
  public loadSupportByModule(moduleId: any): void {

    this.spinner.show()

    let body = {
      moduleId: moduleId
    }

    this.supportService.getSupportModule(body)
      .subscribe((res: any) => {
        this.listSupports = res.data
        console.log('listSupports', this.listSupports)

        if (this.listSupports.length == 0) {
          this.alertCourseEmpty = true
        } else {
          this.alertCourseEmpty = false
        }

        for (let i = 0; i < this.listSupports.length; i++) {
          if (res.data[i].type == 'Video') {
            this.fileVideo[i] = true
          }
          if (res.data[i].type == 'PDF') {
            this.filePdf[i] = true
          }
          if (res.data[i].type == 'PPT') {
            this.filePpt[i] = true
          }
          this.fileName[i] = res.data[i].files.substr(55)
        }
        this.spinner.hide()
      })
  }

  // emit idModule for content
  public emitDataModule(item: any) {
    this.emitModule.emit(item)
    this.moduleId = item.id
    this.moduleName = item.name
    this.loadSupportByModule(this.moduleId)
    this.courseContent = true
    console.log('module', [this.moduleId, this.moduleName])
  }

  public toHome() {
    this.router.navigateByUrl('home')
  }
}
