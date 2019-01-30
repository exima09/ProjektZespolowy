import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {
  login = localStorage.getItem('token');
  constructor(private router: Router) { }

  ngOnInit() {
  }

  logout() {
    localStorage.removeItem('token');
    this.login = localStorage.getItem('token');
    this.router.navigateByUrl("/");
  }

  logging(token: string) {
    this.login = token;
    console.log("login", this.login);
    this.router.navigateByUrl("/");
  }
}
