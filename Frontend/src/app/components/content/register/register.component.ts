import { Component, OnInit } from '@angular/core';
// import { AuthenticationSerivce } from '../../services/authorization.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  headerOfSite = "Rejestracja";
  login: string;
  password: string;

  constructor(private authService: AuthenticationSerivce) { }

  ngOnInit() {
  }

  writtenLogin(value: string) {
    this.login = value;
    console.log("login = " + this.login);
  }

  writtenPassword(value: string) {
    this.password = value;
    console.log("password = " + this.password);
  }

  submit() {
    this.authService.register(this.login, this.password).subscribe(
      elem => console.log(elem), //powodzenie
      err => console.log(err),  //again
      () => console.log("wszystko ok")
    );
  }
}
