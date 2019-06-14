import {Injectable} from '@angular/core';
import {HttpClient, HttpErrorResponse} from '@angular/common/http';
import {getHeaders} from "../headers";
import { throwError } from 'rxjs';
import { MatSnackBar } from '@angular/material';
import { catchError } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class AlarmService {

  constructor(private http: HttpClient, public snackBar: MatSnackBar) {
  }

  getAlarmList() {
    return this.http.get('/api/alarm/list', getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));
  }

  getIsAlarmActive() {
      return this.http.get('/api/alarm', getHeaders())
        .pipe(catchError(err => this.errorHandler(err)));
    }

  alarmStart() {
    return this.http.post('/api/alarm', null, getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));
  }
  alarmStop() {
      return this.http.patch('/api/alarm', null, getHeaders())
        .pipe(catchError(err => this.errorHandler(err)));
    }

  errorHandler(error: HttpErrorResponse) {
    if (error.name) {
      this.snackBar.open("Błąd", error.error.message, {
        duration: 2000,
        panelClass: ['service-snackbar']
      });

      return throwError(error.name + ": " + error.message);
    } else {
      this.snackBar.open("Błąd", "Żądanie nie może zostać przetworzone", {
        duration: 5000,
        panelClass: ['service-snackbar']
      });

      return throwError(error);
    }
  }
}
