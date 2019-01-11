
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PrisonersListComponent } from './components/content/prisoners-list/prisoners-list.component';
import { HomeComponent } from './components/content/home/home.component';
import { RegisterComponent } from './components/content/register/register.component';

const routes: Routes = [
{path:"prisoners", component:PrisonersListComponent},
{path:"", component:HomeComponent},
{path:"register", component: RegisterComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
