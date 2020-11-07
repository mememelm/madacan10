import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormationService } from '../../services/formation.service';

@Component({
  selector: 'app-formation',
  templateUrl: './formation.component.html',
  styleUrls: ['./formation.component.css']
})
export class FormationComponent implements OnInit {

  public userId: any
  public formation: any = []
  public firstnane: any
  public lastname: any

  constructor(
    private router: Router,
    private formationService: FormationService
  ) { }

  ngOnInit(): void {
    
    this.formation = localStorage.getItem('currentFormation')

    this.userId = localStorage.getItem('userId')
    console.log('===> id', this.userId)

    let body = {
      userId: this.userId
    }
    this.formationService.getFormationByUser(body)
      .subscribe(async (res: any) => {
        console.log(res)
        for (let i=0; i<res.data.length; i++) {
          this.formation = res.data[i].name
        }        
        await this.formation
        console.log('formations', this.formation)
        localStorage.setItem('currentFormation', this.formation)
      })

    let user = JSON.parse(localStorage.getItem('currentUser'))
    this.firstnane = user.firstname
    this.lastname = user.lastname
  }

  // ROUTE
  public logout() {
    this.router.navigateByUrl('')
    localStorage.clear()
  }

  public toFormation() {
    this.router.navigateByUrl('home')
  }
}