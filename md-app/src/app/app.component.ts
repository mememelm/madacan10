import { Component } from '@angular/core';
import { LocationStrategy } from '@angular/common';
import { AutoLogoutService } from "./services";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'md-app';

  constructor(
    private locationStrategy: LocationStrategy,
    public autoLogoutService: AutoLogoutService
  ) {
    this.locationStrategy.onPopState(() => {
      history.pushState(null, null, window.location.href)
    });
  }
}
