import { Component, OnInit } from '@angular/core';
import { WorkerService } from 'src/app/services/worker/worker.service';
import { Router } from '@angular/router';
import { Department } from 'src/app/models/department/department.model';
import { User } from 'src/app/models/user/user.model';
import { NgForm } from '@angular/forms';
import { Role } from 'src/app/models/role/role';
import { MatSnackBar } from '@angular/material';
import { DepartmentService } from 'src/app/services/department/department.service';
import { Worker } from 'src/app/models/worker/worker.model';

@Component({
  selector: 'app-worker-edit',
  templateUrl: './worker-edit.component.html',
  styleUrls: ['./worker-edit.component.css']
})
export class WorkerEditComponent implements OnInit {
  headerOfSite = 'Szczegóły pracownika';
  worker: Worker;
  id: number;
  departments: Department[] = [];
  users: User[] = [];
  allRoles: { key, value }[] = [];
  roles: { key, value }[] = [];
  anyErrors = false;
  finishedWork = false;
  password = "";

  constructor(private service: WorkerService, private snackBar: MatSnackBar,
    private router: Router, private depService: DepartmentService, ) { }

  ngOnInit() {
    const urlArr = this.router.url.split("/");
    this.id = Number(urlArr[3]);
    this.getRoles();
    this.service.getUsersWithoutWorker().subscribe((res: any) => this.users = JSON.parse(res.users));
    this.depService.getDepartments().subscribe((res: any) => this.departments = JSON.parse(res.departments));
    this.service.getWorkerById(this.id).subscribe((res: any) => {
      this.worker = JSON.parse(res.worker);
    });
  }
  getRoles() {
    for (const role in Role) {
      this.allRoles.push({ key: role, value: Role[role] });
    }
  }

  addRole(value) {
    this.roles.includes(value) ?
      this.roles = this.roles.filter(role => role !== value) :
      this.roles.push(value);
  }


  finishHim() {
    this.finishedWork = !this.finishedWork;
  }

  checkSalary(value) {
    if (value < 1) {
      throw new Error("salary not valid");
    }
  }

  checkBonus(value) {
    if (value < 0) {
      throw new Error("bonus not valid");
    }
  }

  newPassword($event) {
    this.password = $event.target.value
  }

  onSubmit(form: NgForm) {
    try {
      this.checkSalary(form.value.salary);
      this.checkBonus(form.value.bonus);
      if (form.valid) {
        if (this.roles.length > 0) {
          form.value.roles = this.roles;
        }
        if (this.finishedWork) {
          form.value.finishedWork = this.finishedWork;
          console.log("this.finishedWork ",this.finishedWork);
        }
        if (this.password.length > 0) {
          form.value.password = this.password;
        }
        this.service.updateWorker(form.value, this.worker.id).subscribe(
          res => null,
          err => this.snackBar.open("Błąd", "Pracownik nie został zedytowany", {
            duration: 2000,
            panelClass: ['service-snackbar']
          }),
          () => {
            this.router.navigateByUrl("worker/" + this.id);
            form.reset();
          }
        );
      }
    } catch (er) {
      this.anyErrors = true;
    }
  }
}
