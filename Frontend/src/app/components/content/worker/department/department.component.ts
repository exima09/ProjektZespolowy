import { Component, OnInit } from '@angular/core';
import { DepartmentService } from 'src/app/services/department/department.service';
import { NgForm } from '@angular/forms';
import { MatSnackBar } from '@angular/material';
import { Department } from 'src/app/models/department/department.model';

@Component({
  selector: 'app-department',
  templateUrl: './department.component.html',
  styleUrls: ['./department.component.css']
})
export class DepartmentComponent implements OnInit {
  departments: Department[] = [];
  addMode = false;

  constructor(private service: DepartmentService, public snackBar: MatSnackBar) { }

  ngOnInit() {
    this.getDepartments();
  }

  getDepartments() {
    this.service.getDepartments().subscribe((response: any) => { this.departments = JSON.parse(response.departments); });
  }

  changeMode(mode) {
    this.addMode = mode;
  }

  onSubmit(form: NgForm) {
    if (form.valid) {
      this.service.postDepartment(form.value).subscribe(
        res => null,
        err => this.snackBar.open("Błąd", "Dział nie został dodany", {
          duration: 2000,
          panelClass: ['service-snackbar']
        }),
        () => this.getDepartments()
      );
    }
    this.changeMode(false);
  }
}
