import { Injectable } from "@angular/core";
import { HttpClient, HttpErrorResponse } from "@angular/common/http";
import { MatSnackBar } from "@angular/material";
import { getHeaders } from "../headers";
import { catchError } from "rxjs/operators";
import { throwError } from "rxjs";
import { User } from "src/app/models/user/user.model";
import { Worker } from "src/app/models/worker/worker.model";

@Injectable({
    providedIn: 'root'
})
export class WorkerService {

    constructor(private http: HttpClient, public snackBar: MatSnackBar) {
    }

    getUsers() {
        return this.http.get('/api/user', getHeaders())
            .pipe(catchError(err => this.errorHandler(err)));
    }

    getUsersWithoutWorker = () => this.http.get('/api//user/noworker', getHeaders())
        .pipe(catchError(err => this.errorHandler(err)))


    getWorkers() {
        return this.http.get('/api/worker', getHeaders())
            .pipe(catchError(err => this.errorHandler(err)));
    }

    postWorker(worker: Worker) {
        return this.http.post('api/worker/user', worker, getHeaders())
            .pipe(catchError(err => this.errorHandler(err)));
    }

    updateUser = (user: User, id: number) => this.http.patch(`/api/user/edit/${id}`, user, getHeaders())
        .pipe(catchError(err => this.errorHandler(err)))

    updateWorker = (worker: Worker, id: number) => this.http.patch(`/api/worker/edit/${id}`, worker, getHeaders())
        .pipe(catchError(err => this.errorHandler(err)))

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
