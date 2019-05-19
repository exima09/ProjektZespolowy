import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from "../../services/authorization.service";
import { Observable, BehaviorSubject } from "rxjs";
import { Role } from 'src/app/models/role/role';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {
  isLoggedIn$: Observable<boolean>;
  isAdmin = false;
  isAdmin$ = this.authService.isAdmin.subscribe(res => this.isAdmin = res);

  constructor(private authService: AuthenticationService) { }

  ngOnInit() {
    this.isLoggedIn$ = this.authService.isLoggedIn;
  }


  onLogout() {
    this.authService.logout();
  }
}
