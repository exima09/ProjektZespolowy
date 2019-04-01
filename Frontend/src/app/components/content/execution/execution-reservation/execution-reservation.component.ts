import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from 'src/app/services/authorization.service';
import { ExecutionService } from 'src/app/services/execution/execution.service';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { MatSnackBar } from '@angular/material';

@Component({
  selector: 'app-execution-reservation',
  templateUrl: './execution-reservation.component.html',
  styleUrls: ['./execution-reservation.component.css']
})
export class ExecutionReservationComponent implements OnInit {
  headerOfSite = "Zarezerwuj egzekucję";

  constructor(private service: ExecutionService, private auth: AuthenticationService, private router:Router,
    private snackBar: MatSnackBar) {
    this.auth.checkLogin();
  }

  ngOnInit() {
    this.resetForm();

  }

  resetForm(form?: NgForm) {
    if (form != null) {
      form.resetForm();
    }
    this.service.formData = {
      ExecutionDate: null,
      PrisonerId : null,
      WorkerId: null,
      HasDone: false,
      LastWishOrderId: null
    };
  }

  onSubmit(form: NgForm) {
    if (form.value.id == null) {
      if (localStorage.getItem('token')) {
        this.insertRecord(form);
      }
    }
  }

  insertRecord(form: NgForm) {

    this.service.postExecution(form.value).subscribe(res => {
      console.log('Execution booked!');
      this.resetForm(form);
      this.router.navigate(['']);
      this.snackBar.open("Pomyślnie zarezerwowano egzekucję.", "OK", { duration: 5000 });
    });
  }

}
