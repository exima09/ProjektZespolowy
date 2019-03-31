import { Component, OnInit } from '@angular/core';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import { Router } from '@angular/router';

@Component({
  selector: 'app-prisoner-details',
  templateUrl: './prisoner-details.component.html',
  styleUrls: ['./prisoner-details.component.css']
})
export class PrisonerDetailsComponent implements OnInit {
  headerOfSite = 'Szczegóły więźnia';
  prisoner: Prisoner;
  id: number;
  constructor(private service: PrisonerService, private route: Router) { }

  ngOnInit() {
    let urlArr = this.route.url.split("/");
    this.id = Number(urlArr[2]);

    this.service.getPrisonerById(this.id).subscribe((res: any) => {
      this.prisoner = JSON.parse(res.prisoner);
    });
  }
}