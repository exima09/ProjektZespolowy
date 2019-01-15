import { Component, OnInit } from '@angular/core';
import {AuthenticationService} from 'src/app/services/authorization.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  headerOfSite = "Zaloguj się";
  login: string;
  password: string;

  constructor(private authService: AuthenticationService) { }

  ngOnInit() {
  }

  writtenLogin(value: string){
    this.login = value;
    console.log("login: " + this.login);
  }

  writtenPassword(value: string){
    this.password = value;
    console.log("password: " + this.password);
  }

  submit() {
    this.authService.register(this.login, this.password).subscribe(
      elem => console.log(elem),
      error => console.log(error),
      () => console.log("Wszystko ok! :)")
    )
  }
}
