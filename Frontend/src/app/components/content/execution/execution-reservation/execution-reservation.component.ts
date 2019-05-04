import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from 'src/app/services/authorization.service';
import { ExecutionService } from 'src/app/services/execution/execution.service';
import { NgForm, NgModel } from '@angular/forms';
import { Router } from '@angular/router';
import { MatSnackBar } from '@angular/material';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { DatePipe } from '@angular/common';
import { SicknoteService } from 'src/app/services/sicknote.service';
import { ValueTransformer } from '@angular/compiler/src/util';

@Component({
  selector: 'app-execution-reservation',
  templateUrl: './execution-reservation.component.html',
  styleUrls: ['./execution-reservation.component.css']
})
export class ExecutionReservationComponent implements OnInit {
  headerOfSite = "Zarezerwuj egzekucję";
  private prisoners: Prisoner[] = [];
  selectedPrisonerId = "";
  firstFreeDate = "";

  constructor(private prisonerService: PrisonerService, public snackBar: MatSnackBar, private executionService: ExecutionService) { }

  ngOnInit() {
    this.prisonerService.getPrisoners().subscribe((res: any) => {
      this.prisoners = JSON.parse(res.prisoners);
    });

    this.executionService.getFirstFreeDate().subscribe((res: any) => {
      this.firstFreeDate = res.executionDate.slice(1, -4);
    });
  }

  onSubmit(form) {
    if (this.firstFreeDate) {
      form.value.executionDate = this.firstFreeDate;
      this.executionService.postExecution(form.value).subscribe(() => {
        this.snackBar.open('Dodano egzekucje', 'OK', {
          duration: 2000,
          panelClass: ['service-snackbar']
        });
      });
    } else {
      this.snackBar.open('Brak daty egzekucji lol', 'FAIL', {
        duration: 2000,
        panelClass: ['service-snackbar']
      });
    }
    form.resetForm();
  }

}
