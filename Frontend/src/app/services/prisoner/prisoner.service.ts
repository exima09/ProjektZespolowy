import {Injectable} from '@angular/core';
import {Prisoner} from 'src/app/models/prisoner/prisoner.model';
import {HttpClient} from '@angular/common/http';
import {getHeaders} from "../headers";

@Injectable({
  providedIn: 'root'
})
export class PrisonerService {

  formData: Prisoner;
  list: Prisoner[];

  constructor(private http: HttpClient) {
  }

  postPrisoner(formData: Prisoner) {
    return this.http.post('/api/prisoner/register', formData, getHeaders());
  }

  getPrisoners() {
    return this.http.get('/api/prisoner', getHeaders());
  }

  // Możecie stosować skrócony zapis
  getPrisonerById = (id: number) => this.http.get(`/api/prisoner/${id}`, getHeaders());
}
