import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from 'src/app/services/authorization.service';


@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  headerOfSite = 'Rejestracja';
  login: string;
  password: string;
  anyErrors: boolean;
  finished: boolean;

  constructor(private authService: AuthenticationService) { }

  ngOnInit() {
  }

  writtenLogin(value: string) {
    this.login = value;
    console.log('login = ' + this.login);
  }

  writtenPassword(value: string) {
    this.password = value;
    console.log('password = ' + this.password);
  }

  submit() {
    this.anyErrors = false;
    this.finished = false;

    this.authService.register(this.login, this.password).subscribe(
      elem => null,
      err => this.anyErrors = true,
      () => this.finished = true
    );
  }
}
