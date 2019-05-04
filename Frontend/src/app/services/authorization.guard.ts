import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { Observable } from 'rxjs';
import { map, take } from 'rxjs/operators';
import { AuthenticationService } from "./authorization.service";


@Injectable()
export class AuthorizationGuard implements CanActivate {
  constructor(private authService: AuthenticationService, private router: Router) { }

  canActivate(next: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean> {
    return this.authService.isLoggedIn.pipe(
      take(1),
      map((isLoggedIn: boolean) => {
        if (!isLoggedIn || this.authService.checkLogin() === false) {
          this.router.navigate(['/login']);
          return false;
        }

        if (next.data.roles && !this.hasRole(next.data.roles)) {
          this.router.navigate(['/']);
          return false;
        }

        return true;
      })
    );
  }

  hasRole(requiredRoles) {
    if (requiredRoles.some(role => this.authService.getRoles().includes(role))) {
      return true;
    }

    return false;
  }
}
