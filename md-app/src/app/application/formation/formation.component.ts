import { Component, OnInit, EventEmitter, OnChanges, ViewChild } from '@angular/core';
import { LocationStrategy } from '@angular/common';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { ModuleService } from '../../services/module.service';
import { NgxSpinnerService } from "ngx-spinner";
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit {

  @ViewChild('confirmAction') confirmAction: any
  @ViewChild('confirmExercise') confirmExercise: any
  @ViewChild('alertSkipExercise') alertSkipExercise: any
  @ViewChild('emptyResponse') emptyResponse: any
  @ViewChild('confirmBeginTest') confirmBeginTest: any

  public dtTiggers = new Subject()

  public listModules: any = []

  public formation: any
  public formationContent: any
  public showModuleMenu: any
  public moduleName: any

  public emitModule: EventEmitter<any> = new EventEmitter

  constructor(
    private locationStrategy: LocationStrategy,
    private router: Router,
    private spinner: NgxSpinnerService,
    private modal: NgbModal,
    private moduleService: ModuleService
  ) {
    this.locationStrategy.onPopState(() => {
      history.pushState(null, null, window.location.href)
    })
  }

  ngOnInit(): void {
    this.moduleService.getModuleByFormation()
      .subscribe((res: any) => {
        this.listModules = res.data
        this.spinner.hide()
      })

    this.showModuleMenu = true
    this.formationContent = false
    this.formation = localStorage.getItem('currentFormation')
  }

  /**
   * beginModuleExercise
   */
  public beginModuleExercise(item: any) {
    console.log(item)
    this.formationContent = true
    this.moduleName = item.name
  }

  /**
   * beginExercise
   */
  public beginExercise() {

  }

  // MODAL ===================================================

  /**
   * closeModal
   */
  public closeModal() {
    this.modal.dismissAll()
  }

  /**
   * openModal
   */
  public openModal(modal: any) {
    this.modal.open(modal)
  }
}