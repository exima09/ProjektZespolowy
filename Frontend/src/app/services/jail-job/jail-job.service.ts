import {Injectable} from '@angular/core';
import {Prisoner} from 'src/app/models/prisoner/prisoner.model';
import {HttpClient, HttpErrorResponse} from '@angular/common/http';
import {getHeaders} from "../headers";
import { throwError } from 'rxjs';
import { MatSnackBar } from '@angular/material';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class JailJobService {

  constructor(private http: HttpClient, public snackBar: MatSnackBar) {
  }

  addJailJob = (formData) => this.http.post('/api/jail-job', formData, getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));

  addJailJobSchedule = (formData) => this.http.post('/api/jail-job/schedule', formData, getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));

  getJailJob = () => this.http.get('/api/jail-job', getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));

  getJailJobSchedule = () => this.http.get('/api/jail-job/schedule', getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));

  delJailJob = (id) => this.http.delete(`/api/jail-job/${id}`, getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));

  delJailJobSchedule = (id) => this.http.delete(`/api/jail-job/schedule/${id}`, getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));


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
