import { Component, OnInit } from '@angular/core';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { Router } from '@angular/router';
import { SickLeave } from 'src/app/models/sick-leave/sickLeave.model';
import { Execution } from 'src/app/models/execution/execution.model';
import { Visit } from 'src/app/models/visit/visit.model';

@Component({
  selector: 'app-prisoner-details',
  templateUrl: './prisoner-details.component.html',
  styleUrls: ['./prisoner-details.component.css']
})
export class PrisonerDetailsComponent implements OnInit {
  headerOfSite = 'Szczegóły więźnia';
  prisoner: Prisoner;
  id: number;
  sickLeaves: SickLeave[];
  executions: Execution[];
  visits: Visit[];
  constructor(private service: PrisonerService, private route: Router) { }

  ngOnInit() {
    const urlArr = this.route.url.split("/");
    this.id = Number(urlArr[2]);

    this.service.getPrisonerById(this.id).subscribe((res: any) => {
      this.prisoner = JSON.parse(res.prisoner);
      this.sickLeaves = this.prisoner.sickLeaves;
      this.executions = this.prisoner.executions;
      this.visits = this.prisoner.visits;
    });
  }
}