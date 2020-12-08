import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormationService } from '../../../services/formation.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  public userId: any
  public formation: any = []
  public firstname: any
  public lastname: any
  public avatar: any

  constructor(
    private formationService: FormationService,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.formation = localStorage.getItem('currentFormation')

    this.userId = localStorage.getItem('userId')
    

    let body = {
      userId: this.userId
    }
    this.formationService.getFormationByUser(body)
      .subscribe(async (res: any) => {
        
        for (let i = 0; i < res.data.length; i++) {
          this.formation = res.data[i].name
          localStorage.setItem('formationId', res.data[i].id)
        }
        await this.formation
        
        localStorage.setItem('currentFormation', this.formation)
      })

    let user = JSON.parse(localStorage.getItem('currentUser'))
    this.firstname = user.firstname
    this.lastname = user.lastname
    this.avatar = user.avatar
  }

  public logout() {
    localStorage.clear()
    this.router.navigateByUrl('')
  }
}
