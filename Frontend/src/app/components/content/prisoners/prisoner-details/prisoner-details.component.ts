import { Component, OnInit } from '@angular/core';
import { PrisonerService } from 'src/app/services/prisoner/prisoner.service';
import { Prisoner } from 'src/app/models/prisoner/prisoner.model';
import {MatGridListModule} from '@angular/material/grid-list';

@Component({
  selector: 'app-prisoner-details',
  templateUrl: './prisoner-details.component.html',
  styleUrls: ['./prisoner-details.component.css']
})
export class PrisonerDetailsComponent implements OnInit {
  headerOfSite = 'Szczegóły więźnia';
  prisoner: Prisoner;
  constructor(private service: PrisonerService) { }

  ngOnInit() {
    this.prisoner = example;
  }
}

const example: Prisoner = {
  firstName: "Jan",
  lastName: "Gierasimiuk",
  joinDate: "06.09.2015",
  dateOfBirth: "03.07.1997",
  cellId: 2
}