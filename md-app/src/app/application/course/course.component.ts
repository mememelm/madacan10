import { Component, OnInit, EventEmitter, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { ModuleService } from "../../services/module.service";
import { NgxSpinnerService } from "ngx-spinner";
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { FormationService } from 'src/app/services';

@Component({
  selector: 'app-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.css']
})
export class CourseComponent implements OnInit {

  @ViewChild('pdf') pdf: any
  @ViewChild('video') video: any
  @ViewChild('msOffice') msOffice: any

  public formation: any
  public listModules: any = []
  public listDocument: any = []
  public listDocumentByModule: any = []
  public listVideo: any = []

  public moduleName: any

  public alertCourseEmpty: any
  public courseContent: any

  public file: any

  constructor(
    private router: Router,
    private moduleService: ModuleService,
    private spinner: NgxSpinnerService,
    private modal: NgbModal,
    private formationService: FormationService
  ) { }

  ngOnInit(): void {
    this.courseContent = false
    this.formation = localStorage.getItem('currentFormation')

    this.moduleService.getModuleByFormation()
      .subscribe((res: any) => {
        this.listModules = res.data
        this.spinner.hide()
      })

    this.formationService.getFormationDocumentByModule()
      .subscribe((res: any) => {
        this.listDocument = res.data
        console.log(this.listDocument)
      })
  }  

  // emit idModule for content
  public async emitDataModule(item: any) {

    this.listDocumentByModule = []
    this.alertCourseEmpty = false
    console.log(item)
    this.courseContent = true
    this.moduleName = item.name
    
    this.listDocument.map((res: any) => { 
      let stringFile = new String(res.file)
      let type = stringFile.slice(-3)
      let fileName = stringFile.slice(51)
      let objectDocument = {
        modulesName: res.modulesName,
        file: res.file,
        formation: res.title,
        type: type,
        fileName: fileName
      }
      if (res.modulesName == this.moduleName) {
        this.listDocumentByModule.push(objectDocument)
        console.log(this.listDocumentByModule)
        if (this.listDocumentByModule.length == 0) {
          this.alertCourseEmpty = true
        }
      }
    })
  }

  public toHome() {
    this.router.navigateByUrl('home')
  }

  /**
   * openPdf
   */
  public openViewModal(modal, file) {
    this.file = file
    this.modal.open(modal, {
      ariaLabelledBy: 'modal-basic-title',
      size: 'lg'
    })
  }
}
