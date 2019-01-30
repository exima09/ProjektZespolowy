import {HttpHeaders} from '@angular/common/http';

export const getHeaders = () => {
  const headers: HttpHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('token')});
  headers.append('Content-Type', 'application/json');
  headers.append('Access-Control-Allow-Origin', 'true');
  return {headers};
};
