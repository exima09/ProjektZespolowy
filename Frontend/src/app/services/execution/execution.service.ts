import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Execution } from 'src/app/models/execution/execution.model';
import { getHeaders } from '../headers';
import { catchError } from 'rxjs/operators';
import { MatSnackBar } from '@angular/material';
import { throwError, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ExecutionService {

  constructor(private http: HttpClient, public snackBar: MatSnackBar) {
  }

  postExecution(formData) {
    return this.http.post('/api/execution', formData, getHeaders()).pipe(catchError(err => this.errorHandler(err)));;
  }

  getFirstFreeDate() {
    return this.http.get('/api/execution/get/date', getHeaders()).pipe(catchError(err => this.errorHandler(err)));;
  }
  getExecutions(): Observable<any>{
    return this.http.get('/api/execution', getHeaders())
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
