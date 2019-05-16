import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Role } from 'src/app/models/role/role';
import { WorkerService } from 'src/app/services/worker/worker.service';
import { DepartmentService } from 'src/app/services/department/department.service';
import { error } from 'util';
import { throwError } from 'rxjs';
import { MatSnackBar } from '@angular/material';
import { Route, Router } from '@angular/router';
import { Department } from 'src/app/models/department/department.model';
import { User } from 'src/app/models/user/user.model';

@Component({
  selector: 'app-add-worker',
  templateUrl: './add-worker.component.html',
  styleUrls: ['./add-worker.component.css']
})
export class AddWorkerComponent implements OnInit {

  headerOfSite = 'Dodawanie pracownika';
  departments: Department[] = [];
  users: User[] = [];
  allRoles: { key, value }[] = [];
  roles: { key, value }[] = [];
  anyErrors = false;

  constructor(private workerService: WorkerService, private depService: DepartmentService,
    private snackBar: MatSnackBar, private router: Router) {
  }

  ngOnInit() {
    this.getRoles();
    this.workerService.getUsersWithoutWorker().subscribe((res: any) => this.users = JSON.parse(res.users));
    this.depService.getDepartments().subscribe((res: any) => this.departments = JSON.parse(res.departments));
  }

  getRoles() {
    for (const role in Role) {
      if (role) {
        this.allRoles.push({ key: role, value: Role[role] });
      }
    }
  }

  addRole(value) {
    if (this.roles.includes(value)) {
      this.roles = this.roles.filter(elem => {
        if (elem === value) {
          return null;
        } else {
          return elem;
        }
      });
    } else {
      this.roles.push(value);
    }
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
  onSubmit(form: NgForm) {
    try {
      this.checkSalary(form.value.salary);
      this.checkBonus(form.value.bonus);
      if (form.valid && this.roles.length > 0) {
        form.value.roles = this.roles;
        this.workerService.postWorker(form.value).subscribe(
          res => null,
          err => this.snackBar.open("Błąd", "Pracownik nie został dodany", {
            duration: 2000,
            panelClass: ['service-snackbar']
          }),
          () => {
            this.router.navigateByUrl("workers");
            form.reset();
          }
        );
      }
    } catch (er) {
      this.anyErrors = true;
    }
  }
}
