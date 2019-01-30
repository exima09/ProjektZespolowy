import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from 'src/app/services/authorization.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  headerOfSite = 'Logowanie';
  login: string;
  password: string;
  anyErrors: boolean;
  finished: boolean;

  constructor(private authService: AuthenticationService) {}

  ngOnInit() {}


  writtenLogin(value: string) {
    this.login = value;
  }

  writtenPassword(value: string) {
    this.password = value;
  }

  submit() {
    this.anyErrors = false;
    this.finished = false;

    this.authService.login(this.login, this.password).subscribe(
      elem => console.log('elem', elem),
      err => this.anyErrors = true,
      () => this.finished = true
    );
  }
}
