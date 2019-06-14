import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from "../../services/authorization.service";

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {
  isLoggedIn: boolean;
  isAdmin = this.authService.isAdmin.subscribe(res=>this.isAdmin = res);

  constructor(private authService: AuthenticationService) { }

  ngOnInit() {
    this.authService.isLoggedIn.subscribe(res=>this.isLoggedIn = res);
  }


  onLogout() {
    this.authService.logout();
  }
}

