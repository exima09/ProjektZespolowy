import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PrisonersListComponent } from './components/content/prisoners/prisoners-list/prisoners-list.component';
import { HomeComponent } from './components/content/home/home.component';
import { RegisterComponent } from './components/content/register/register.component';
import { LoginComponent } from './components/content/login/login.component';
import { PrisonerComponent } from './components/content/prisoners/prisoner/prisoner.component';
import { PrisonerDetailsComponent } from './components/content/prisoners/prisoner-details/prisoner-details.component';
import { ExecutionReservationComponent } from './components/content/execution/execution-reservation/execution-reservation.component';
import { PrisonerEditComponent } from './components/content/prisoners/prisoner-edit/prisoner-edit.component';

const routes: Routes = [
  { path: '', component: HomeComponent},
  { path: 'register', component: RegisterComponent},
  { path: 'login', component: LoginComponent},
  { path: 'prisoners', component: PrisonersListComponent},
  { path: 'prisoners/register', component: PrisonerComponent},
  { path: 'prisoners/:id', component: PrisonerDetailsComponent},
  { path: 'execution/reservation', component: ExecutionReservationComponent}
  { path: 'prisoners/edit/:id', component: PrisonerEditComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
