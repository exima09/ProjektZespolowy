import { Component, OnInit } from '@angular/core';
<<<<<<< HEAD
import { AuthenticationService } from 'src/app/services/authorization.service';
=======
>>>>>>> 771277e... components moved to correct files

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
<<<<<<< HEAD
  headerOfSite = 'Rejestracja';
  login: string;
  password: string;
  anyErrors: boolean;
  finished: boolean;

  constructor(private authService: AuthenticationService) { }
=======
  login:string
  constructor() { }
>>>>>>> 771277e... components moved to correct files

  ngOnInit() {
  }

<<<<<<< HEAD
  writtenLogin(value: string) {
    this.login = value;
    console.log('login = ' + this.login);
  }

  writtenPassword(value: string) {
    this.password = value;
    console.log('password = ' + this.password);
  }

  submit() {
    this.authService.register(this.login, this.password).subscribe(
      elem => console.log(elem),
      err => this.anyErrors = true,
      () => this.finished = true
    );
  }
=======
  writtenLogin(value){
    this.login=value;
    console.log(this.login);
  }

>>>>>>> 771277e... components moved to correct files
}
