import { Component, OnInit } from '@angular/core';

import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from '../Services/auth.service';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {


  constructor(
    private _authService : AuthService,
    private _router: Router
  ) {

  }
  ngOnInit(): void {

  }
  login() {
    const that = this;
    const data = {
      email : "danilo@test.it",
      password : "password"
    };
    this._authService.login(data).subscribe({
      next(r : any ) {

        localStorage.setItem('token',r.token.accessToken);
        // this.Navigation
        that._router.navigate(['form']);
      },
      error(e) {

      }
    });

  }
}
