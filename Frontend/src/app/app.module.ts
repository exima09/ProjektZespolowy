import {MatSnackBarModule} from '@angular/material/snack-bar';
import {MatPaginatorModule} from '@angular/material';
import {MatTableModule} from '@angular/material/table';
import {BrowserAnimationsModule, NoopAnimationsModule} from '@angular/platform-browser/animations';
import {LoginComponent} from './components/content/login/login.component';
import {HttpClientModule} from '@angular/common/http';
import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {HeaderComponent} from './components/header/header.component';
import {MenuComponent} from './components/menu/menu.component';
import {PrisonersListComponent} from './components/content/prisoners/prisoners-list/prisoners-list.component';
import {SiteHeaderComponent} from './components/content/site-header/site-header.component';
import {HomeComponent} from './components/content/home/home.component';
import {RegisterComponent} from './components/content/register/register.component';
import {MatButtonModule} from '@angular/material/button';
import {FooterComponent} from './components/footer/footer.component';
import {PrisonerComponent} from './components/content/prisoners/prisoner/prisoner.component';
import {PrisonerService} from './services/prisoner/prisoner.service';
import {FormsModule} from '@angular/forms';
import {AuthenticationService} from "./services/authorization.service";
import { PrisonerDetailsComponent } from './components/content/prisoners/prisoner-details/prisoner-details.component';
import { ExecutionReservationComponent } from './components/content/execution/execution-reservation/execution-reservation.component';
import { ExecutionService } from './services/execution/execution.service';
import { PrisonerEditComponent } from './components/content/prisoners/prisoner-edit/prisoner-edit.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    MenuComponent,
    PrisonersListComponent,
    SiteHeaderComponent,
    HomeComponent,
    RegisterComponent,
    LoginComponent,
    FooterComponent,
    PrisonerComponent,
    PrisonerDetailsComponent,
    ExecutionReservationComponent
    PrisonerEditComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    MatSnackBarModule,
    NoopAnimationsModule,
    FormsModule,
    BrowserAnimationsModule,
    MatButtonModule,
    MatPaginatorModule,
    MatTableModule
  ],
  providers: [PrisonerService, MenuComponent, AuthenticationService, ExecutionService],
  bootstrap: [AppComponent]
})
export class AppModule {
}
