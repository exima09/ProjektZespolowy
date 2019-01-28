import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PrisonersListComponent } from './components/content/prisoners-list/prisoners-list.component';
import { HomeComponent } from './components/content/home/home.component';
import { RegisterComponent } from './components/content/register/register.component';
import { LoginComponent } from './components/content/login/login.component';

const routes: Routes = [
  { path: '', component: HomeComponent},
  { path: 'register', component: RegisterComponent},
  { path: 'login', component: LoginComponent},
  { path: 'prisoners', component: PrisonersListComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
