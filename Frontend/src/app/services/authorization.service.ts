import { Injectable } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { catchError, map, take } from 'rxjs/operators';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable, throwError } from 'rxjs';
import { Router } from "@angular/router";
import * as jwt_decode from 'jwt-decode';
import { getHeaders } from "./headers";
import { getToken } from '@angular/router/src/utils/preactivation';

const TOKEN = 'token';

interface RegisterProps {
  username: string;
  password: string;
  firstName: string;
  lastName: string;
}

interface LoginProps {
  username: string;
  password: string;
}

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  private loggedIn: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);
  formData: RegisterProps;


  constructor(private http: HttpClient, public snackBar: MatSnackBar, private router: Router) {
    if (this.checkLogin()) {
      this.loggedIn.next(true);
    }
  }

  register(formData: RegisterProps) {
    return this.http.post('/api/register', formData, getHeaders())
      .pipe(catchError(err => this.errorHandler(err)));
  }

  login(formData: LoginProps) {
    const loginOperation = this.http.post('/api/login_check', formData, getHeaders());
    return loginOperation.pipe(
      map(item => {
        this.setToken(item[TOKEN]);
        this.loggedIn.next(true);
        this.router.navigate(['/']);
        this.snackBar.open("Logowanie pomyślne.", "OK", { duration: 5000 });
      }),
      catchError(err => this.errorHandler(err))
    );
  }

  checkLogin() {
    if (this.getToken() === null || this.isTokenExpired(this.getToken())) {
      this.snackBar.open('error', 'Brak dostępu, musisz się zalogować', {
        duration: 5000,
        panelClass: ['service-snackbar']
      });
      this.loggedIn.next(false);
      this.router.navigateByUrl("/login");
      return false;
    }
    this.loggedIn.next(true);
    return this.getToken() !== null;
  }

  get isLoggedIn() {
    return this.loggedIn.asObservable();
  }

  getRoles(){
    const jwtToken = this.getToken();
    const jwtData = jwtToken.split('.')[1];
    const decodedJwtJsonData = window.atob(jwtData);
    const decodedJwtData = JSON.parse(decodedJwtJsonData);
    return decodedJwtData.roles;
  }

  getToken() {
    return localStorage.getItem(TOKEN);
  }

  setToken(token: string) {
    localStorage.setItem(TOKEN, token);
  }

  getTokenExpirationDate(token: string): Date {
    const decoded = jwt_decode(token);

    if (decoded.exp === undefined) {
      return null;
    }

    const date = new Date(0);
    date.setUTCSeconds(decoded.exp);
    return date;
  }

  isTokenExpired(token?: string): boolean {
    if (!token) {
      token = this.getToken();
    }
    if (!token) {
      return true;
    }

    const date = this.getTokenExpirationDate(token);
    if (date === undefined) {
      return false;
    }
    return !(date.valueOf() > new Date().valueOf());
  }

  logout() {
    localStorage.removeItem(TOKEN);
    this.loggedIn.next(false);
    this.router.navigateByUrl("/login");
  }

  errorHandler(error: HttpErrorResponse) {
    this.loggedIn.next(false);
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
