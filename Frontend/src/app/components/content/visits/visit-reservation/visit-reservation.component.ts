import { Component, OnInit } from '@angular/core';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { FormBuilder, Validators, CheckboxControlValueAccessor } from '@angular/forms';
import { DatePipe } from '@angular/common';
import { VisitService } from 'src/app/services/visit/visit.service';
import { Router } from '@angular/router';
import { MatSnackBar } from '@angular/material';


@Component({
  selector: 'app-visit-reservation',
  templateUrl: './visit-reservation.component.html',
  styleUrls: ['./visit-reservation.component.css'],
  providers: [DatePipe]
})
export class VisitReservationComponent implements OnInit {
  headerOfSite = "Rezerwacja widzenia"
  private minDate;
  private maxDate;
  private prisoners: Prisoner[] = [];
  private contactType = "P";
  private error;
  constructor(private prisonerService: PrisonerService, private datePipe: DatePipe, private service: VisitService,
    private router: Router, private snackService: MatSnackBar) { }

  ngOnInit() {
    this.prisonerService.getPrisoners().subscribe((res: any) => {
      this.prisoners = JSON.parse(res.prisoners);
    });
    this.minDate = new Date();
    this.minDate.setDate(this.minDate.getDate() + 1);
    this.maxDate = new Date();
    this.maxDate.setDate(this.maxDate.getDate() + 164);

  }
  setContactType(value) {
    this.contactType = value;
  }
  addHour(date: Date) {
    const x=date.setHours(date.getHours() + 2);
    return date;
  }

  onSubmit(form) {
    if (form.valid) {
      const start = form.value.dateStart.getHours();
      if (start > 8 && start < 16) {
        const toAdd=Object.assign(form.value.dateStart);
        form.value.dateStart = this.datePipe.transform(form.value.dateStart, 'yyyy-MM-dd HH:mm');
        form.value.dateStop = this.datePipe.transform(this.addHour(toAdd) , 'yyyy-MM-dd HH:mm');
        form.value.contactType = this.contactType;
        this.service.addVisit(form.value).subscribe(
          res => null,
          _err => this.snackService.open("Nie udało się zarezerwować widzenia"),
          () => { this.snackService.open("Widzenie zostało zarezerwowane"), this.router.navigate(['/visit']); }
        );
      } else {
        this.error = "Widzenia mogą być rezerwowane w godzinach 8.00-16.59"
      }
    }

  }

}
