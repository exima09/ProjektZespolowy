import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Execution } from 'src/app/models/execution/execution.model';
import { getHeaders } from '../headers';

@Injectable({
  providedIn: 'root'
})
export class ExecutionService {
  formData: Execution

  constructor(private http: HttpClient) {
  }

  postExecution(formData: Execution){
    return this.http.post('api/execution', formData, getHeaders())
  }
}
