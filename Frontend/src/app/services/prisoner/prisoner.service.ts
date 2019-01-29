import { Injectable } from '@angular/core';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class PrisonerService {

  formData: Prisoner;
  list: Prisoner[];
  // readonly rootURL = "localhost:8000/api/prisoner";
  readonly rootURL = "http://localhost:3000";
  
  constructor(private http: HttpClient) { }

  postPrisoner(formData: Prisoner) {
    return this.http.post(this.rootURL+'/prisoner', formData);
  }
}
