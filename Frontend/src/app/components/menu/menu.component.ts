import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from "../../services/authorization.service";
import { Observable } from "rxjs";
import { Role } from 'src/app/models/role/role';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {
  isLoggedIn$: Observable<boolean>;
  isAdmin = false;

  constructor(private authService: AuthenticationService) { }

  ngOnInit() {
    this.isLoggedIn$ = this.authService.isLoggedIn;
    this.isAdmin = this.checkAdminLogged();
  }

  checkAdminLogged = () => this.authService.getRoles().includes(Role.ADMIN);

  onLogout() {
    this.authService.logout();
  }
}
