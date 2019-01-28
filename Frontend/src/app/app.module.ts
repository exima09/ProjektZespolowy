import {MatSnackBarModule} from '@angular/material/snack-bar';
import {BrowserAnimationsModule, NoopAnimationsModule} from '@angular/platform-browser/animations';
import {LoginComponent} from './components/content/login/login.component';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { MenuComponent } from './components/menu/menu.component';
import { PrisonersListComponent } from './components/content/prisoners-list/prisoners-list.component';
import { SiteHeaderComponent } from './components/content/site-header/site-header.component';
import { HomeComponent } from './components/content/home/home.component';
import { RegisterComponent } from './components/content/register/register.component';
import { MatButtonModule } from '@angular/material/button';
import { FooterComponent } from './components/footer/footer.component';

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
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    MatSnackBarModule,
    NoopAnimationsModule,
    BrowserAnimationsModule,
    MatButtonModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {
}
