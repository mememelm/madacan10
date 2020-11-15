import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
import { ModuleService } from '../../services/module.service';
import { Subject } from 'rxjs';
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-module',
  templateUrl: './module.component.html',
  styleUrls: ['./module.component.css']
})
export class ModuleComponent implements OnInit {

  @Input() public listModules: any = []

  @Output() public emitModule: EventEmitter<any> = new EventEmitter

  public dtTiggers = new Subject()

  constructor(
    private moduleService: ModuleService,
    private router: Router,
    private spinner: NgxSpinnerService
  ) { }

  ngOnInit(): void {
    this.spinner.show()

    let body = {
      formationId: localStorage.getItem('formationId')
    }

    this.moduleService.getModuleByFormation(body)
      .subscribe((res: any) => {
        this.listModules = res.data
        console.log('listModules', this.listModules)
        this.spinner.hide()
      })
  }

  // emit idModule for content
  public emitDataModule(item: any) {
    this.emitModule.emit(item)
    console.log('emitModule', item)
  }

  public toHome() {
    this.router.navigateByUrl('home')
  }
}