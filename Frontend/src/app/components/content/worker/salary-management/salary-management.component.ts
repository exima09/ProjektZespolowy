import { Component, OnInit } from '@angular/core';
import { WorkerService } from 'src/app/services/worker/worker.service';
import { Router } from '@angular/router';
import { MatSnackBar } from '@angular/material';
import { NgForm } from '@angular/forms';
import { Worker } from 'src/app/models/worker/worker.model';

@Component({
  selector: 'app-salary-management',
  templateUrl: './salary-management.component.html',
  styleUrls: ['./salary-management.component.css']
})
export class SalaryManagementComponent implements OnInit {
  headerOfSite = 'Zarządzanie wynagrodzeniem pracownika';
  worker: Worker;
  id: number;
  salarys = 0;
  bonuss = 0;
  constructor(private service: WorkerService, private route: Router, public snackBar: MatSnackBar) { }

  ngOnInit() {
    const urlArr = this.route.url.split("/");
    this.id = Number(urlArr[3]);

    this.service.getWorkerById(this.id).subscribe((res: any) => {
      this.worker = JSON.parse(res.worker);
      this.salarys = this.worker.salary;
      this.bonuss = this.worker.bonus;
    });
  }

  onSubmit(form: NgForm) {
    this.service.updateSalary(form.value, this.id).subscribe(() => {
        console.log('Worker salary edited successfully');
        this.snackBar.open('Edycja wynagrodzenia udana', 'OK', {
          duration: 2000,
          panelClass: ['service-snackbar']
        });
      },
      err => {
        this.snackBar.open("Błąd", "Wystąpił błąd podczas aktualizacji danych", {
          duration: 2000,
          panelClass: ['service-snackbar']
        });
        console.log("ERROR", err);
      }
    );
  }
}
