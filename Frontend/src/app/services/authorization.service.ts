import { Injectable } from "@angular/core";
import { MatSnackBar, MatSnackBarConfig } from "@angular/material/snack-bar"
import { map, catchError } from 'rxjs/operators';

import { HttpErrorResponse, HttpHeaders, HttpClient } from "@angular/common/http";
import { throwError, Subject } from "rxjs";

@Injectable({
    providedIn: 'root'
})
export class AuthenticationService {

    constructor(private http: HttpClient, public snackBar: MatSnackBar) { }

    register(login: string, password: string) {
        let headers = new HttpHeaders({ 'Content-Type': 'application/json' });
        let data={
            "username":login,
            "password":password
        }
        return this.http.post("/api/register",data, {headers}).pipe(catchError(err => this.errorHandler(err)));
    }

    login(login: string, password: string) {
        let headers = new HttpHeaders({ 'Content-Type': 'application/json' });
        let data={
            "username":login,
            "password":password
        }
        return this.http.post("/api/login_check",data, {headers}).pipe(catchError(err => this.errorHandler(err)));
    }

    errorHandler(error: HttpErrorResponse) {
        if (error.name) {
            this.snackBar.open(error.name, error.statusText, {
                duration: 2000,
                panelClass: ['service-snackbar']
            });

            return throwError(error.name + '\n details: ' + error.statusText);
        } else {
            this.snackBar.open('error', 'The request can not be executed', {
                duration: 5000,
                panelClass: ['service-snackbar']
            });
            return throwError(error);
        }
    }
}
