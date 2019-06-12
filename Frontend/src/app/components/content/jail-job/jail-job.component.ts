import {Component, OnInit} from '@angular/core';
import {JailJobService} from "../../../services/jail-job/jail-job.service";
import {JailJob} from "../../../models/jail-job/jailJob.model";
import {NgForm} from "@angular/forms";
import {HttpClient} from "@angular/common/http";
import {MatSnackBar} from "@angular/material";

@Component({
  selector: 'app-jail-job',
  templateUrl: './jail-job.component.html',
  styleUrls: ['./jail-job.component.css']
})
export class JailJobComponent implements OnInit {
  headerOfSite = 'Lista rodzajów prac więźniów';
  jailJobs: JailJob[] = [];
  anyErrors = false;
  finished = true;

  constructor(private service: JailJobService, public snackBar: MatSnackBar) {
  }

  ngOnInit() {
    this.loadJobJail();
  }

  loadJobJail() {
    this.service.getJailJob().subscribe((res: any) => {
      this.jailJobs = JSON.parse(res.jobs);
    });
  }

  onSubmit(formData: NgForm) {
    this.anyErrors = false;
    this.finished = false;
    try {
      if (formData.valid && formData.value.jobName.length > 0) {
        this.service.addJailJob(formData.value).subscribe(
          () => {
            this.loadJobJail();
            this.snackBar.open('Dodano rodzaj pracy', null, {
              duration: 5000,
              panelClass: ['service-snackbar']
            });
          },
          err => {
            this.anyErrors = true;
            this.finished = true;
            // tslint:disable-next-line:no-console
            console.log(err);
          },
          () => {
            this.finished = true;
            this.anyErrors = false;
            this.resetForm(formData);
          }
        );
      }
    } catch (er) {
      this.anyErrors = true;
    }
  }

  resetForm(form?: NgForm) {
    if (form != null) {
      form.resetForm();
    }
  }

  deleteJob = (id: number) => {
    this.service.delJailJob(id).subscribe(
      () => {
        this.loadJobJail()
        this.snackBar.open('Usunięto rodzaj pracy', null, {
          duration: 5000,
          panelClass: ['service-snackbar']
        })
      },
      err => {
        // tslint:disable-next-line:no-console
        console.log(err)
      }
    )
  }
}
