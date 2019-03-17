import {Injectable} from '@angular/core';
import {Prisoner} from 'src/app/models/prisoner/prisoner.model';
import {HttpClient, HttpErrorResponse} from '@angular/common/http';
import {getHeaders} from "../headers";
import { MatSnackBar } from '@angular/material';
import { throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class PrisonerService {

  formData: Prisoner;
  list: Prisoner[];

  constructor(private http: HttpClient, public snackBar: MatSnackBar) {
  }

  postPrisoner(formData: Prisoner) {
    return this.http.post('/api/prisoner/register', formData, getHeaders())
    .pipe(catchError(err => this.errorHandler(err)));
  }

  getPrisoners() {
    return this.http.get('/api/prisoner', getHeaders())
    .pipe(catchError(err => this.errorHandler(err)));
  }

  // Możecie stosować skrócony zapis
  getPrisonerById = (id: number) => this.http.get(`/api/prisoner/${id}`, getHeaders())
    .pipe(catchError(err => this.errorHandler(err)));

  // wywolanie: this.updatePrisoner({id: 2, FirstName: "update"}) <- obsluguje kazdy parametr do zmiany i kilka na raz
  updatePrisoner = (prisoner: UpdatePrisoner) => this.http.patch(`/api/prisoner/${prisoner.id}`, prisoner, getHeaders())
    .pipe(catchError(err => this.errorHandler(err)));

  errorHandler(error: HttpErrorResponse) {
    if (error.name) {
      let x = error.error.message;
      let message = x.split(", błąd: ");

      this.snackBar.open("Błąd", message[0], {
        duration: 2000,
        panelClass: ['service-snackbar']
      });

      return throwError(error.name + ": " + message[1]);
    } else {
      this.snackBar.open("Błąd", "Żądanie nie może zostać przetworzone", {
        duration: 5000,
        panelClass: ['service-snackbar']
      });

      return throwError(error);
    }
  }
}

export interface UpdatePrisoner {
  id: number;
  FirstName?: string;
  LastName?: string;
  JoinDate?: string;
  DateOfBirth?: string;
  CellId?: number;
}
