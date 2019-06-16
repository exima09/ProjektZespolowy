import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, NgForm } from '@angular/forms';
import { JobApplicationService } from 'src/app/services/job-application/job-application.service';
import { AuthenticationService } from 'src/app/services/authorization.service';
import { Router } from '@angular/router';
import { MatSnackBar } from '@angular/material';

@Component({
  selector: 'app-apply-job',
  templateUrl: './apply-job.component.html',
  styleUrls: ['./apply-job.component.css']
})
export class ApplyJobComponent implements OnInit {
  headerOfSite = "Złóż podanie o pracę";
  dataForm: FormGroup;
  accountForm: FormGroup;
  firstStep = true;
  secondStep = false;
  anyErrors = false;
  uploadedFile: File = null;
  fileError = "";
  form: NgForm = null;
  loading = false;
  result = "";

  constructor(private _formBuilder: FormBuilder, private service: JobApplicationService,
    private authService: AuthenticationService, private router: Router, private snackService: MatSnackBar) { }

  ngOnInit() {
    this.dataForm = this._formBuilder.group({
      firstName: ['', Validators.required],
      lastName: ['', Validators.required],
      email: ['', Validators.compose([Validators.required, Validators.email])],
      phoneNumber: ['', Validators.compose([Validators.required, Validators.pattern(new RegExp("^\\d{9}$"))])],
    });
    this.accountForm = this._formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.compose([Validators.required, Validators.minLength(3)])]
    });
  }

  nextStep(form: NgForm) {
    if (this.dataForm.valid) {
      this.firstStep = false;
      this.secondStep = true;
      this.form = form;
      this.anyErrors = false;
    } else {
      this.anyErrors = true;
    }
  }

  readURL(event): void {
    if (event.target.files && event.target.files[0]) {
      const file = event.target.files[0];
      try {

        this.checkFile(file);
        this.fileError = "Przesłano poprawny plik";
        this.uploadedFile = file;
      } catch (err) {
        this.fileError = err;
        this.anyErrors = true;
      }
    }
  }

  checkFile(file: File) {
    if (file.type !== "application/pdf") {
      throw new Error("File not valid, need to be .pdf")
    }
    if (file.size > 5242880) {
      throw new Error("File not valid, need to be smaller than 5Mb")
    }
  }

  goBack() {
    this.firstStep = true;
    this.secondStep = false;
  }

  submit() {
    if (this.anyErrors === false) {
      this.secondStep = false;
      this.loading = true;
      const applicationForm = new FormData();
      for (const data in this.form.value) {
        applicationForm.set(data, this.form.value[data]);
      }
      applicationForm.set('file', this.uploadedFile);
      this.service.postApplication(applicationForm).subscribe(
        res => null,
        err => this.result = "Podanie nie zostało złożone \n Proszę spróbować ponownie.",
        () => { this.result = "Podanie zostało złożone.."; this.loading = false; });
    }
  }

  createAccount(newAccountForm: NgForm) {
    if (this.accountForm.valid && this.form.valid) {
      this.accountForm.value.firstName = this.form.value.firstName;
      this.accountForm.value.lastName = this.form.value.lastName;
      this.authService.register(this.accountForm.value).subscribe(
        res => null,
        _err => this.snackService.open("Nie udało się założyć konta"),
        () => { this.snackService.open("Konto zostało założone"), this.router.navigate(['/login']); }
      );
    }
  }
}
