import {Injectable} from '@angular/core';
import {HttpClient, HttpErrorResponse} from '@angular/common/http';
import {getHeaders} from "../headers";
import { throwError } from 'rxjs';
import { MatSnackBar } from '@angular/material';
import { catchError } from 'rxjs/operators';
import {Prisoner} from "../../models/prisoner/prisoner.model";

export interface prisonerToCell {
  cellId: number;
  prisonerId: number;
}

@Injectable({
  providedIn: 'root'
})
export class BlockService {

  constructor(private http: HttpClient, public snackBar: MatSnackBar) {
  }

  getBlocks() {
    return this.http.get('/api/block', getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));
  }

  addPrisonerToCell(formData: prisonerToCell) {
    return this.http.post('/api/block', formData, getHeaders())
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
