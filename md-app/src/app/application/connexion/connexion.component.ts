import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent implements OnInit {

  hide = true

  constructor(private router: Router) { }

  ngOnInit(): void {
  }

  public connexion() {
    this.router.navigateByUrl('formation')
  }
}
