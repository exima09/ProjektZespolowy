import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PrisonersListComponent } from './components/content/prisoners/prisoners-list/prisoners-list.component';
import { HomeComponent } from './components/content/home/home.component';
import { RegisterComponent } from './components/content/register/register.component';
import { LoginComponent } from './components/content/login/login.component';
import { PrisonerComponent } from './components/content/prisoners/prisoner/prisoner.component';
import { PrisonerDetailsComponent } from './components/content/prisoners/prisoner-details/prisoner-details.component';
import { PrisonerEditComponent } from './components/content/prisoners/prisoner-edit/prisoner-edit.component';
import { AuthorizationGuard } from "./services/authorization.guard";
import { PrisonerSickNoteComponent } from './components/content/sick-leave/prisoner-sick-note/prisoner-sick-note.component';
import {BlockComponent} from "./components/content/block/block.component";
import { ExecutionReservationComponent } from './components/content/execution/execution-reservation/execution-reservation.component';
import { Role } from './models/role/role';
import { SickLeavesComponent } from './components/content/sick-leave/sick-leaves/sick-leaves.component';


const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'login', component: LoginComponent },
  {
    path: 'prisoners',
    component: PrisonersListComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.EXECUTIONER, Role.SOCIAL, Role.GUARD, Role.MANAGER, Role.MEDICAL, Role.WARDEN] }
  },
  {
    path: 'prisoners/register',
    component: PrisonerComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN] }
  },
  {
    path: 'prisoners/:id',
    component: PrisonerDetailsComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.EXECUTIONER, Role.SOCIAL, Role.GUARD, Role.MANAGER, Role.MEDICAL, Role.WARDEN] }
  },
  {
    path: 'prisoners/edit/:id',
    component: PrisonerEditComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN] }
  },
  {
    path: 'block',
    component: BlockComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.EXECUTIONER, Role.SOCIAL, Role.GUARD, Role.MANAGER, Role.MEDICAL, Role.WARDEN] }
  },
  {
    path: 'issue-sick-note',
    component: PrisonerSickNoteComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MEDICAL] }
  },
  {
    path: 'sick-note',
    component: SickLeavesComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MEDICAL] }
  },
  {
    path: 'execution/reservation',
    component: ExecutionReservationComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.EXECUTIONER] }
  },

  { path: '**', redirectTo: '' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
