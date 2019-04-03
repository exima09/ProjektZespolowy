import {Injectable} from '@angular/core';
import {MatSnackBar} from '@angular/material/snack-bar';
import {catchError, map, take} from 'rxjs/operators';

import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import {BehaviorSubject, Observable, throwError} from 'rxjs';
import {Router} from "@angular/router";
import * as jwt_decode from 'jwt-decode';

const TOKEN = 'token';

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  private loggedIn: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

  constructor(private http: HttpClient, public snackBar: MatSnackBar, private router: Router) {
    if (this.checkLogin()) {
      this.loggedIn.next(true);
    }
  }

  register(login: string, password: string) {
    const headers = new HttpHeaders({'Content-Type': 'application/json'});
    const data = {
      'username': login,
      'password': password
    };
    return this.http.post('/api/register', data, {headers}).pipe(catchError(err => this.errorHandler(err)));
  }

  login(login: string, password: string) {
    const headers = new HttpHeaders({'Content-Type': 'application/json'});
    const data = {
      'username': login,
      'password': password
    };
    const loginOperation = this.http.post('/api/login_check', data, {headers});
    return loginOperation.pipe(
      map(item => {
        this.setToken(item[TOKEN]);
        this.loggedIn.next(true);
        this.router.navigate(['/']);
        this.snackBar.open("Logowanie pomyślne.", "OK", {duration: 5000});
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
