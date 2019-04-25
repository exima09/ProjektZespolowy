import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from 'src/app/services/authorization.service';
import {NgForm} from "@angular/forms";
import {Router} from "@angular/router";


@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  headerOfSite = 'Rejestracja';
  anyErrors: boolean;
  finished: boolean;

  constructor(private authService: AuthenticationService, private router: Router) {
  }

  ngOnInit() {
    this.resetForm();
    this.finished = false;
    this.anyErrors = false;
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

  onSubmit(form: NgForm) {
    this.authService.register(form.value).subscribe(
      async res => {
        await this.resetForm(form);
        this.finished = true;
        await new Promise(resolve => setTimeout(resolve, 5000));
        await this.router.navigate(['/login']);
      },
      error => {
        this.anyErrors = true;
        console.log("BŁĄD PODCZAS REJESTRACJI: ", error);
      }
    );
  }
}
