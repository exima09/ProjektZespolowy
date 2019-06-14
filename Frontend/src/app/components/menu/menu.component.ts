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
  isAdmin: Observable<boolean>;

  constructor(private authService: AuthenticationService) { }

  ngOnInit() {
    this.isLoggedIn$ = this.authService.isLoggedIn;
    this.isAdmin = this.authService.isAdmin;
  }


  onLogout() {
    this.authService.logout();
  }
}

