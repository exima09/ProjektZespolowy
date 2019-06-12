import {MatSnackBarModule} from '@angular/material/snack-bar';
import {
  MatCheckboxModule,
  MatDialogModule,
  MatFormFieldModule,
  MatPaginatorModule,
  MatSelectModule,
  MatTabsModule,
  MatInputModule
} from '@angular/material';
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
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {AuthenticationService} from "./services/authorization.service";
import {PrisonerDetailsComponent} from './components/content/prisoners/prisoner-details/prisoner-details.component';
import {PrisonerEditComponent} from './components/content/prisoners/prisoner-edit/prisoner-edit.component';
import {AuthorizationGuard} from "./services/authorization.guard";
import {MatProgressBarModule} from '@angular/material/progress-bar';
import {PrisonerSickNoteComponent} from './components/content/sick-leave/prisoner-sick-note/prisoner-sick-note.component';
import {BlockComponent} from './components/content/block/block.component';
import {CellComponent} from './components/content/cell/cell.component';
import {ExecutionReservationComponent} from './components/content/execution/execution-reservation/execution-reservation.component';
import {ExecutionService} from './services/execution/execution.service';
import {SickLeavesComponent} from './components/content/sick-leave/sick-leaves/sick-leaves.component';
import {ExecutionListComponent} from './components/content/execution/execution-list/execution-list.component';
import {UserRolesComponent} from './components/content/users/user-roles/user-roles.component';
import {WorkersListComponent, DialogPopconfirmComponent} from './components/content/worker/workers-list/workers-list.component';
import {DepartmentComponent} from './components/content/worker/department/department.component';
import {WorkerComponent} from './components/content/worker/worker/worker.component';
import {AddWorkerComponent} from './components/content/worker/add-worker/add-worker.component';
import {WorkerEditComponent} from './components/content/worker/worker-edit/worker-edit.component';
import {SalaryManagementComponent} from './components/content/worker/salary-management/salary-management.component';
import { CvManageComponent } from './components/content/cv/cv-manage/cv-manage.component';
import { CvComponent } from './components/content/cv/cv/cv.component';
import {GetDateFormatedPipe} from "./helpers/getDate";
import { ApplyJobComponent } from './components/content/application/apply-job/apply-job.component';
import { JailJobComponent } from './components/content/jail-job/jail-job.component';
import { JailJobScheduleComponent } from './components/content/jail-job-schedule/jail-job-schedule.component';


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
    PrisonerEditComponent,
    PrisonerSickNoteComponent,
    BlockComponent,
    CellComponent,
    ExecutionReservationComponent,
    SickLeavesComponent,
    ExecutionListComponent,
    UserRolesComponent,
    WorkersListComponent,
    DepartmentComponent,
    WorkerComponent,
    AddWorkerComponent,
    WorkerEditComponent,
    SalaryManagementComponent,
    CvManageComponent,
    CvComponent,
    DialogPopconfirmComponent,
    GetDateFormatedPipe,
    ApplyJobComponent,
    JailJobComponent,
    JailJobScheduleComponent
  ],
  entryComponents: [
    DialogPopconfirmComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    AppRoutingModule,
    HttpClientModule,
    MatSnackBarModule,
    NoopAnimationsModule,
    FormsModule,
    BrowserAnimationsModule,
    MatButtonModule,
    MatPaginatorModule,
    MatTableModule,
    MatProgressBarModule,
    MatFormFieldModule,
    MatSelectModule,
    MatCheckboxModule,
    MatDialogModule,
    MatTabsModule,
    MatInputModule
  ],
  providers: [PrisonerService, MenuComponent, AuthenticationService, AuthorizationGuard, ExecutionService],
  bootstrap: [AppComponent]
})
export class AppModule {
}
