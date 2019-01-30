import {Injectable} from '@angular/core';
import {MatSnackBar} from '@angular/material/snack-bar';
import {catchError, map} from 'rxjs/operators';

import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import {throwError} from 'rxjs';
import {MenuComponent} from "../components/menu/menu.component";
import {Router} from "@angular/router";
import set = Reflect.set;

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {

  constructor(private http: HttpClient, public snackBar: MatSnackBar, private menu: MenuComponent, private router: Router) {
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
      map(item => {localStorage.setItem('token', item['token']); this.menu.logging("true"); }),
      catchError(err => this.errorHandler(err))
    );
  }

  checkLogin() {
    if(localStorage.getItem('token') === null) {
      this.snackBar.open('error', 'Brak dostępu, musisz się zalogować', {
        duration: 5000,
        panelClass: ['service-snackbar']
      });
      new Promise(resolve => setTimeout(resolve, 2000));
      this.router.navigateByUrl("/login");
    }
    return localStorage.getItem('token') !== null;
  }

  logout() {
    localStorage.removeItem('token');
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
