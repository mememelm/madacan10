import { Component, OnInit } from '@angular/core';
import { ApiService } from "../../services/api/api.service";

@Component({
  selector: 'app-module',
  templateUrl: './module.component.html',
  styleUrls: ['./module.component.css']
})
export class ModuleComponent implements OnInit {

  constructor(
    private apiService: ApiService
  ) { }

  ngOnInit(): void {
    let formation = {
      id: 1
    }
    this.apiService.postDataWithToken(formation, 'modules/get').subscribe((res) => console.log(res))
  }

}
