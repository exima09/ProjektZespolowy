import { Injectable } from '@angular/core';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { getHeaders } from "./headers";
import { throwError } from 'rxjs';
import { MatSnackBar } from '@angular/material';
import { catchError } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class SicknoteService {

    constructor(private http: HttpClient, public snackBar: MatSnackBar) {
    }

    postSickNote(formData) {
        return this.http.post('/api/sick-leave', formData, getHeaders())
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
