import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from 'src/app/services/authorization.service';
import {NgForm} from "@angular/forms";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  headerOfSite = 'Logowanie';
  anyErrors: boolean;
  finished = true;

  constructor(private authService: AuthenticationService) {}

  ngOnInit() {
    this.resetForm();
  }

  resetForm(form?: NgForm) {
    if (form != null) {
      form.resetForm();
    }
    this.authService.formData = {
      firstName: '',
      lastName: '',
      username: '',
      password: '',
    };
  }

  onSubmit(formData: NgForm) {
    this.anyErrors = false;
    this.finished = false;

    this.authService.login(formData.value).subscribe(
      elem => null,
      err => {
        this.anyErrors = true;
        this.finished = true;
        console.log("BŁĄD PODCZAS LOGOWANIA: ", err);
      },
      () => {
        this.finished = true;
        this.anyErrors = false;
        this.resetForm(formData);
      }
    );
  }
}
