import { Component, OnInit } from '@angular/core';
import { FormationService } from '../../../services/formation.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  public userId: any
  public formation: any = []
  public firstname: any
  public lastname: any

  constructor(
    private formationService: FormationService
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
          localStorage.setItem('formationPourcentage', res.data[i].pourcentage)
        }
        await this.formation
        
        localStorage.setItem('currentFormation', this.formation)
      })

    let user = JSON.parse(localStorage.getItem('currentUser'))
    this.firstname = user.firstname
    this.lastname = user.lastname
  }  
}
