import { Component, OnInit } from '@angular/core';
import { FormControl, Validators, NgForm } from '@angular/forms';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { DatePipe } from '@angular/common';
import { SicknoteService } from 'src/app/services/sicknote.service';
import { MatSnackBar } from '@angular/material';

@Component({
  selector: 'app-prisoner-sick-note',
  templateUrl: './prisoner-sick-note.component.html',
  styleUrls: ['./prisoner-sick-note.component.css'],
  providers: [DatePipe]
})
export class PrisonerSickNoteComponent implements OnInit {
  private headerOfSite = 'Zwolnienie lekarskie';
  private prisoners: Prisoner[] = [];
  private currentDate;
  private maxDate;
  selectedPrisonerId = "";

  constructor(private prisonerService: PrisonerService, private datePipe: DatePipe,
    private sickNoteService: SicknoteService, public snackBar: MatSnackBar) { }

  ngOnInit() {
    const date = new Date();
    this.currentDate = this.datePipe.transform(date, 'yyyy-MM-dd');
    this.maxDate = this.datePipe.transform(new Date(date.getFullYear() + 1, date.getMonth(), date.getDate()), 'yyyy-MM-dd');

    this.prisonerService.getPrisoners().subscribe((res: any) => {
      this.prisoners = JSON.parse(res.prisoners);
    });
  }

  onSubmit(form: NgForm) {
    if (form.valid) {
      form.value.dateStart = this.currentDate;
      this.sickNoteService.postSickNote(form.value).subscribe(() => {
        this.snackBar.open('Dodano zwolnienie', 'OK', {
          duration: 2000,
          panelClass: ['service-snackbar']
        });
      });
    }
    else {
      this.sickNoteService.postSickNote(form.value).subscribe(() => {
        this.snackBar.open('Wypełnij pola', 'FAIL', {
          duration: 2000,
          panelClass: ['service-snackbar']
        });
      });
    }
  }
}
