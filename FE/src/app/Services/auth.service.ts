import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/enviroment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
apiUrl = environment.apiUrl;
constructor(
  private http: HttpClient
) { }

  login(data: any){

    return this.http.post(this.apiUrl+ "/login", data);
  }
}
