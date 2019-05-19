import { Injectable } from "@angular/core";
import { MatSnackBar } from "@angular/material";
import { HttpErrorResponse, HttpClient } from "@angular/common/http";
import { getHeaders } from "../headers";
import { catchError } from "rxjs/operators";
import { throwError } from "rxjs";
import { Department } from "src/app/models/department/department.model";

@Injectable({
    providedIn: 'root'
})
export class DepartmentService {

    constructor(private http: HttpClient, public snackBar: MatSnackBar) {
    }

    getDepartments() {
        return this.http.get('/api/department', getHeaders())
            .pipe(catchError(err => this.errorHandler(err)));
    }
    postDepartment(department: Department) {
        return this.http.post('/api/department', department, getHeaders())
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
