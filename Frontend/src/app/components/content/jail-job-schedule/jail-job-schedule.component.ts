import {Component, OnInit} from '@angular/core';
import {JailJobService} from "../../../services/jail-job/jail-job.service";
import {MatSnackBar} from "@angular/material";
import {NgForm} from "@angular/forms";
import {JailJobSchedule} from "../../../models/jail-job-schedule/jail-job-schedule";
import {JailJob} from "../../../models/jail-job/jailJob.model";
import {PrisonerService} from "../../../services/prisoner/prisoner.service";
import {Prisoner} from "../../../models/prisoner/prisoner.model";
import * as moment from "moment";

@Component({
  selector: 'app-jail-job-schedule',
  templateUrl: './jail-job-schedule.component.html',
  styleUrls: ['./jail-job-schedule.component.css']
})
export class JailJobScheduleComponent implements OnInit {

  headerOfSite = 'Lista prac więźniów';
  jailJobSchedule: JailJobSchedule[] = [];
  jailJobs: JailJob[] = [];
  prisoners: Prisoner[] = [];
  private anyErrors = false;
  private finished = true;
  private loading = true;
  private loadingPrisoner = true;
  private loadingJobJail = true;
  private currentDate;
  private maxDate;
  private prisonerId = "";
  private jailJobId = "";

  constructor(
    private service: JailJobService,
    private prisonerService: PrisonerService,
    public snackBar: MatSnackBar) {}

  ngOnInit() {
    this.loadJobJail();
    this.loadJobJailSchedule();
    this.loadPrisoner();
    this.currentDate = moment().format("YYYY-MM-DD")
    this.maxDate = moment().add(1, 'year').format("YYYY-MM-DD")
  }

  loadJobJail() {
    this.loadingJobJail = true;
    this.service.getJailJob().subscribe((res: any) => {
      this.jailJobs = JSON.parse(res.jobs);
    }, null, () => {
      this.loadingJobJail = false
    });
  }

  loadPrisoner() {
    this.loadingPrisoner = true;
    this.prisonerService.getPrisoners().subscribe((res: any) => {
      this.prisoners = JSON.parse(res.prisoners);
    }, null, () => {
      this.loadingPrisoner = false
    });
  }

  loadJobJailSchedule() {
    this.loading = true;

    this.service.getJailJobSchedule().subscribe((res: any) => {
      this.jailJobSchedule = JSON.parse(res.jobsSchedule);
    }, null, () => {
      this.loading = false
    });
  }

  onSubmit(formData: NgForm) {
    this.anyErrors = false;
    this.finished = false;
    try {
      if (formData.valid && formData.value.jailJob && formData.value.prisoner) {
        this.service.addJailJobSchedule(formData.value).subscribe(
          () => {
            this.loadJobJailSchedule();
            this.snackBar.open('Dodano prace', null, {
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
    this.prisonerId = "";
    this.jailJobId = "";
  }

  deleteJobSchedule = (id: number) => {
    this.service.delJailJobSchedule(id).subscribe(
      () => {
        this.loadJobJailSchedule();
        this.snackBar.open('Anulowano prace', null, {
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

  isOld(dateFrom: string): boolean {
    return moment(dateFrom).unix() > moment().unix();
  }

  checkDate(dateFrom, dateTo) {
    return moment(dateFrom).unix()>moment(dateTo).unix()
  }
}
