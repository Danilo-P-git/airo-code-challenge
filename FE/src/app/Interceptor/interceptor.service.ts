import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor,
  HttpResponse,
  HttpErrorResponse
} from '@angular/common/http';
import { EMPTY, Observable, throwError } from 'rxjs';
import { Router } from '@angular/router';
import { catchError, tap } from 'rxjs/operators';


@Injectable()
export class InterceptorService implements HttpInterceptor {

  constructor(
    private router: Router
  ) { }
  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    let newRequest = request.clone();
    let storageData = localStorage.getItem('token') || '{}';

    if (storageData != '{}') {
      newRequest = request.clone({
        setHeaders: {
          'Authorization': "Bearer " + storageData,
        }
      });


    }
    return this.responseIntercept(next, newRequest);

  }
  responseIntercept(next: HttpHandler, request: HttpRequest<unknown>)  {

    return next.handle(request).pipe(
      tap(
        (next: HttpEvent<any>) => {
          if (next instanceof HttpResponse) {
            console.log(next);

            if (request.headers?.get('Authorization')) {
              const newToken = request.headers.get('Authorization');
              if (newToken != null) {
                const trueToken = newToken.replace("Bearer ", "");
                localStorage.setItem('token', trueToken);
              }

            }
          }
        },
        (error: HttpErrorResponse) => {
        }
      ),
      catchError((err) => {
        localStorage.removeItem('token');
        this.router.navigate(["/"]);

        return throwError(() => err.error.message);
      })
    );
  }
}
