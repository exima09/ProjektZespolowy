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
import { PrisonerSickNoteComponent } from './components/content/prisoners/prisoner-sick-note/prisoner-sick-note.component';
import {BlockComponent} from "./components/content/block/block.component";


const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'login', component: LoginComponent },
  { path: 'prisoners', component: PrisonersListComponent, canActivate: [AuthorizationGuard] },
  { path: 'prisoners/register', component: PrisonerComponent, canActivate: [AuthorizationGuard] },
  { path: 'prisoners/:id', component: PrisonerDetailsComponent, canActivate: [AuthorizationGuard] },
  { path: 'prisoners/edit/:id', component: PrisonerEditComponent, canActivate: [AuthorizationGuard] },
  { path: 'block', component: BlockComponent, canActivate: [AuthorizationGuard] },
  { path: 'sick-note', component: PrisonerSickNoteComponent, canActivate: [AuthorizationGuard] },
  { path: '**', redirectTo: '' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
