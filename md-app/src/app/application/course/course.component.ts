import { Component, OnInit, EventEmitter, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { SupportService } from 'src/app/services/support.service';
import { ModuleService } from "../../services/module.service";
import { NgxSpinnerService } from "ngx-spinner";
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

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

  public pdfSrc: any = []
  pdff = "https://vadimdez.github.io/ng2-pdf-viewer/assets/pdf-test.pdf"
  public videoSrc: any = []
  public pptSrc: any = []

  constructor(
    private router: Router,
    private moduleService: ModuleService,
    private supportService: SupportService,
    private spinner: NgxSpinnerService,
    private ngbModal: NgbModal
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
        

        if (this.listSupports.length == 0) {
          this.alertCourseEmpty = true
        } else {
          this.alertCourseEmpty = false
        }

        for (let i = 0; i < this.listSupports.length; i++) {
          if (res.data[i].type == 'Video') {
            this.fileVideo[i] = true
            this.videoSrc[i] = res.data[i].files
          }
          if (res.data[i].type == 'PDF') {
            this.filePdf[i] = true
            this.pdfSrc[i] = res.data[i].files
          }
          if (res.data[i].type == 'PPT') {
            this.filePpt[i] = true
            this.pptSrc[i] = res.data[i].files
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
    
  }

  public toHome() {
    this.router.navigateByUrl('home')
  }

  /**
   * openPdf
   */
  public openViewModal(modal) {
    this.ngbModal.open(modal, {
      ariaLabelledBy: 'modal-basic-title',
      size: 'lg',
      // windowClass: 'modal-xl'
    })
  }
}
