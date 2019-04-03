import {Component, OnInit} from '@angular/core';
import {Prisoner} from 'src/app/models/prisoner/prisoner.model';
import {PrisonerService} from 'src/app/services/prisoner/prisoner.service';
import {Router} from '@angular/router';
import {NgForm} from '@angular/forms';
import {MatSnackBar} from '@angular/material';

@Component({
  selector: 'app-prisoner-edit',
  templateUrl: './prisoner-edit.component.html',
  styleUrls: ['./prisoner-edit.component.css']
})
export class PrisonerEditComponent implements OnInit {
  headerOfSite = 'Edycja więźnia';
  prisoner: Prisoner;
  id: number;

  constructor(private service: PrisonerService, private route: Router, public snackBar: MatSnackBar) {
  }

  ngOnInit() {
    const urlArr = this.route.url.split("/");
    this.id = Number(urlArr[3]);
    this.service.getPrisonerById(this.id).subscribe((res: any) => {
      this.prisoner = JSON.parse(res.prisoner);
    });
  }

  /**
   * Zatwierdza formularz edycyji więźnia i wysyła dane do serwisu więźnia.
   *
   * @param {NgForm} form formularz edycji więźnia
   */
  onSubmit(form: NgForm) {
    this.service.updatePrisoner(form.value, this.id).subscribe(() => {
        console.log('Prisoner edited successfully');
        this.snackBar.open('Edycja więźnia udana', 'OK', {
          duration: 2000,
          panelClass: ['service-snackbar']
        });
      },
      err => {
        this.snackBar.open("Błąd", "Wystąpił błąd podczas aktualizacji danych", {
          duration: 2000,
          panelClass: ['service-snackbar']
        });
        console.log("ERROR", err);
      }
    );
  }
}
