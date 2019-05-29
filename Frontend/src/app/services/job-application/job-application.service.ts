import { Injectable } from "@angular/core";
import { HttpClient, HttpErrorResponse } from "@angular/common/http";
import { MatSnackBar } from "@angular/material";
import { getHeaders } from "../headers";
import { catchError } from "rxjs/operators";
import { throwError } from "rxjs";

@Injectable({
    providedIn: 'root'
})
export class JobApplicationService {

    constructor(private http: HttpClient, public snackBar: MatSnackBar) {
    }

    postApplication(application) {
        return this.http.post('/api/application', application, getHeaders())
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
