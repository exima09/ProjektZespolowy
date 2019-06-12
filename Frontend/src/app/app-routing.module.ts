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
import { BlockComponent } from "./components/content/block/block.component";
import { ExecutionReservationComponent } from './components/content/execution/execution-reservation/execution-reservation.component';
import { Role } from './models/role/role';
import { SickLeavesComponent } from './components/content/sick-leave/sick-leaves/sick-leaves.component';
import { ExecutionListComponent } from './components/content/execution/execution-list/execution-list.component';
import { UserRolesComponent } from './components/content/users/user-roles/user-roles.component';
import { WorkersListComponent } from './components/content/worker/workers-list/workers-list.component';
import { DepartmentComponent } from './components/content/worker/department/department.component';
import { WorkerComponent } from './components/content/worker/worker/worker.component';
import { AddWorkerComponent } from './components/content/worker/add-worker/add-worker.component';
import { WorkerEditComponent } from './components/content/worker/worker-edit/worker-edit.component';
import { SalaryManagementComponent } from './components/content/worker/salary-management/salary-management.component';
import { CvComponent } from './components/content/cv/cv/cv.component';
import { CvManageComponent } from './components/content/cv/cv-manage/cv-manage.component';
import { ApplyJobComponent } from './components/content/application/apply-job/apply-job.component';
import {JailJobComponent} from "./components/content/jail-job/jail-job.component";
import {JailJobScheduleComponent} from "./components/content/jail-job-schedule/jail-job-schedule.component";

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
    data: { roles: [Role.ADMIN, Role.EXECUTIONER, Role.SOCIAL, Role.GUARD, Role.MANAGER, Role.MEDICAL, Role.WARDEN] }
  },
  {
    path: 'execution/reservation',
    component: ExecutionReservationComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.EXECUTIONER] }
  },
  {
    path: 'executions',
    component: ExecutionListComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.EXECUTIONER, Role.SOCIAL, Role.GUARD, Role.MANAGER, Role.MEDICAL, Role.WARDEN] }
  },
  {
    path: 'user',
    component: UserRolesComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN] }
  },
  {
    path: 'department',
    component: DepartmentComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MANAGER] }
  },
  {
    path: 'workers',
    component: WorkersListComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN] }
  },
  {
    path: 'worker/:id',
    component: WorkerComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MANAGER] }
  },
  {
    path: 'aplications',
    component: CvManageComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MANAGER] }
  },
  {
    path: 'worker/edit/:id',
    component: WorkerEditComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MANAGER] }
  },
  {
    path: 'add-worker',
    component: AddWorkerComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN] }
  },
  {
    path: 'worker/salary-management/:id',
    component: SalaryManagementComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MANAGER] }
  },
  {
    path: 'jail-job',
    component: JailJobComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MANAGER, Role.GUARD, Role.WARDEN] }
  },
  {
    path: 'jail-job/schedule',
    component: JailJobScheduleComponent,
    canActivate: [AuthorizationGuard],
    data: { roles: [Role.ADMIN, Role.MANAGER, Role.GUARD, Role.WARDEN] }
  },
   {
    path: 'apply-for-job',
    component: ApplyJobComponent,
  },
  { path: '**', redirectTo: '' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
