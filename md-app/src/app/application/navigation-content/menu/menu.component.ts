import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormationService } from 'src/app/services';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor(
    private router: Router,
    private formationService: FormationService
  ) { }

  ngOnInit(): void {
    this.formationService.getFormationDocumentByModule()
      .subscribe((res: any) => {
        localStorage.setItem('currentFormation', res.data[0].title)
      })
  }

  public route(router) {
    this.router.navigateByUrl(router)
  }

  /**
   * setEvalutationState
   */
  public setEvalutationState() {
    localStorage.setItem('evaluationState', 'list')
  }

}
