import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/enviroment';

@Injectable({
  providedIn: 'root'
})
export class QuotationService {
  apiUrl = environment.apiUrl;
  constructor(
    private http: HttpClient
  ) { }

  create(data : any) {
    return this.http.post(this.apiUrl + "/quotation", data);
  }
}
