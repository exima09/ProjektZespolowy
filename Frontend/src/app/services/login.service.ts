import { Injectable } from "@angular/core";
import { HttpClient, HttpEvent, HttpRequest, HttpParams } from '@angular/common/http';

@Injectable({
    providedIn: 'root'
})
export class LoginService {
    fileName: string;
    constructor(
        private http: HttpClient
    ) { };

    checkLogin() {
        return this.http.get('api/login_check');
    }

}